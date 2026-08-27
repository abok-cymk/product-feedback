<?php

declare(strict_types=1);

namespace Tests;

use App\Application;
use App\Config;
use App\Infrastructure\DatabaseConnection;
use App\Presentation\Request;
use App\Presentation\Response;
use PHPUnit\Framework\TestCase;

final class ApplicationTest extends TestCase
{
    protected function setUp(): void
    {
        $config = Config::fromEnvironment();

        $connection = new DatabaseConnection($config)->connect();

        // Application tests must start with a clean database because
        // Application wires the real PostgreSQL product repository.
        $connection->exec('TRUNCATE TABLE products RESTART IDENTITY');
    }

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

    public function test_it_creates_a_product_through_the_products_route(): void
    {
        $application = new Application();

        $response = $application->handle(
            'POST',
            '/api/products',
            new Request([
                'name' => 'Add dark mode',
                'description' => 'Allow users to switch the application to a dark color scheme.',
            ]),
        );

        self::assertSame(201, $response->statusCode());

        $data = $response->data();

        self::assertIsArray($data);
        self::assertGreaterThan(0, $data['id']);
        self::assertSame('Add dark mode', $data['name']);
        self::assertSame(
            'Allow users to switch the application to a dark color scheme.',
            $data['description'],
        );
    }

    public function test_it_persists_a_created_product(): void
    {
        $application = new Application();

        $createResponse = $application->handle(
            'POST',
            '/api/products',
            new Request([
                'name' => 'Add dark mode',
                'description' => 'Allow users to switch the application to a dark color scheme.',
            ]),
        );

        self::assertSame(201, $createResponse->statusCode());

        $createdProduct = $createResponse->data();

        self::assertIsArray($createdProduct);

        $createdId = $createdProduct['id'];

        self::assertIsInt($createdId);

        $listResponse = $application->handle(
            'GET',
            '/api/products',
            new Request(),
        );

        self::assertSame(200, $listResponse->statusCode());

        self::assertSame(
            [
                [
                    'id' => $createdId,
                    'name' => 'Add dark mode',
                    'description' => 'Allow users to switch the application to a dark color scheme.',
                ],
            ],
            $listResponse->data(),
        );
    }
}
