<?php

declare(strict_types=1);

namespace Tests;

use App\Config;
use App\Domain\Product;
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

    public function test_it_saves_a_new_product(): void
    {
        $product = new Product(
            1,
            'Add dark mode',
            'Allow users to switch the application to a dark color scheme.',
        );

        $savedProduct = $this->repository->save($product);

        self::assertSame($product, $savedProduct);

        self::assertEquals(
            $product,
            $this->repository->findById(1),
        );
    }

    public function test_it_updates_an_existing_product(): void
    {
        $this->connection->exec(
            "INSERT INTO products (id, name, description)
         VALUES (
             1,
             'Add dark mode',
             'Allow users to switch the application to a dark color scheme.'
         )",
        );

        $updatedProduct = new Product(
            1,
            'Export feedback',
            'Allow administrators to export product feedback.',
        );

        $savedProduct = $this->repository->save($updatedProduct);

        self::assertSame($updatedProduct, $savedProduct);

        self::assertEquals(
            $updatedProduct,
            $this->repository->findById(1),
        );
    }
}
