<?php

declare(strict_types=1);

namespace Tests;

use App\Presentation\Request;
use App\Presentation\Response;
use App\Presentation\Router;
use PHPUnit\Framework\TestCase;

final class RouterTest extends TestCase
{
    public function test_it_dispatches_a_post_route(): void
    {
        $router = new Router();

        $router->post(
            '/api/products',
            static fn (): Response => new Response(
                ['created' => true],
                201,
            ),
        );

        $response = $router->dispatch(
            'POST',
            '/api/products',
            new Request(),
        );

        self::assertSame(201, $response->statusCode());
        self::assertSame(
            ['created' => true],
            $response->data(),
        );
    }
}