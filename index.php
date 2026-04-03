<?php

declare(strict_types=1);

define('BASE_PATH', __DIR__);

$router = require BASE_PATH . '/bootstrap/app.php';
$router->dispatch($_SERVER['REQUEST_URI'] ?? '/', $_SERVER['REQUEST_METHOD'] ?? 'GET');
