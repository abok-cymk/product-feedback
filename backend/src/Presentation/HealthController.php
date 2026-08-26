<?php

declare(strict_types=1);

namespace App\Presentation;

final class HealthController
{
    public function __invoke(): Response
    {
        return new Response([
            'status' => 'ok',
        ]);
    }
}