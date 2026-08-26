<?php

declare(strict_types=1);

namespace App\Infrastructure;

use App\Domain\Product;
use App\Domain\ProductRepository;

final class InMemoryProductRepository implements ProductRepository
{
    /**
     * @param list<Product> $products
     */
    public function __construct(
        private array $products = [],
    ) {
    }

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

        public function save(Product $product): Product
    {
        foreach ($this->products as $index => $existingProduct) {
            if ($existingProduct->id() === $product->id()) {
                $this->products[$index] = $product;

                return $product;
            }
        }

        $this->products[] = $product;

        return $product;
    }
}