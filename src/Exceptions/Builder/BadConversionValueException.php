<?php

declare(strict_types=1);

namespace Flyback\Fpay\Exceptions\Builder;

use Exception;
use Flyback\Fpay\Enums\Builder\BuilderSpecEnum;

class BadConversionValueException extends Exception
{
    public function __construct(
        BuilderSpecEnum $specType,
        mixed $value,
    ) {
        parent::__construct(
            sprintf(
                "Unable to build conversion value '%s' for type '%s'",
                $this->formatValue($value),
                $specType->name
            )
        );
    }

    private function formatValue(mixed $value): string
    {
        if (is_iterable($value)) {
            return json_encode($value, JSON_UNESCAPED_UNICODE);
        }

        return (string)$value;
    }
}