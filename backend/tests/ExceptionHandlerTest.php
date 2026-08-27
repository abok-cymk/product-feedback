<?php

declare(strict_types=1);

namespace Tests;

use App\Presentation\ExceptionHandler;
use InvalidArgumentException;
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

    public function test_invalid_argument_exception_returns_bad_request_response(): void
    {
        $handler = new ExceptionHandler();

        $response = $handler->handle(
            new InvalidArgumentException(
                'Request field "name" must be a string.',
            ),
        );

        self::assertSame(400, $response->statusCode());
        self::assertSame(
            [
                'error' => [
                    'message' => 'Request field "name" must be a string.',
                ],
            ],
            $response->data(),
        );
    }

    public function test_unexpected_exception_returns_internal_server_error_response(): void
    {
        $handler = new ExceptionHandler();

        $response = $handler->handle(
            new \Exception('Sensitive internal detail.'),
        );

        self::assertSame(500, $response->statusCode());
        self::assertSame(
            [
                'error' => [
                    'message' => 'Internal server error.',
                ],
            ],
            $response->data(),
        );
    }
}
