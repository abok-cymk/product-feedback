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

    public function test_products_route_is_registered(): void
    {
        $application = new Application();

        $response = $application->handle(
            'GET',
            '/api/products',
        );

        self::assertInstanceOf(Response::class, $response);
        self::assertSame(200, $response->statusCode());
        self::assertSame([], $response->data());
    }
}
