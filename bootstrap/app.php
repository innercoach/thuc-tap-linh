<?php
/*
|-----------------------------------------------------------------------
| Bootstrap Application
|-----------------------------------------------------------------------
| Đây là file khởi tạo ứng dụng.
| Nó chịu trách nhiệm:
| - autoload class
| - đọc file .env
| - nạp config
| - cấu hình session
| - tạo Router
| - nạp danh sách route
*/

declare(strict_types=1);

use App\Core\AppConfig;
use App\Core\Env;
use App\Core\Router;
use App\Core\Session;

if (!defined('BASE_PATH')) {
    define('BASE_PATH', dirname(__DIR__));
}

// Autoload class theo namespace App\... -> app/...
spl_autoload_register(function (string $class): void {
    $prefix = 'App\\';

    if (strpos($class, $prefix) !== 0) {
        return;
    }

    $relativeClass = substr($class, strlen($prefix));
    $file = BASE_PATH . '/app/' . str_replace('\\', '/', $relativeClass) . '.php';

    if (is_file($file)) {
        require $file;
    }
});

// Load biến môi trường rồi nạp config tổng vào AppConfig.
Env::load(BASE_PATH . '/.env');
AppConfig::load(require BASE_PATH . '/config/app.php');

$sessionConfig = AppConfig::get('session', []);

// Cấu hình session cookie trước khi start session.
session_name((string) ($sessionConfig['name'] ?? 'landing_page_session'));
session_set_cookie_params([
    'lifetime' => (int) ($sessionConfig['lifetime'] ?? 0),
    'path' => (string) ($sessionConfig['path'] ?? '/'),
    'domain' => (string) ($sessionConfig['domain'] ?? ''),
    'secure' => (bool) ($sessionConfig['secure'] ?? false),
    'httponly' => (bool) ($sessionConfig['httponly'] ?? true),
    'samesite' => (string) ($sessionConfig['samesite'] ?? 'Lax'),
]);

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

// Tự động làm mới phiên hoạt động và logout nếu người dùng để quá lâu.
$idleTimeout = (int) AppConfig::get('session.idle_timeout', 1800);

if ($idleTimeout > 0 && Session::has('last_activity_at')) {
    $lastActivityAt = (int) Session::get('last_activity_at');

    if ((time() - $lastActivityAt) > $idleTimeout) {
        Session::flush();
        session_regenerate_id(true);
    }
}

Session::put('last_activity_at', time());

// Tạo router rồi nạp danh sách route từ file riêng.
$router = new Router();

require BASE_PATH . '/routes/web.php';

return $router;
