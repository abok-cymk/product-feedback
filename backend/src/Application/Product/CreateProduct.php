<?php

declare(strict_types=1);

namespace App\Application\Product;

use App\Domain\Product;
use App\Domain\ProductData;
use App\Domain\ProductRepository;

final readonly class CreateProduct
{
    public function __construct(
        private ProductRepository $products,
    ) {}

    public function execute(
        string $name,
        string $description,
    ): Product {
        $data = new ProductData(
            $name,
            $description,
        );

        return $this->products->create($data);
    }
}