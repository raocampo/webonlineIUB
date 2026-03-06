<?php

declare(strict_types=1);

if (PHP_SAPI === 'cli-server') {
	$requestPath = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH);
	$fullPath = dirname(__DIR__) . ($requestPath ?: '/');

	if ($requestPath !== false && $requestPath !== '/' && is_file($fullPath)) {
		return false;
	}
}

require_once dirname(__DIR__) . '/vendor/autoload.php';

if (session_status() === PHP_SESSION_NONE) {
	session_start();
}

use App\Config\App;
use App\Config\Routes;

$app = new App();
$app->loadEnv();

$router = new Routes();
$router->dispatch($_SERVER['REQUEST_URI'] ?? '/', $_SERVER['REQUEST_METHOD'] ?? 'GET');
