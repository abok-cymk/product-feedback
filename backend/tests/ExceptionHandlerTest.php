<?php

declare(strict_types=1);

namespace Tests;

use App\Presentation\ExceptionHandler;
use PHPUnit\Framework\TestCase;
use RuntimeException;

final class ExceptionHandlerTest extends TestCase
{
    public function test_runtime_exception_returns_not_found_response(): void
    {
        $handler = new ExceptionHandler();

        $response = $handler->handle(
            new RuntimeException('Route not found.'),
        );

        self::assertSame(404, $response->statusCode());
        self::assertSame(
            [
                'error' => [
                    'message' => 'Route not found.',
                ],
            ],
            $response->data(),
        );
    }
}