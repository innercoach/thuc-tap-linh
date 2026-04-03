<?php
/*
|-----------------------------------------------------------------------
| Session
|-----------------------------------------------------------------------
| File này là lớp tiện ích để làm việc với PHP Session.
| Nó giúp code dễ đọc hơn khi:
| - lấy/ghi dữ liệu session
| - kiểm tra key tồn tại
| - xóa session
| - tạo flash message cho request kế tiếp
*/

namespace App\Core;

class Session
{
    // Lấy dữ liệu session theo key.
    public static function get(string $key, mixed $default = null): mixed
    {
        return $_SESSION[$key] ?? $default;
    }

    // Ghi dữ liệu session.
    public static function put(string $key, mixed $value): void
    {
        $_SESSION[$key] = $value;
    }

    public static function forget(string $key): void
    {
        unset($_SESSION[$key]);
    }

    // Xóa toàn bộ session hiện tại.
    public static function flush(): void
    {
        $_SESSION = [];
    }

    public static function has(string $key): bool
    {
        return array_key_exists($key, $_SESSION);
    }

    // Flash chỉ tồn tại trong request kế tiếp.
    public static function flash(string $key, mixed $value): void
    {
        $_SESSION['_flash'][$key] = $value;
    }

    public static function getFlash(string $key, mixed $default = null): mixed
    {
        $value = $_SESSION['_flash'][$key] ?? $default;
        unset($_SESSION['_flash'][$key]);

        return $value;
    }
}
