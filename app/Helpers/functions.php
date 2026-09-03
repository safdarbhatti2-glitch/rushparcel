<?php

use App\Core\Config;
use App\Core\Csrf;
use App\Core\ErrorHandler;
use App\Core\Response;
use App\Core\Session;

if (!function_exists('e')) {
    /**
     * Escape HTML output for XSS prevention.
     */
    function e(?string $value): string
    {
        return htmlspecialchars($value ?? '', ENT_QUOTES, 'UTF-8');
    }
}

if (!function_exists('config')) {
    /**
     * Get configuration value.
     */
    function config(string $key, mixed $default = null): mixed
    {
        return Config::get($key, $default);
    }
}

if (!function_exists('session')) {
    /**
     * Access session data or set flash message.
     */
    function session(?string $key = null, mixed $default = null): mixed
    {
        if ($key === null) {
            return new class {
                public function get(string $key, mixed $default = null): mixed {
                    return Session::get($key, $default);
                }
                public function set(string $key, mixed $value): void {
                    Session::set($key, $value);
                }
                public function flash(string $key, mixed $value = null): mixed {
                    return Session::flash($key, $value);
                }
                public function has(string $key): bool {
                    return Session::has($key);
                }
            };
        }
        return Session::get($key, $default);
    }
}

if (!function_exists('csrf_token')) {
    /**
     * Return active CSRF token.
     */
    function csrf_token(): string
    {
        return Csrf::getToken();
    }
}

if (!function_exists('csrf_field')) {
    /**
     * Generate CSRF hidden input field for forms.
     */
    function csrf_field(): string
    {
        return Csrf::field();
    }
}

if (!function_exists('url')) {
    /**
     * Generate full application URL.
     */
    function url(string $path = ''): string
    {
        $baseUrl = rtrim(config('app.url', 'http://localhost:8000'), '/');
        return $baseUrl . '/' . ltrim($path, '/');
    }
}

if (!function_exists('asset')) {
    /**
     * Generate asset URL.
     */
    function asset(string $path): string
    {
        return url('assets/' . ltrim($path, '/'));
    }
}

if (!function_exists('logger')) {
    /**
     * Log message.
     */
    function logger(string $message): void
    {
        ErrorHandler::log("[" . date('Y-m-d H:i:s') . "] " . $message);
    }
}

if (!function_exists('uk_postcode_format')) {
    /**
     * Format and normalize UK postcodes (e.g., "sw1a1aa" -> "SW1A 1AA").
     */
    function uk_postcode_format(string $postcode): string
    {
        $clean = strtoupper(str_replace(' ', '', trim($postcode)));
        if (strlen($clean) > 4) {
            return substr($clean, 0, -3) . ' ' . substr($clean, -3);
        }
        return $clean;
    }
}

if (!function_exists('money_format_gbp')) {
    /**
     * Format monetary decimal as UK GBP (£).
     */
    function money_format_gbp(float|string $amount): string
    {
        return '£' . number_format((float)$amount, 2, '.', ',');
    }
}
