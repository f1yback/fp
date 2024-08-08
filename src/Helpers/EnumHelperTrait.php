<?php

declare(strict_types=1);

namespace Flyback\Fpay\Helpers;

trait EnumHelperTrait
{
    public static function getValues(): array
    {
        $values = [];

        foreach (self::cases() as $case) {
            $values[] = $case->value;
        }

        return $values;
    }

    public static function getNames(): array
    {
        $names = [];

        foreach (self::cases() as $case) {
            $names[] = $case->name;
        }

        return $names;
    }
}