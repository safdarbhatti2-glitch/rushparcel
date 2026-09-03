<?php

namespace App\Core;

/**
 * Global Error & Exception Handler.
 */
class ErrorHandler
{
    public static function register(): void
    {
        error_reporting(E_ALL);
        set_error_handler([static::class, 'handleError']);
        set_exception_handler([static::class, 'handleException']);
        register_shutdown_function([static::class, 'handleShutdown']);
    }

    public static function handleError(int $level, string $message, string $file, int $line): bool
    {
        if (!(error_reporting() & $level)) {
            return false;
        }

        throw new \ErrorException($message, 0, $level, $file, $line);
    }

    public static function handleException(\Throwable $e): void
    {
        $logMessage = sprintf(
            "[%s] Exception: %s in %s:%d\nStack Trace:\n%s\n",
            date('Y-m-d H:i:s'),
            $e->getMessage(),
            $e->getFile(),
            $e->getLine(),
            $e->getTraceAsString()
        );

        self::log($logMessage);

        $isDebug = Config::get('app.debug', false);

        if ($isDebug) {
            if (!headers_sent()) {
                http_response_code(500);
            }
            echo "<h1>Application Error</h1>";
            echo "<p><strong>Message:</strong> " . htmlspecialchars($e->getMessage()) . "</p>";
            echo "<p><strong>File:</strong> " . htmlspecialchars($e->getFile()) . " on line " . $e->getLine() . "</p>";
            echo "<h3>Stack Trace:</h3><pre>" . htmlspecialchars($e->getTraceAsString()) . "</pre>";
        } else {
            if (!headers_sent()) {
                http_response_code(500);
            }
            echo "<h1>500 Internal Server Error</h1>";
            echo "<p>An unexpected error occurred. Please try again later or contact support if the issue persists.</p>";
        }
        exit(1);
    }

    public static function handleShutdown(): void
    {
        $error = error_get_last();
        if ($error !== null && in_array($error['type'], [E_ERROR, E_PARSE, E_CORE_ERROR, E_COMPILE_ERROR])) {
            self::handleException(new \ErrorException($error['message'], 0, $error['type'], $error['file'], $error['line']));
        }
    }

    public static function log(string $message): void
    {
        $logDir = BASE_PATH . '/storage/logs';
        if (!is_dir($logDir)) {
            mkdir($logDir, 0755, true);
        }

        $logFile = $logDir . '/app.log';
        file_put_contents($logFile, $message . "\n", FILE_APPEND | LOCK_EX);
    }
}
