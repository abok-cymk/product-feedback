<?php

declare(strict_types=1);

namespace App;

use RuntimeException;

final readonly class Config
{
    public function __construct(
        public string $dbHost,
        public int $dbPort,
        public string $dbDatabase,
        public string $dbUsername,
        public string $dbPassword,
        public string $corsOrigin,
    ) {
    }

    public static function fromEnvironment(): self
    {
        return new self(
            dbHost: self::required('DB_HOST'),
            dbPort: self::requiredInt('DB_PORT'),
            dbDatabase: self::required('DB_DATABASE'),
            dbUsername: self::required('DB_USERNAME'),
            dbPassword: self::required('DB_PASSWORD'),
            corsOrigin: self::required('APP_CORS_ORIGIN'),
        );
    }

    private static function required(string $name): string
    {
        $value = getenv($name);

        if ($value === false || $value === '') {
            throw new RuntimeException(
                sprintf('Environment variable "%s" is required.', $name)
            );
        }

        return $value;
    }

    private static function requiredInt(string $name): int
    {
        $value = self::required($name);

        if (!ctype_digit($value)) {
            throw new RuntimeException(
                sprintf('Environment variable "%s" must be an integer.', $name)
            );
        }

        return (int) $value;
    }
}