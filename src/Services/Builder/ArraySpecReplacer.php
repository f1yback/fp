<?php

declare(strict_types=1);

namespace Flyback\Fpay\Services\Builder;

use Flyback\Fpay\Enums\Builder\BuilderSpecEnum;
use Flyback\Fpay\Exceptions\Builder\BadConversionValueException;

class ArraySpecReplacer extends AbstractSpecReplacer
{
    /**
     * @throws BadConversionValueException
     */
    public function replace(mixed $value): string
    {
        if (!array($value)) {
            throw new BadConversionValueException($this->getSpecType(), $value);
        }

        if (array_is_list($value)) {

            foreach ($value as $k => $v) {
                $value[$k] = (new DefaultSpecReplacer())->replace($v);
            }

            return implode(', ', $value);
        }

        $parts = [];

        array_walk($value, function ($v, $k) use (&$parts) {
            $parts[] = sprintf("`%s` = %s", $k, (new DefaultSpecReplacer())->replace($v));
        });

        return implode(', ', $parts);
    }

    public function getSpecType(): BuilderSpecEnum
    {
        return BuilderSpecEnum::Array;
    }
}