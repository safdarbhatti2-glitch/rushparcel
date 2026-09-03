<?php

/**
 * Database Seeder CLI Runner
 */

$basePath = dirname(__DIR__);

require_once $basePath . '/app/Core/App.php';

try {
    \App\Core\App::boot($basePath);

    echo "=========================================\n";
    echo "  UK Delivery Platform — Database Seeder \n";
    echo "=========================================\n\n";

    require_once $basePath . '/database/seeders/DatabaseSeeder.php';

    $seeder = new \Database\Seeders\DatabaseSeeder();
    $seeder->run();

    echo "\nSeeder completed successfully.\n";
} catch (\Throwable $e) {
    echo "\n[ERROR] Seeding failed:\n" . $e->getMessage() . "\n";
    exit(1);
}
