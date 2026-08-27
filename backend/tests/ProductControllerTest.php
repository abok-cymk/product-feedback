<?php

declare(strict_types=1);

namespace Tests;

use App\Application\Product\ListProducts;
use App\Application\Product\CreateProduct;
use App\Domain\Product;
use App\Infrastructure\InMemoryProductRepository;
use App\Presentation\Product\ProductController;
use App\Presentation\Request;
use PHPUnit\Framework\TestCase;

final class ProductControllerTest extends TestCase
{

    public function test_it_creates_a_product(): void
    {
        $repository = new InMemoryProductRepository();

        $controller = new ProductController(
            new ListProducts($repository),
            new CreateProduct($repository),
        );

        $response = $controller->create(
            new Request([
                'name' => 'Add dark mode',
                'description' => 'Allow users to switch the application to a dark color scheme.',
            ]),
        );

        self::assertSame(201, $response->statusCode());

        self::assertSame(
            [
                'id' => 1,
                'name' => 'Add dark mode',
                'description' => 'Allow users to switch the application to a dark color scheme.',
            ],
            $response->data(),
        );
    }

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

        $repository = new InMemoryProductRepository($products);

        $controller = new ProductController(
            new ListProducts($repository),
            new CreateProduct($repository),
        );

        $response = $controller->index(new Request());

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
        $repository = new InMemoryProductRepository();

        $controller = new ProductController(
            new ListProducts($repository),
            new CreateProduct($repository),
        );

        $response = $controller->index(new Request());

        self::assertSame(200, $response->statusCode());
        self::assertSame([], $response->data());
    }
}
