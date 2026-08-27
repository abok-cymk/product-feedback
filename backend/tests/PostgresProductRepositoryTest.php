<?php

declare(strict_types=1);

namespace Tests;

use App\Config;
use App\Domain\Product;
use App\Domain\ProductData;
use App\Infrastructure\DatabaseConnection;
use App\Infrastructure\PostgresProductRepository;
use PDO;
use PHPUnit\Framework\TestCase;

final class PostgresProductRepositoryTest extends TestCase
{
    private PDO $connection;

    private PostgresProductRepository $repository;

    protected function setUp(): void
    {
        $config = Config::fromEnvironment();

        $this->connection = new DatabaseConnection($config)->connect();

        // Keep integration tests isolated from one another by starting
        // each test with an empty products table.
        $this->connection->exec('TRUNCATE TABLE products RESTART IDENTITY');

        $this->repository = new PostgresProductRepository(
            $this->connection,
        );
    }

    public function test_it_returns_an_empty_list_when_no_products_exist(): void
    {
        self::assertSame([], $this->repository->all());
    }

    public function test_it_returns_all_products_ordered_by_id(): void
    {
        $this->connection->exec(
            "INSERT INTO products (name, description)
             VALUES
                ('Add dark mode', 'Allow users to switch the application to a dark color scheme.'),
                ('Export feedback', 'Allow administrators to export product feedback.')",
        );

        self::assertEquals(
            [
                new Product(
                    1,
                    'Add dark mode',
                    'Allow users to switch the application to a dark color scheme.',
                ),
                new Product(
                    2,
                    'Export feedback',
                    'Allow administrators to export product feedback.',
                ),
            ],
            $this->repository->all(),
        );
    }

    public function test_it_finds_a_product_by_id(): void
    {
        $statement = $this->connection->prepare(
            'INSERT INTO products (name, description)
             VALUES (:name, :description)',
        );

        $statement->execute([
            'name' => 'Add dark mode',
            'description' => 'Allow users to switch the application to a dark color scheme.',
        ]);

        $product = $this->repository->findById(1);

        self::assertEquals(
            new Product(
                1,
                'Add dark mode',
                'Allow users to switch the application to a dark color scheme.',
            ),
            $product,
        );
    }

    public function test_it_returns_null_when_product_does_not_exist(): void
    {
        self::assertNull(
            $this->repository->findById(999),
        );
    }

    public function test_it_creates_a_new_product_with_a_database_generated_id(): void
    {
        $data = new ProductData(
            'Add dark mode',
            'Allow users to switch the application to a dark color scheme.',
        );

        $product = $this->repository->create($data);

        self::assertGreaterThan(0, $product->id());
        self::assertSame('Add dark mode', $product->name());
        self::assertSame(
            'Allow users to switch the application to a dark color scheme.',
            $product->description(),
        );

        $found = $this->repository->findById($product->id());

        self::assertNotNull($found);
        self::assertSame($product->id(), $found->id());
        self::assertSame($product->name(), $found->name());
        self::assertSame($product->description(), $found->description());
    }

    public function test_it_generates_unique_ids_for_new_products(): void
    {
        $first = $this->repository->create(
            new ProductData(
                'First product',
                'First product description.',
            ),
        );

        $second = $this->repository->create(
            new ProductData(
                'Second product',
                'Second product description.',
            ),
        );

        self::assertGreaterThan(0, $first->id());
        self::assertGreaterThan(0, $second->id());
        self::assertNotSame($first->id(), $second->id());
    }
}
