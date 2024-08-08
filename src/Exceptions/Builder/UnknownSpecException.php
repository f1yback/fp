<?php

declare(strict_types=1);

namespace Flyback\Fpay\Exceptions\Builder;

use Exception;

class UnknownSpecException extends Exception
{
    public function __construct(string $spec)
    {
        parent::__construct(
            sprintf('Unknown spec "%s"', $spec)
        );
    }
}