<?php

declare(strict_types=1);

namespace App\Domain;

final readonly class ProductData
{
    public function __construct(
        private string $name,
        private string $description,
    ) {
        if (trim($this->name) === '') {
            throw new \InvalidArgumentException('Product name cannot be empty.');
        }

        if (trim($this->description) === '') {
            throw new \InvalidArgumentException('Product description cannot be empty.');
        }
    }

    public function name(): string
    {
        return $this->name;
    }

    public function description(): string
    {
        return $this->description;
    }
}