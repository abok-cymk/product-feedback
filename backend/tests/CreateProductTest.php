<?php

declare(strict_types=1);

namespace Tests;

use App\Application\Product\CreateProduct;
use App\Domain\Product;
use App\Domain\ProductData;
use App\Domain\ProductRepository;
use PHPUnit\Framework\TestCase;

final class CreateProductTest extends TestCase
{
    public function test_it_creates_a_product(): void
    {
        $repository = new class implements ProductRepository {
            public ?ProductData $receivedData = null;

            public function all(): array
            {
                return [];
            }

            public function findById(int $id): ?Product
            {
                return null;
            }

            public function create(ProductData $data): Product
            {
                $this->receivedData = $data;

                return new Product(
                    42,
                    $data->name(),
                    $data->description(),
                );
            }
        };

        $createProduct = new CreateProduct($repository);

        $product = $createProduct->execute(
            'Add dark mode',
            'Allow users to switch the application to a dark color scheme.',
        );

        self::assertSame(42, $product->id());
        self::assertSame('Add dark mode', $product->name());
        self::assertSame(
            'Allow users to switch the application to a dark color scheme.',
            $product->description(),
        );

        self::assertInstanceOf(ProductData::class, $repository->receivedData);
        self::assertSame('Add dark mode', $repository->receivedData->name());
        self::assertSame(
            'Allow users to switch the application to a dark color scheme.',
            $repository->receivedData->description(),
        );
    }
}