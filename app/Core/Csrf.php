<?php

namespace App\Core;

/**
 * CSRF Protection Token Generator and Validator.
 */
class Csrf
{
    protected static string $sessionKey = '_csrf_token';

    public static function getToken(): string
    {
        $token = Session::get(self::$sessionKey);
        if (!$token || !is_string($token)) {
            $token = bin2hex(random_bytes(32));
            Session::set(self::$sessionKey, $token);
        }
        return $token;
    }

    public static function validate(?string $token): bool
    {
        if (empty($token)) {
            return false;
        }

        $sessionToken = Session::get(self::$sessionKey);
        if (!$sessionToken || !is_string($sessionToken)) {
            return false;
        }

        return hash_equals($sessionToken, $token);
    }

    public static function field(): string
    {
        $token = self::getToken();
        return sprintf('<input type="hidden" name="%s" value="%s" />', self::$sessionKey, htmlspecialchars($token, ENT_QUOTES, 'UTF-8'));
    }

    public static function regenerate(): string
    {
        Session::remove(self::$sessionKey);
        return self::getToken();
    }
}
