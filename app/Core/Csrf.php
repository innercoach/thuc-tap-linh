<?php
/*
|-----------------------------------------------------------------------
| Csrf
|-----------------------------------------------------------------------
| File này xử lý token CSRF để bảo vệ các form POST.
| Token được lưu trong session và gắn vào form dưới dạng input hidden.
| Khi submit, hệ thống sẽ so sánh token từ form với token trong session.
*/

namespace App\Core;

class Csrf
{
    private const SESSION_KEY = '_csrf_token';

    // Mỗi session có một token dùng để kiểm tra form POST có hợp lệ hay không.
    public static function token(): string
    {
        if (!Session::has(self::SESSION_KEY)) {
            Session::put(self::SESSION_KEY, bin2hex(random_bytes(32)));
        }

        return (string) Session::get(self::SESSION_KEY);
    }

    // Sinh sẵn thẻ input hidden để gắn vào form.
    public static function field(): string
    {
        $token = htmlspecialchars(self::token(), ENT_QUOTES, 'UTF-8');

        return '<input type="hidden" name="_token" value="' . $token . '">';
    }

    // So sánh token submit lên với token lưu trong session.
    public static function validate(?string $token): bool
    {
        $sessionToken = Session::get(self::SESSION_KEY, '');

        return is_string($token) && $sessionToken !== '' && hash_equals($sessionToken, $token);
    }
}
