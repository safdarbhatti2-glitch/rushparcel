<?php

namespace App\Core;

/**
 * Secure HTTP Session Handler.
 */
class Session
{
    protected static bool $started = false;

    public static function start(): void
    {
        if (self::$started || session_status() === PHP_SESSION_ACTIVE) {
            self::$started = true;
            return;
        }

        $sessionConfig = Config::get('security.session', []);

        if (!headers_sent()) {
            ini_set('session.use_only_cookies', '1');
            ini_set('session.use_strict_mode', '1');

            session_name($sessionConfig['name'] ?? 'UKDELIV_SESSID');

            session_set_cookie_params([
                'lifetime' => $sessionConfig['lifetime'] ?? 86400,
                'path' => $sessionConfig['path'] ?? '/',
                'domain' => $sessionConfig['domain'] ?? '',
                'secure' => $sessionConfig['secure'] ?? false,
                'httponly' => $sessionConfig['httponly'] ?? true,
                'samesite' => $sessionConfig['samesite'] ?? 'Lax',
            ]);
        }

        if (session_status() !== PHP_SESSION_ACTIVE) {
            if (!headers_sent()) {
                session_start();
            } else {
                @session_start();
                if (!isset($_SESSION)) {
                    $_SESSION = [];
                }
            }
        }
        self::$started = true;

        // Auto-regenerate session periodically or on initialization check
        if (!self::has('_last_activity')) {
            self::set('_last_activity', time());
        } elseif (time() - self::get('_last_activity') > 1800) { // 30 mins
            self::regenerate(true);
            self::set('_last_activity', time());
        }
    }

    public static function regenerate(bool $deleteOldSession = true): bool
    {
        self::ensureStarted();
        return session_regenerate_id($deleteOldSession);
    }

    public static function get(string $key, mixed $default = null): mixed
    {
        self::ensureStarted();
        return $_SESSION[$key] ?? $default;
    }

    public static function set(string $key, mixed $value): void
    {
        self::ensureStarted();
        $_SESSION[$key] = $value;
    }

    public static function has(string $key): bool
    {
        self::ensureStarted();
        return isset($_SESSION[$key]);
    }

    public static function remove(string $key): void
    {
        self::ensureStarted();
        unset($_SESSION[$key]);
    }

    public static function flash(string $key, mixed $value = null): mixed
    {
        self::ensureStarted();
        if ($value !== null) {
            $_SESSION['_flash'][$key] = $value;
            return null;
        }

        if (isset($_SESSION['_flash'][$key])) {
            $message = $_SESSION['_flash'][$key];
            unset($_SESSION['_flash'][$key]);
            return $message;
        }

        return null;
    }

    public static function destroy(): void
    {
        if (session_status() === PHP_SESSION_ACTIVE) {
            $_SESSION = [];
            if (!headers_sent() && ini_get("session.use_cookies")) {
                $params = session_get_cookie_params();
                setcookie(
                    session_name(),
                    '',
                    time() - 42000,
                    $params["path"],
                    $params["domain"],
                    $params["secure"],
                    $params["httponly"]
                );
            }
            session_destroy();
            self::$started = false;
        }
    }

    protected static function ensureStarted(): void
    {
        if (!self::$started && session_status() !== PHP_SESSION_ACTIVE) {
            self::start();
        }
    }
}
