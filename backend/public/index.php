<?php

declare(strict_types=1);

use App\Application;
use App\Config;
use App\Presentation\Cors;
use App\Presentation\Request;

require dirname(__DIR__) . '/vendor/autoload.php';

$config = Config::fromEnvironment();

$cors = new Cors($config->corsOrigin);

$method = $_SERVER['REQUEST_METHOD'];
$origin = $_SERVER['HTTP_ORIGIN'] ?? '';

if ($method === 'OPTIONS') {
    $corsHeaders = $cors->preflightHeaders(
        requestOrigin: $origin,
        requestedMethod: $_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD'] ?? '',
        requestedHeaders: $_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS'] ?? '',
    );

    foreach ($corsHeaders as $name => $value) {
        header(sprintf('%s: %s', $name, $value));
    }

    http_response_code($corsHeaders === [] ? 403 : 204);

    exit;
}

$request = new Request();

if ($method === 'POST') {
    $request = Request::fromJson(
        file_get_contents('php://input'),
    );
}

$response = (new Application())->handle(
    $_SERVER['REQUEST_METHOD'],
    parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) ?: '/',
);

foreach ($cors->headers($origin) as $name => $value) {
    header(sprintf('%s: %s', $name, $value));
}

$response->send();
