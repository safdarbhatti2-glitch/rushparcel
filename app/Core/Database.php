<?php

namespace App\Core;

use PDO;
use PDOException;
use RuntimeException;

/**
 * Singleton PDO Connection Manager & Transaction Helper.
 */
class Database
{
    protected static ?PDO $connection = null;

    public static function getConnection(): PDO
    {
        if (self::$connection === null) {
            $config = Config::get('database', []);

            $dsn = sprintf(
                "%s:host=%s;port=%d;dbname=%s;charset=%s",
                $config['driver'] ?? 'mysql',
                $config['host'] ?? '127.0.0.1',
                $config['port'] ?? 3306,
                $config['database'] ?? '',
                $config['charset'] ?? 'utf8mb4'
            );

            try {
                self::$connection = new PDO(
                    $dsn,
                    $config['username'] ?? '',
                    $config['password'] ?? '',
                    $config['options'] ?? []
                );
            } catch (PDOException $e) {
                // Never expose database credentials in production exception
                throw new RuntimeException("Database connection error: " . $e->getMessage(), (int)$e->getCode());
            }
        }

        return self::$connection;
    }

    public static function setConnection(PDO $pdo): void
    {
        self::$connection = $pdo;
    }

    public static function prepare(string $sql): \PDOStatement
    {
        return self::getConnection()->prepare($sql);
    }

    public static function query(string $sql, array $params = []): \PDOStatement
    {
        $stmt = self::prepare($sql);
        $stmt->execute($params);
        return $stmt;
    }

    public static function fetch(string $sql, array $params = []): ?array
    {
        $stmt = self::prepare($sql);
        $stmt->execute($params);
        $result = $stmt->fetch();
        return $result !== false ? $result : null;
    }

    public static function fetchAll(string $sql, array $params = []): array
    {
        $stmt = self::prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll();
    }

    public static function lastInsertId(?string $name = null): string
    {
        return self::getConnection()->lastInsertId($name);
    }

    public static function beginTransaction(): bool
    {
        return self::getConnection()->beginTransaction();
    }

    public static function commit(): bool
    {
        return self::getConnection()->commit();
    }

    public static function rollBack(): bool
    {
        return self::getConnection()->rollBack();
    }

    public static function inTransaction(): bool
    {
        return self::getConnection()->inTransaction();
    }

    public static function transaction(callable $callback): mixed
    {
        self::beginTransaction();
        try {
            $result = $callback(self::getConnection());
            self::commit();
            return $result;
        } catch (\Throwable $e) {
            if (self::inTransaction()) {
                self::rollBack();
            }
            throw $e;
        }
    }
}
