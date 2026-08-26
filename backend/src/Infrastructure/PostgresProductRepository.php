<?php

declare(strict_types=1);

namespace App\Infrastructure;

use App\Domain\Product;
use App\Domain\ProductRepository;
use PDO;

final readonly class PostgresProductRepository implements ProductRepository
{
    public function __construct(
        private PDO $connection,
    ) {}

    /**
     * @return list<Product>
     */
    public function all(): array
    {
        $statement = $this->connection->query(
            'SELECT id, name, description
             FROM products
             ORDER BY id ASC',
        );

        $products = [];

        foreach ($statement->fetchAll() as $row) {
            $products[] = $this->mapRowToProduct($row);
        }

        return $products;
    }

    public function findById(int $id): ?Product
    {
        $statement = $this->connection->prepare(
            'SELECT id, name, description
             FROM products
             WHERE id = :id',
        );

        $statement->execute([
            'id' => $id,
        ]);

        $row = $statement->fetch();

        if ($row === false) {
            return null;
        }

        return $this->mapRowToProduct($row);
    }

    public function save(Product $product): Product
    {
        $statement = $this->connection->prepare(
            'INSERT INTO products (id, name, description)
         VALUES (:id, :name, :description)
         ON CONFLICT (id) DO UPDATE SET
             name = EXCLUDED.name,
             description = EXCLUDED.description',
        );

        $statement->execute([
            'id' => $product->id(),
            'name' => $product->name(),
            'description' => $product->description(),
        ]);

        return $product;
    }

    /**
     * Convert a database row into a domain object.
     * Keeping this mapping here prevents database-specific array structures
     * from leaking into the Domain layer.
     *
     * @param array<string, mixed> $row
     */
    private function mapRowToProduct(array $row): Product
    {
        return new Product(
            (int) $row['id'],
            (string) $row['name'],
            (string) $row['description'],
        );
    }
}
