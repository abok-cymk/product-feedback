<?php

declare(strict_types=1);

namespace Tests;

use App\Presentation\Cors;
use PHPUnit\Framework\TestCase;

final class CorsTest extends TestCase
{
    public function test_it_returns_cors_headers_for_the_allowed_origin(): void
    {
        $cors = new Cors('http://localhost:5173');

        $headers = $cors->headers('http://localhost:5173');

        self::assertSame(
            [
                'Access-Control-Allow-Origin' => 'http://localhost:5173',
                'Access-Control-Allow-Methods' => 'GET, POST, OPTIONS',
                'Access-Control-Allow-Headers' => 'Content-Type',
                'Vary' => 'Origin',
            ],
            $headers,
        );
    }

    public function test_it_returns_no_cors_headers_for_an_untrusted_origin(): void
    {
        $cors = new Cors('http://localhost:5173');

        $headers = $cors->headers('https://evil.example');

        self::assertSame([], $headers);
    }

    public function test_it_returns_cors_headers_for_a_valid_preflight_request(): void
    {
        $cors = new Cors('http://localhost:5173');

        $headers = $cors->preflightHeaders(
            requestOrigin: 'http://localhost:5173',
            requestedMethod: 'POST',
            requestedHeaders: 'Content-Type',
        );

        self::assertSame(
            [
                'Access-Control-Allow-Origin' => 'http://localhost:5173',
                'Access-Control-Allow-Methods' => 'GET, POST, OPTIONS',
                'Access-Control-Allow-Headers' => 'Content-Type',
                'Vary' => 'Origin',
            ],
            $headers,
        );
    }

    public function test_it_rejects_an_unsupported_preflight_method(): void
    {
        $cors = new Cors('http://localhost:5173');

        $headers = $cors->preflightHeaders(
            requestOrigin: 'http://localhost:5173',
            requestedMethod: 'DELETE',
            requestedHeaders: 'Content-Type',
        );

        self::assertSame([], $headers);
    }
}
