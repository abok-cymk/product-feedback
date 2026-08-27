<?php

declare(strict_types=1);

namespace Tests;

use App\Config;
use PHPUnit\Framework\TestCase;

final class ConfigTest extends TestCase
{
    public function test_it_reads_the_cors_origin_from_environment(): void
    {
        $config = Config::fromEnvironment();

        self::assertSame(
            'http://localhost:5173',
            $config->corsOrigin,
        );
    }
}