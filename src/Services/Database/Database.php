<?php

declare(strict_types=1);

namespace Flyback\Fpay\Services\Database;

use Flyback\Fpay\Enums\Builder\BuilderSpecEnum;
use Flyback\Fpay\Exceptions\Builder\BadConversionValueException;
use Flyback\Fpay\Exceptions\Builder\UnknownSpecException;
use mysqli;

class Database implements DatabaseInterface
{
    private const string SKIP = "'CORE::SKIP__BUILDER'";
    private mysqli $mysqli;

    public function __construct(mysqli $mysqli)
    {
        $this->mysqli = $mysqli;
    }

    /**
     * @throws UnknownSpecException
     * @throws BadConversionValueException
     */
    public function buildQuery(string $query, array $args = []): string
    {
        $replaces = [];

        preg_match_all('/\?[#fda]?/m', $query, $replaces, PREG_SET_ORDER);

        if (empty($replaces)) {
            return $query;
        }

        foreach ($args as $index => $arg) {
            $spec = BuilderSpecEnum::tryFrom($replaces[$index][0]);

            if (!$spec) {
                throw new UnknownSpecException($replaces[$index][0]);
            }

            $query = preg_replace(
                '/' . preg_quote($replaces[$index][0], '/') . '/',
                $arg === self::SKIP ? $arg : $spec->replace($arg),
                $query,
                1
            );
        }

        return $this->afterBuild($query);
    }

    public function skip(): string
    {
        return self::SKIP;
    }

    private function afterBuild(string $query): string
    {
        preg_match_all('/\{.*\'CORE\:\:SKIP\_\_BUILDER\'.*\}/m', $query, $matches, PREG_SET_ORDER);

        if (empty($matches)) {
            $query = str_replace(['{', '}'], '', $query);
        }

        foreach ($matches as $match) {
            $query = str_replace($match[0], '', $query);
        }

        return $query;
    }
}
