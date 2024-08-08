<?php

declare(strict_types=1);

namespace Flyback\Fpay\Services\Builder;

use Flyback\Fpay\Enums\Builder\BuilderSpecEnum;
use Flyback\Fpay\Exceptions\Builder\BadConversionValueException;

class FloatSpecReplacer extends AbstractSpecReplacer
{
    /**
     * @throws BadConversionValueException
     */
    public function replace(mixed $value): string
    {
        if (!is_float($value) && !is_null($value)) {
            throw new BadConversionValueException($this->getSpecType(), $value);
        }

        if (is_null($value)) {
            return static::NULL;
        }

        return (string)($value);
    }

    public function getSpecType(): BuilderSpecEnum
    {
        return BuilderSpecEnum::Float;
    }
}