<?php

declare(strict_types=1);

namespace Flyback\Fpay\Services\Builder;

use Flyback\Fpay\Enums\Builder\BuilderSpecEnum;
use Flyback\Fpay\Exceptions\Builder\BadConversionValueException;

class IdSpecReplacer extends AbstractSpecReplacer
{
    /**
     * @throws BadConversionValueException
     */
    public function replace(mixed $value): string
    {
        if (!array($value) && !is_string($value)) {
            throw new BadConversionValueException($this->getSpecType(), $value);
        }

        if (is_array($value)) {
            if (array_is_list($value)) {

                foreach ($value as $k => $v) {
                    $value[$k] = addslashes("`$v`");
                }

                return implode(', ', $value);
            }

            throw new BadConversionValueException($this->getSpecType(), $value);
        }

        return addslashes("`$value`");
    }

    public function getSpecType(): BuilderSpecEnum
    {
        return BuilderSpecEnum::Id;
    }
}