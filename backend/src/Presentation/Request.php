<?php

declare(strict_types=1);

namespace App\Presentation;

final readonly class Request
{
    /**
     * @param array<string, mixed> $body
     */
    public function __construct(
        private array $body = [],
    ) {
    }

    public function string(string $key): string
    {
        $value = $this->body[$key] ?? null;

        if (!is_string($value)) {
            throw new \InvalidArgumentException(
                sprintf('Request field "%s" must be a string.', $key),
            );
        }

        return $value;
    }
}