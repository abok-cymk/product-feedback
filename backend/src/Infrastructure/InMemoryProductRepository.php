<?php

declare(strict_types=1);

namespace App\Infrastructure;

use App\Domain\Product;
use App\Domain\ProductData;
use App\Domain\ProductRepository;

final class InMemoryProductRepository implements ProductRepository
{
    /**
     * @param list<Product> $products
     */
    public function __construct(
        private array $products = [],
    ) {}

    private int $nextId = 1;

    /**
     * @return list<Product>
     */
    public function all(): array
    {
        return $this->products;
    }

    public function findById(int $id): ?Product
    {
        foreach ($this->products as $product) {
            if ($product->id() === $id) {
                return $product;
            }
        }

        return null;
    }

    public function create(ProductData $data): Product
    {
        // The in-memory repository needs to simulate PostgreSQL's generated ID
        // so application tests can exercise the same repository contract.
        $id = $this->nextId++;

        $product = new Product(
            $id,
            $data->name(),
            $data->description(),
        );

        $this->products[] = $product;

        return $product;
    }
}
