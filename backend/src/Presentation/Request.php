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
    ) {}

    public static function fromJson(string $json): self
    {
        $body = json_decode(
            $json,
            true,
            512,
            JSON_THROW_ON_ERROR,
        );

        if (!is_array($body)) {
            throw new \InvalidArgumentException(
                'Request body must be a JSON object.',
            );
        }

        return new self($body);
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
