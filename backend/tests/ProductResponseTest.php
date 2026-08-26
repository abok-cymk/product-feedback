<?php

declare(strict_types=1);

namespace Tests;

use App\Domain\Product;
use App\Presentation\Product\ProductResponse;
use PHPUnit\Framework\TestCase;

final class ProductResponseTest extends TestCase
{
    public function test_it_converts_a_product_to_an_api_response_array(): void
    {
        $product = new Product(
            1,
            'Add dark mode',
            'Allow users to switch the application to a dark color scheme.',
        );

        self::assertSame(
            [
                'id' => 1,
                'name' => 'Add dark mode',
                'description' => 'Allow users to switch the application to a dark color scheme.',
            ],
            ProductResponse::fromProduct($product),
        );
    }
}