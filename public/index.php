<?php

/**
 * UK Delivery Platform — Front Controller Entry Point
 */

define('LARAVEL_START', microtime(true));

// Root Directory Path
$basePath = dirname(__DIR__);

// Bootstrap Application
require_once $basePath . '/app/Core/App.php';

$app = \App\Core\App::boot($basePath);
$app->run();
