<?php

declare(strict_types=1);

namespace Tests;

use App\Application\Product\ListProducts;
use App\Domain\Product;
use App\Infrastructure\InMemoryProductRepository;
use PHPUnit\Framework\TestCase;

final class ListProductsTest extends TestCase
{
    public function test_it_returns_all_products_from_the_repository(): void
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

        $useCase = new ListProducts(
            new InMemoryProductRepository($products),
        );

        self::assertSame($products, $useCase->execute());
    }

    public function test_it_returns_an_empty_list_when_no_products_exist(): void
    {
        $useCase = new ListProducts(
            new InMemoryProductRepository(),
        );

        self::assertSame([], $useCase->execute());
    }
}