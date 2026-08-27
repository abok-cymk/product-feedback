<?php

declare(strict_types=1);

namespace App\Presentation;

use RuntimeException;

final class Router
{
    /**
     * @var array<string, callable(Request): Response>
     */
    private array $routes = [];

    public function get(string $path, callable $handler): void
    {
        $this->routes['GET ' . $path] = $handler;
    }

    public function post(string $path, callable $handler): void
    {
        $this->routes['POST ' . $path] = $handler;
    }

    public function dispatch(string $method, string $path, Request $request): Response
    {
        $route = $this->routes[$method . ' ' . $path] ?? null;

        if ($route === null) {
            throw new RuntimeException('Route not found.');
        }

        return $route($request);
    }
}
