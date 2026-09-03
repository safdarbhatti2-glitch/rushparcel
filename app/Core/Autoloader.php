<?php

namespace App\Core;

/**
 * PSR-4 Compliant Autoloader for App\ namespace.
 */
class Autoloader
{
    protected string $prefix = 'App\\';
    protected string $baseDir;

    public function __construct(string $baseDir)
    {
        $this->baseDir = rtrim($baseDir, '/\\') . DIRECTORY_SEPARATOR;
    }

    public static function register(string $baseDir): void
    {
        $autoloader = new static($baseDir);
        spl_autoload_register([$autoloader, 'loadClass']);
    }

    public function loadClass(string $class): bool
    {
        if (strpos($class, $this->prefix) !== 0) {
            return false;
        }

        $relativeClass = substr($class, strlen($this->prefix));
        $file = $this->baseDir . str_replace('\\', DIRECTORY_SEPARATOR, $relativeClass) . '.php';

        if (file_exists($file)) {
            require_once $file;
            return true;
        }

        return false;
    }
}
