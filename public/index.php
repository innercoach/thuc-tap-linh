<?php

declare(strict_types=1);

// public/index.php là web entry point khi Apache/Nginx trỏ vào thư mục public.
// Khi chạy bằng PHP built-in server, file này cũng đóng vai trò router script.
// Nếu request đang trỏ tới một file tĩnh có thật (css/js/img), trả file đó luôn.
if (PHP_SAPI === 'cli-server') {
    $requestedPath = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?: '/';
    $staticFile = __DIR__ . $requestedPath;

    if ($requestedPath !== '/' && is_file($staticFile)) {
        return false;
    }
}

define('BASE_PATH', dirname(__DIR__));

$router = require BASE_PATH . '/bootstrap/app.php';
$router->dispatch($_SERVER['REQUEST_URI'] ?? '/', $_SERVER['REQUEST_METHOD'] ?? 'GET');
