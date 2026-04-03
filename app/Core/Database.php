<?php
/*
|-----------------------------------------------------------------------
| Database
|-----------------------------------------------------------------------
| File này tạo kết nối MySQL bằng PDO theo mẫu Singleton.
| Mục tiêu là toàn bộ ứng dụng chỉ dùng chung một kết nối database,
| giúp code gọn hơn và tránh tạo kết nối lặp lại không cần thiết.
*/

namespace App\Core;

use PDO;
use PDOException;

class Database
{
    private static ?Database $instance = null;
    private PDO $connection;

    // Constructor private để ép dùng qua getInstance().
    private function __construct()
    {
        $dsn = sprintf(
            'mysql:host=%s;port=%s;dbname=%s;charset=%s',
            AppConfig::get('db.host'),
            AppConfig::get('db.port'),
            AppConfig::get('db.dbname'),
            AppConfig::get('db.charset')
        );

        try {
            // PDO là nơi toàn bộ Model dùng chung để query database.
            $this->connection = new PDO(
                $dsn,
                (string) AppConfig::get('db.username'),
                (string) AppConfig::get('db.password'),
                [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,
                ]
            );
        } catch (PDOException $exception) {
            exit('Database connection failed: ' . $exception->getMessage());
        }
    }

    // Chỉ tạo 1 kết nối PDO cho toàn bộ ứng dụng.
    public static function getInstance(): Database
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    // Trả về đối tượng PDO để Model sử dụng.
    public function getConnection(): PDO
    {
        return $this->connection;
    }

    // Chặn clone để tránh tạo thêm instance ngoài ý muốn.
    private function __clone(): void
    {
    }
}
