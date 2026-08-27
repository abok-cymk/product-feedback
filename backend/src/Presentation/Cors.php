<?php

declare(strict_types=1);

namespace App\Presentation;

final readonly class Cors
{
    public function __construct(
        private string $allowedOrigin,
    ) {}

    /**
     * Build the CORS headers for a request origin.
     * We only return an Allow-Origin header when the request
     * comes from the explicitly configured frontend origin.
     * @return array<string, string>
     */
    public function headers(string $requestOrigin): array
    {
        if ($requestOrigin !== $this->allowedOrigin) {
            return [];
        }

        return [
            'Access-Control-Allow-Origin' => $this->allowedOrigin,
            'Access-Control-Allow-Methods' => 'GET, POST, OPTIONS',
            'Access-Control-Allow-Headers' => 'Content-Type',
            'Vary' => 'Origin',
        ];
    }

    /**
     * Build CORS headers for a browser preflight request.
     * A preflight is allowed only when:
     * - the origin is trusted;
     * - the requested HTTP method is one we explicitly allow;
     * - every requested header is one we explicitly allow.
     * @return array<string, string>
     */
    public function preflightHeaders(
        string $requestOrigin,
        string $requestedMethod,
        string $requestedHeaders,
    ): array {
        if ($requestOrigin !== $this->allowedOrigin) {
            return [];
        }

        $allowedMethods = ['GET', 'POST', 'OPTIONS'];
        $allowedHeaders = ['content-type'];

        if (!in_array($requestedMethod, $allowedMethods, true)) {
            return [];
        }

        foreach (explode(',', $requestedHeaders) as $header) {
            $header = strtolower(trim($header));

            if ($header === '') {
                continue;
            }

            if (!in_array($header, $allowedHeaders, true)) {
                return [];
            }
        }

        return $this->headers($requestOrigin);
    }
}
