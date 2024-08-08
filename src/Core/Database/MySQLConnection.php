<?php

declare(strict_types=1);

namespace Flyback\Fpay\Core\Database;

use Flyback\Fpay\Exceptions\Database\MySQLAcquireException;
use Flyback\Fpay\Helpers\ConfigHelper;
use mysqli;

final class MySQLConnection
{
    private function __construct(){}

    /**
     * @throws MySQLAcquireException
     */
    public static function acquire(): mysqli
    {
        $connection = new mysqli(...ConfigHelper::getDBConfig());

        if ($connection->errno !== 0) {
            throw new MySQLAcquireException($connection->error_list);
        }

        return $connection;
    }

    public static function release(mysqli $connection): bool
    {
        return $connection->close();
    }
}