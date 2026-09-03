<?php

namespace App\Core;

/**
 * Configuration loader reading .env variables and php config files in config/.
 */
class Config
{
    protected static array $items = [];
    protected static bool $loaded = false;

    public static function load(string $configPath, string $envPath = ''): void
    {
        if ($envPath !== '' && file_exists($envPath)) {
            self::loadEnv($envPath);
        }

        if (file_exists($configPath) && is_dir($configPath)) {
            $files = glob($configPath . '/*.php');
            foreach ($files as $file) {
                $key = pathinfo($file, PATHINFO_FILENAME);
                self::$items[$key] = require $file;
            }
        }

        self::$loaded = true;
    }

    public static function loadEnv(string $envPath): void
    {
        if (!file_exists($envPath)) {
            return;
        }

        $lines = file($envPath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($lines as $line) {
            $line = trim($line);
            if ($line === '' || strpos($line, '#') === 0) {
                continue;
            }

            if (strpos($line, '=') !== false) {
                list($name, $value) = explode('=', $line, 2);
                $name = trim($name);
                $value = trim($value);

                // Strip quotes if present
                if ((strpos($value, '"') === 0 && substr($value, -1) === '"') ||
                    (strpos($value, "'") === 0 && substr($value, -1) === "'")) {
                    $value = substr($value, 1, -1);
                }

                $_ENV[$name] = $value;
                putenv("{$name}={$value}");
            }
        }
    }

    public static function get(string $key, mixed $default = null): mixed
    {
        $parts = explode('.', $key);
        $array = self::$items;

        foreach ($parts as $part) {
            if (!is_array($array) || !array_key_exists($part, $array)) {
                return $default;
            }
            $array = $array[$part];
        }

        return $array;
    }

    public static function set(string $key, mixed $value): void
    {
        $parts = explode('.', $key);
        $array = &self::$items;

        while (count($parts) > 1) {
            $part = array_shift($parts);
            if (!isset($array[$part]) || !is_array($array[$part])) {
                $array[$part] = [];
            }
            $array = &$array[$part];
        }

        $array[array_shift($parts)] = $value;
    }

    public static function all(): array
    {
        return self::$items;
    }
}
