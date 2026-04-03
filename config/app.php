<?php
/*
|-----------------------------------------------------------------------
| Config: app
|-----------------------------------------------------------------------
| Đây là file cấu hình trung tâm của ứng dụng.
| Nó gom các cấu hình liên quan đến:
| - thông tin app
| - kết nối database
| - session
| Dữ liệu chủ yếu lấy từ biến môi trường trong file .env.
*/

// Toàn bộ config của app lấy từ biến môi trường để dễ đổi theo máy/dev/prod.
return [
    'app' => [
        'name' => getenv('APP_NAME') ?: 'Landing Page MVC',
        'url' => getenv('APP_URL') ?: 'http://localhost',
        'debug' => filter_var(getenv('APP_DEBUG') ?: 'true', FILTER_VALIDATE_BOOL),
    ],
    'db' => [
        'host' => getenv('DB_HOST') ?: '127.0.0.1',
        'port' => getenv('DB_PORT') ?: '3306',
        'dbname' => getenv('DB_NAME') ?: 'landing_page_db',
        'username' => getenv('DB_USER') ?: 'root',
        'password' => getenv('DB_PASS') ?: '',
        'charset' => getenv('DB_CHARSET') ?: 'utf8mb4',
    ],
    'session' => [
        'name' => getenv('SESSION_NAME') ?: 'landing_page_session',
        'lifetime' => (int) (getenv('SESSION_LIFETIME') ?: 0),
        'idle_timeout' => (int) (getenv('SESSION_IDLE_TIMEOUT') ?: 1800),
        'path' => getenv('SESSION_PATH') ?: '/',
        'domain' => getenv('SESSION_DOMAIN') ?: '',
        'secure' => filter_var(getenv('SESSION_SECURE') ?: 'false', FILTER_VALIDATE_BOOL),
        'httponly' => filter_var(getenv('SESSION_HTTPONLY') ?: 'true', FILTER_VALIDATE_BOOL),
        'samesite' => getenv('SESSION_SAMESITE') ?: 'Lax',
    ],
];
