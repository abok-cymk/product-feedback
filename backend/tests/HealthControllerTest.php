<?php

declare(strict_types=1);

namespace Tests;

use App\Presentation\HealthController;
use App\Presentation\Response;
use PHPUnit\Framework\TestCase;

final class HealthControllerTest extends TestCase
{
    public function test_health_controller_returns_response(): void
    {
        $response = new HealthController()();

        self::assertInstanceOf(Response::class, $response);
    }
}