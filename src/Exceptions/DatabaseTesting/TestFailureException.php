<?php

declare(strict_types=1);

namespace Flyback\Fpay\Exceptions\DatabaseTesting;

use Exception;

class TestFailureException extends Exception
{
    protected $message = "Failure.";
}