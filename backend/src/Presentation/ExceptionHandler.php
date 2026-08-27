<?php

declare(strict_types=1);

namespace App\Presentation;

use Throwable;

final class ExceptionHandler
{
    public function handle(Throwable $exception): Response
    {
        if ($exception instanceof \InvalidArgumentException) {
            return new Response(
                data: [
                    'error' => [
                        'message' => $exception->getMessage(),
                    ],
                ],
                statusCode: 400,
            );
        }
        
        if ($exception instanceof \RuntimeException) {
            return new Response(
                data: [
                    'error' => [
                        'message' => $exception->getMessage(),
                    ],
                ],
                statusCode: 404,
            );
        }

        return new Response(
            data: [
                'error' => [
                    'message' => 'Internal server error.',
                ],
            ],
            statusCode: 500,
        );
    }
}
