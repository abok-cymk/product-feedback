<?php

declare(strict_types=1);

namespace App\Domain;

final readonly class Product
{
    public function __construct(
        private int $id,
        private string $name,
        private string $description,
    ) {
        if ($this->id < 1) {
            throw new \InvalidArgumentException('Product ID must be greater than zero.');
        }

        if (trim($this->name) === '') {
            throw new \InvalidArgumentException('Product name cannot be empty.');
        }

        if (trim($this->description) === '') {
            throw new \InvalidArgumentException('Product description cannot be empty.');
        }
    }

    public function id(): int
    {
        return $this->id;
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