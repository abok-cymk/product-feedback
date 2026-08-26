<?php

declare(strict_types=1);

namespace App\Infrastructure;

use App\Config;
use PDO;

final class DatabaseConnection
{
    public function __construct(
        private Config $config,
    ) {
    }

    public function connect(): PDO
    {
        $dsn = sprintf(
            'pgsql:host=%s;port=%d;dbname=%s',
            $this->config->dbHost,
            $this->config->dbPort,
            $this->config->dbDatabase,
        );

        return new PDO(
            $dsn,
            $this->config->dbUsername,
            $this->config->dbPassword,
            [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,
            ],
        );
    }
}