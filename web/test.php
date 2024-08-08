<?php

declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

use Flyback\Fpay\Exceptions\Database\MySQLCloseException;
use Flyback\Fpay\Services\DatabaseTester\DatabaseTesterService;

try {
    if (DatabaseTesterService::test()) {
        exit('OK');
    }
} catch (Throwable $e) {
    exit($e->getMessage());
}

throw new MySQLCloseException();
