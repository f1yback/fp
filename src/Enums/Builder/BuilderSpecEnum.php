<?php

declare(strict_types=1);

namespace Flyback\Fpay\Enums\Builder;

use Flyback\Fpay\Exceptions\Builder\BadConversionValueException;
use Flyback\Fpay\Helpers\EnumHelperTrait;
use Flyback\Fpay\Services\Builder\ArraySpecReplacer;
use Flyback\Fpay\Services\Builder\DefaultSpecReplacer;
use Flyback\Fpay\Services\Builder\FloatSpecReplacer;
use Flyback\Fpay\Services\Builder\IdSpecReplacer;
use Flyback\Fpay\Services\Builder\IntegerSpecReplacer;

enum BuilderSpecEnum: string
{
    use EnumHelperTrait;

    case Default = '?';
    case Float = '?f';
    case Integer = '?d';
    case Array = '?a';
    case Id = '?#';

    /**
     * @throws BadConversionValueException
     */
    public function replace(mixed $value): string
    {
        $replacer = (match ($this) {
            self::Default => fn() => new DefaultSpecReplacer(),
            self::Float => fn() => new FloatSpecReplacer(),
            self::Integer => fn() => new IntegerSpecReplacer(),
            self::Array => fn() => new ArraySpecReplacer(),
            self::Id => fn() => new IdSpecReplacer(),
        })();

        return $replacer->replace($value);
    }
}
