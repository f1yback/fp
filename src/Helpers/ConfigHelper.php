<?php

declare(strict_types=1);

namespace Flyback\Fpay\Helpers;

class ConfigHelper
{
    public static function getDBConfig(): array
    {
        return require_once __DIR__.'/../../config/db.php';
    }
}