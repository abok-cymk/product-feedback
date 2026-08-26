<?php

declare(strict_types=1);

namespace Tests;

use App\Domain\Product;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

final class ProductTest extends TestCase
{
    public function test_it_creates_a_valid_product(): void
    {
        $product = new Product(
            1,
            'Add dark mode',
            'Allow users to switch the application to a dark color scheme.',
        );

        self::assertSame(1, $product->id());
        self::assertSame('Add dark mode', $product->name());
        self::assertSame(
            'Allow users to switch the application to a dark color scheme.',
            $product->description(),
        );
    }

    public function test_it_rejects_an_invalid_id(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessageIs('Product ID must be greater than zero.');

        new Product(
            0,
            'Add dark mode',
            'Allow users to switch the application to a dark color scheme.',
        );
    }

    public function test_it_rejects_an_empty_name(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessageIs('Product name cannot be empty.');

        new Product(
            1,
            '   ',
            'Allow users to switch the application to a dark color scheme.',
        );
    }

    public function test_it_rejects_an_empty_description(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessageIs('Product description cannot be empty.');

        new Product(
            1,
            'Add dark mode',
            '   ',
        );
    }
}