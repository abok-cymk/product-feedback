<?php

declare(strict_types=1);

namespace App\Presentation;

final readonly class Response
{
    /**
     * @param array<string, mixed> $data
     */
    public function __construct(
        private array $data,
        private int $statusCode = 200,
        private array $headers = [],
    ) {}

    /**
     * @return array<string, mixed>
     */
    public function data(): array
    {
        return $this->data;
    }

    public function statusCode(): int
    {
        return $this->statusCode;
    }

    public function send(): void
    {
        http_response_code($this->statusCode);

        header('Content-Type: application/json');

        foreach ($this->headers as $name => $value) {
            header(sprintf('%s: %s', $name, $value));
        }

        echo json_encode(
            ['data' => $this->data],
            JSON_THROW_ON_ERROR,
        );
    }
}
