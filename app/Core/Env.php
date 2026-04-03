<?php
/*
|-----------------------------------------------------------------------
| Env
|-----------------------------------------------------------------------
| File này đọc file .env đơn giản và đẩy các biến môi trường vào ứng
| dụng. Nhờ đó cấu hình database, app url, session... có thể đổi theo
| từng máy mà không phải sửa thẳng trong code.
*/

namespace App\Core;

class Env
{
    // Load biến môi trường từ file .env đơn giản.
    public static function load(string $path): void
    {
        if (!is_file($path)) {
            return;
        }

        $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

        if ($lines === false) {
            return;
        }

        foreach ($lines as $line) {
            $line = trim($line);

            if ($line === '' || str_starts_with($line, '#') || !str_contains($line, '=')) {
                continue;
            }

            [$name, $value] = explode('=', $line, 2);
            $name = trim($name);
            $value = trim($value);

            if ($name === '') {
                continue;
            }

            $value = trim($value, "\"'");

            if (getenv($name) === false) {
                putenv($name . '=' . $value);
                $_ENV[$name] = $value;
                $_SERVER[$name] = $value;
            }
        }
    }
}
