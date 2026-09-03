<?php

namespace App\Repositories;

use App\Core\Database;
use PDO;

/**
 * Base Repository providing PDO database access helpers.
 */
abstract class BaseRepository
{
    protected string $table;

    protected function db(): PDO
    {
        return Database::getConnection();
    }

    public function find(int $id): ?array
    {
        $sql = "SELECT * FROM {$this->table} WHERE id = :id LIMIT 1";
        return Database::fetch($sql, [':id' => $id]);
    }

    public function all(string $orderBy = 'id', string $direction = 'ASC'): array
    {
        $direction = strtoupper($direction) === 'DESC' ? 'DESC' : 'ASC';
        $sql = "SELECT * FROM {$this->table} ORDER BY {$orderBy} {$direction}";
        return Database::fetchAll($sql);
    }

    public function delete(int $id): bool
    {
        $sql = "DELETE FROM {$this->table} WHERE id = :id";
        $stmt = Database::prepare($sql);
        return $stmt->execute([':id' => $id]);
    }
}
