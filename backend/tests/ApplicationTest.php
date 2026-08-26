<?php

declare(strict_types=1);

namespace Tests;

use App\Application;
use App\Presentation\Response;
use PHPUnit\Framework\TestCase;

final class ApplicationTest extends TestCase
{
    public function test_health_route_is_registered(): void
    {
        $application = new Application();

        $response = $application->handle(
            'GET',
            '/api/health',
        );

        self::assertInstanceOf(Response::class, $response);
    }
}