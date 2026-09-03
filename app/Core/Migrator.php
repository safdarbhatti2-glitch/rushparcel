<?php

namespace App\Core;

use PDO;
use RuntimeException;

/**
 * Migration runner engine for executing SQL schema migrations.
 */
class Migrator
{
    protected PDO $pdo;
    protected string $migrationsPath;

    public function __construct(?PDO $pdo = null, ?string $migrationsPath = null)
    {
        $this->pdo = $pdo ?? Database::getConnection();
        $this->migrationsPath = $migrationsPath ?? BASE_PATH . '/database/migrations';
    }

    public function initMigrationTable(): void
    {
        $sql = "CREATE TABLE IF NOT EXISTS schema_migrations (
            id INT AUTO_INCREMENT PRIMARY KEY,
            migration VARCHAR(255) NOT NULL UNIQUE,
            batch INT NOT NULL,
            executed_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;";

        $this->pdo->exec($sql);
    }

    public function getExecutedMigrations(): array
    {
        $this->initMigrationTable();
        $stmt = $this->pdo->query("SELECT migration FROM schema_migrations ORDER BY id ASC");
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }

    public function getNextBatchNumber(): int
    {
        $this->initMigrationTable();
        $stmt = $this->pdo->query("SELECT MAX(batch) FROM schema_migrations");
        $max = $stmt->fetchColumn();
        return ($max !== false && $max !== null) ? ((int)$max + 1) : 1;
    }

    public function run(): array
    {
        $this->initMigrationTable();
        $executed = $this->getExecutedMigrations();
        $batch = $this->getNextBatchNumber();
        $ran = [];

        if (!is_dir($this->migrationsPath)) {
            throw new RuntimeException("Migrations path [{$this->migrationsPath}] does not exist.");
        }

        $files = glob($this->migrationsPath . '/*.sql');
        sort($files);

        foreach ($files as $file) {
            $fileName = basename($file);

            if (in_array($fileName, $executed)) {
                continue;
            }

            $sql = file_get_contents($file);
            if (empty(trim($sql))) {
                continue;
            }

            try {
                // Execute SQL migration statements (MySQL DDL implicitly commits)
                $this->pdo->exec($sql);

                $stmt = $this->pdo->prepare("INSERT INTO schema_migrations (migration, batch) VALUES (:migration, :batch)");
                $stmt->execute([
                    ':migration' => $fileName,
                    ':batch' => $batch,
                ]);

                $ran[] = $fileName;
            } catch (\Throwable $e) {
                if ($this->pdo->inTransaction()) {
                    $this->pdo->rollBack();
                }
                throw new RuntimeException("Migration failed [{$fileName}]: " . $e->getMessage(), 0, $e);
            }
        }

        return $ran;
    }
}
