<?php

declare(strict_types=1);

namespace App\Domain;

interface ProductRepository
{
    /**
     * Return every product currently available.
     * @return list<Product>
     */
    public function all(): array;

    /**
     * Find a product by its identifier.
     * Returns null when the product does not exist.
     */
    public function findById(int $id): ?Product;

    /**
     * Persist a new product and return it with its generated ID.
     */
    public function create(ProductData $data): Product;
}
