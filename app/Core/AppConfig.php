<?php
/*
|-----------------------------------------------------------------------
| AppConfig
|-----------------------------------------------------------------------
| File này lưu cấu hình của ứng dụng trong bộ nhớ tạm.
| Sau khi bootstrap nạp config từ file config/app.php, các class khác
| sẽ gọi AppConfig::get(...) để lấy giá trị cần dùng.
*/

namespace App\Core;

class AppConfig
{
    private static array $items = [];

    // Nạp toàn bộ mảng config vào bộ nhớ tĩnh để gọi ở mọi nơi.
    public static function load(array $items): void
    {
        self::$items = $items;
    }

    // Lấy config theo key dạng dot notation, ví dụ db.host.
    public static function get(string $key, mixed $default = null): mixed
    {
        $segments = explode('.', $key);
        $value = self::$items;

        foreach ($segments as $segment) {
            if (!is_array($value) || !array_key_exists($segment, $value)) {
                return $default;
            }

            $value = $value[$segment];
        }

        return $value;
    }
}
