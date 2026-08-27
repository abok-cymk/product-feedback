<?php

declare(strict_types=1);

namespace Tests;

use App\Domain\ProductData;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

final class ProductDataTest extends TestCase
{
    public function test_it_creates_valid_product_data(): void
    {
        $productData = new ProductData(
            'Add dark mode',
            'Allow users to switch the application to a dark color scheme.',
        );

        self::assertSame('Add dark mode', $productData->name());
        self::assertSame(
            'Allow users to switch the application to a dark color scheme.',
            $productData->description(),
        );
    }

    public function test_it_rejects_an_empty_name(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessageIs('Product name cannot be empty.');

        new ProductData(
            '   ',
            'Allow users to switch the application to a dark color scheme.',
        );
    }

    public function test_it_rejects_an_empty_description(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessageIs('Product description cannot be empty.');

        new ProductData(
            'Add dark mode',
            '   ',
        );
    }
}