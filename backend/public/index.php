<?php

declare(strict_types=1);

use App\Application;

require dirname(__DIR__) . '/vendor/autoload.php';

$app = new Application();

$response = $app->handle(
    $_SERVER['REQUEST_METHOD'],
    parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) ?: '/',
);

$response->send();