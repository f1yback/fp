<?php

declare(strict_types=1);

namespace Flyback\Fpay\Services\DatabaseTester;

use Flyback\Fpay\Core\Database\MySQLConnection;
use Flyback\Fpay\Exceptions\Database\MySQLAcquireException;
use Flyback\Fpay\Exceptions\DatabaseTesting\TestFailureException;
use Flyback\Fpay\Services\Database\Database;
use Flyback\Fpay\Services\Database\DatabaseTest;

class DatabaseTesterService
{
    /**
     * @throws MySQLAcquireException|TestFailureException
     */
    public static function test(): bool
    {
        $db = new Database($connection = MySQLConnection::acquire());
        $test = new DatabaseTest($db);
        $test->testBuildQuery();

        return MysqlConnection::release($connection);
    }
}