<?php

declare(strict_types=1);

namespace Tests;

use App\Presentation\Request;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

final class RequestTest extends TestCase
{
    public function test_it_returns_a_string_body_value(): void
    {
        $request = new Request([
            'name' => 'Add dark mode',
        ]);

        self::assertSame(
            'Add dark mode',
            $request->string('name'),
        );
    }

    public function test_it_rejects_a_missing_string_value(): void
    {
        $request = new Request();

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessageIs(
            'Request field "name" must be a string.',
        );

        $request->string('name');
    }

    public function test_it_rejects_a_non_string_value(): void
    {
        $request = new Request([
            'name' => 123,
        ]);

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessageIs(
            'Request field "name" must be a string.',
        );

        $request->string('name');
    }

    public function test_it_creates_a_request_from_a_json_body(): void
    {
        $request = Request::fromJson(
            '{"name":"API integration test","description":"Created through the HTTP API."}',
        );

        self::assertSame(
            'API integration test',
            $request->string('name'),
        );

        self::assertSame(
            'Created through the HTTP API.',
            $request->string('description'),
        );
    }
}
