<?php

declare(strict_types=1);

namespace Tests;

use PHPUnit\Framework\TestCase;

final class SmokeTest extends TestCase
{
    public function test_application_bootstrap_is_available(): void
    {
        $autoload = dirname(__DIR__) . '/vendor/autoload.php';

        self::assertFileExists($autoload);
    }
}