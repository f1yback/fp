<?php

declare(strict_types=1);

namespace Flyback\Fpay\Exceptions\Database;

use Exception;

class MySQLCloseException extends Exception
{
    protected $message = "There is an unexpected error while trying to close MySQL connection";
}