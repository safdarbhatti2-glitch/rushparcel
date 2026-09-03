<?php

namespace App\Core;

/**
 * Application Bootstrap Container & Lifecycle Handler.
 */
class App
{
    protected Router $router;
    protected Request $request;

    public function __construct()
    {
        $this->router = new Router();
        $this->request = new Request();
    }

    public static function boot(string $basePath): static
    {
        if (!defined('BASE_PATH')) {
            define('BASE_PATH', rtrim($basePath, '/\\'));
        }
        if (!defined('APP_PATH')) {
            define('APP_PATH', BASE_PATH . '/app');
        }

        // Register autoloader
        require_once APP_PATH . '/Core/Autoloader.php';
        Autoloader::register(APP_PATH);

        // Load configuration and environment
        Config::load(BASE_PATH . '/config', BASE_PATH . '/.env');

        // Configure timezone
        date_default_timezone_set(Config::get('app.timezone', 'Europe/London'));

        // Register global error handler
        ErrorHandler::register();

        // Start secure session
        Session::start();

        // Load global functions
        require_once APP_PATH . '/Helpers/functions.php';

        $app = new static();

        // Load routes
        $router = $app->router();
        require_once BASE_PATH . '/routes/web.php';

        return $app;
    }

    public function router(): Router
    {
        return $this->router;
    }

    public function request(): Request
    {
        return $this->request;
    }

    public function run(): void
    {
        $response = $this->router->dispatch($this->request);
        $response->send();
    }
}
