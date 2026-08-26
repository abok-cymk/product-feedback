<?php

declare(strict_types=1);

namespace Tests;

use App\Config;
use App\Infrastructure\DatabaseConnection;
use PDO;
use PHPUnit\Framework\TestCase;

final class DatabaseConnectionTest extends TestCase
{
    public function test_it_can_connect_to_postgresql(): void
    {
        $config = Config::fromEnvironment();

        $connection = new DatabaseConnection($config);

        $pdo = $connection->connect();

        self::assertInstanceOf(PDO::class, $pdo);

        $result = $pdo
            ->query('SELECT 1')
            ->fetchColumn();

        self::assertSame(1, (int) $result);
    }
}