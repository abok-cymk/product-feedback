<?php

declare(strict_types=1);

namespace Tests;

use App\Application\Product\ListProducts;
use App\Domain\Product;
use App\Infrastructure\InMemoryProductRepository;
use App\Presentation\Product\ProductController;
use PHPUnit\Framework\TestCase;

final class ProductControllerTest extends TestCase
{
    public function test_it_returns_products_as_a_response(): void
    {
        $products = [
            new Product(
                1,
                'Add dark mode',
                'Allow users to switch the application to a dark color scheme.',
            ),
            new Product(
                2,
                'Export feedback',
                'Allow administrators to export product feedback.',
            ),
        ];

        $controller = new ProductController(
            new ListProducts(
                new InMemoryProductRepository($products),
            ),
        );

        $response = $controller->index();

        self::assertSame(200, $response->statusCode());
        self::assertSame(
            [
                [
                    'id' => 1,
                    'name' => 'Add dark mode',
                    'description' => 'Allow users to switch the application to a dark color scheme.',
                ],
                [
                    'id' => 2,
                    'name' => 'Export feedback',
                    'description' => 'Allow administrators to export product feedback.',
                ],
            ],
            $response->data(),
        );
    }

    public function test_it_returns_an_empty_product_list(): void
    {
        $controller = new ProductController(
            new ListProducts(
                new InMemoryProductRepository(),
            ),
        );

        $response = $controller->index();

        self::assertSame(200, $response->statusCode());
        self::assertSame([], $response->data());
    }
}