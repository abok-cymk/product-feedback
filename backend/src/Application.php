<?php

declare(strict_types=1);

namespace App;

use App\Application\Product\ListProducts;
use App\Application\Product\CreateProduct;
use App\Infrastructure\DatabaseConnection;
use App\Infrastructure\PostgresProductRepository;
use App\Presentation\ExceptionHandler;
use App\Presentation\HealthController;
use App\Presentation\Product\ProductController;
use App\Presentation\Request;
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
        Request $request = new Request(),
    ): Response {
        if ($method === 'OPTIONS') {
            return new Response(
                data: [],
                statusCode: 204,
            );
        }
        
        try {
            return $this->router->dispatch($method, $path, $request);
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

        $productRepository = $this->createProductRepository();

        $productController = new ProductController(
            new ListProducts($productRepository),
            new CreateProduct($productRepository),
        );

        $this->router->get(
            '/api/products',
            new ProductController(
                new ListProducts($productRepository),
                new CreateProduct($productRepository),
            )->index(...),
        );

        $this->router->post(
            '/api/products',
            $productController->create(...),
        );
    }

    private function createProductRepository(): PostgresProductRepository
    {
        $config = Config::fromEnvironment();

        $connection = new DatabaseConnection($config)->connect();

        return new PostgresProductRepository($connection);
    }
}
