<?php

/**
 * Migration CLI Runner
 */

$basePath = dirname(__DIR__);

require_once $basePath . '/app/Core/App.php';

try {
    \App\Core\App::boot($basePath);

    echo "=========================================\n";
    echo "  UK Delivery Platform — Migration Runner \n";
    echo "=========================================\n\n";

    $migrator = new \App\Core\Migrator();
    $ran = $migrator->run();

    if (empty($ran)) {
        echo "Nothing to migrate. Schema is up to date.\n";
    } else {
        echo "Successfully executed " . count($ran) . " migration(s):\n";
        foreach ($ran as $file) {
            echo "  [MIGRATED] {$file}\n";
        }
    }
    echo "\nCompleted successfully.\n";
} catch (\Throwable $e) {
    echo "\n[ERROR] Migration failed:\n" . $e->getMessage() . "\n";
    exit(1);
}
