<?php

namespace App\Services;

use App\Core\Database;

/**
 * Base Service class.
 */
abstract class BaseService
{
    protected function transaction(callable $callback): mixed
    {
        return Database::transaction($callback);
    }
}
