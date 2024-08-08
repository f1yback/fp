<?php

declare(strict_types=1);

namespace Flyback\Fpay\Services\Database;

interface DatabaseInterface
{
    public function buildQuery(string $query, array $args = []): string;

    public function skip();
}
