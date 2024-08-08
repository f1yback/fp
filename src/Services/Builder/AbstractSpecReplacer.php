<?php

declare(strict_types=1);

namespace Flyback\Fpay\Services\Builder;

use Flyback\Fpay\Enums\Builder\BuilderSpecEnum;

abstract class AbstractSpecReplacer
{
    protected const string NULL = 'NULL';
    abstract public function replace(mixed $value): string;

    abstract public function getSpecType(): BuilderSpecEnum;
}