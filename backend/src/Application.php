<?php

declare(strict_types=1);

namespace App;

use App\Presentation\ExceptionHandler;
use App\Presentation\HealthController;
use App\Presentation\Response;
use App\Presentation\Router;

final class Application
{
    private Router $router;
    private ExceptionHandler $exceptionHandler;

    public function __construct()
    {
        $this->router = new Router();
        $this->exceptionHandler = new ExceptionHandler();

        $this->registerRoutes();
    }

    public function handle(
        string $method,
        string $path,
    ): Response {
        try {
            return $this->router->dispatch($method, $path);
        } catch (\Throwable $exception) {
            return $this->exceptionHandler->handle($exception);
        }
    }

    private function registerRoutes(): void
    {
        $this->router->get(
            '/api/health',
            new HealthController(),
        );
    }
}
