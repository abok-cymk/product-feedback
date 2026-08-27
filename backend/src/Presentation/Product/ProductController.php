<?php

declare(strict_types=1);

namespace App\Presentation\Product;

use App\Application\Product\CreateProduct;
use App\Application\Product\ListProducts;
use App\Presentation\Request;
use App\Presentation\Response;

final readonly class ProductController
{
    public function __construct(
        private ListProducts $listProducts,
        private CreateProduct $createProduct,
    ) {}

    public function index(Request $request): Response
    {
        $products = $this->listProducts->execute();

        // Keep the domain objects out of the HTTP response.
        // ProductResponse owns the mapping from domain data to API data.
        $data = array_map(
            static fn($product): array => ProductResponse::fromProduct($product),
            $products,
        );

        return new Response($data);
    }

    public function create(Request $request): Response
    {
        $product = $this->createProduct->execute(
            $request->string('name'),
            $request->string('description'),
        );

        return new Response(
            ProductResponse::fromProduct($product),
            201,
        );
    }
}
