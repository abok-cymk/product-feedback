<?php

declare(strict_types=1);

namespace App\Application\Product;

use App\Domain\Product;
use App\Domain\ProductRepository;

final readonly class ListProducts
{
    public function __construct(
        private ProductRepository $products,
    ) {
    }

    /**
     * @return list<Product>
     */
    public function execute(): array
    {
        return $this->products->all();
    }
}