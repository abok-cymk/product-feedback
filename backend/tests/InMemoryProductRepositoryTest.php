<?php

declare(strict_types=1);

namespace Tests;

use App\Domain\Product;
use App\Infrastructure\InMemoryProductRepository;
use PHPUnit\Framework\TestCase;

final class InMemoryProductRepositoryTest extends TestCase
{
    public function test_it_returns_all_products(): void
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

        self::assertSame($products, $repository->all());
    }

    public function test_it_finds_a_product_by_id(): void
    {
        $product = new Product(
            1,
            'Add dark mode',
            'Allow users to switch the application to a dark color scheme.',
        );

        $repository = new InMemoryProductRepository([$product]);

        self::assertSame($product, $repository->findById(1));
    }

    public function test_it_returns_null_when_product_does_not_exist(): void
    {
        $repository = new InMemoryProductRepository([
            new Product(
                1,
                'Add dark mode',
                'Allow users to switch the application to a dark color scheme.',
            ),
        ]);

        self::assertNull($repository->findById(999));
    }

    public function test_it_returns_an_empty_list_when_no_products_exist(): void
    {
        $repository = new InMemoryProductRepository();

        self::assertSame([], $repository->all());
    }
}