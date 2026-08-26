<?php

declare(strict_types=1);

namespace App\Presentation\Product;

use App\Domain\Product;

final class ProductResponse
{
    /**
     * Convert a domain Product into the API representation.
     * Keeping this mapping here prevents the domain object from becoming
     * coupled to JSON, HTTP, or other presentation concerns.
     * @return array{id: int, name: string, description: string}
     */
    public static function fromProduct(Product $product): array
    {
        return [
            'id' => $product->id(),
            'name' => $product->name(),
            'description' => $product->description(),
        ];
    }
}