<?php

declare(strict_types=1);

namespace Flyback\Fpay\Exceptions\Database;

use Exception;
use Throwable;

class MySQLAcquireException extends Exception
{
    public function __construct(array $errorList, int $code = 0, ?Throwable $previous = null)
    {
        parent::__construct("MySQL connection errors: " . implode(';', $errorList), $code, $previous);
    }
}