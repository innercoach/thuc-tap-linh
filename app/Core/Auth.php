<?php
/*
|-----------------------------------------------------------------------
| Auth
|-----------------------------------------------------------------------
| File này gom các thao tác xác thực admin.
| Nó chịu trách nhiệm:
| - kiểm tra admin đã login chưa
| - lưu session khi login thành công
| - xóa session khi logout
| - chặn route admin nếu chưa đăng nhập
*/

namespace App\Core;

class Auth
{
    // Kiểm tra admin đã đăng nhập chưa.
    public static function checkAdmin(): bool
    {
        return Session::get('admin_logged_in', false) === true;
    }

    // Lưu thông tin đăng nhập vào session sau khi password_verify thành công.
    public static function loginAdmin(array $admin): void
    {
        session_regenerate_id(true);

        Session::put('admin_logged_in', true);
        Session::put('admin_id', $admin['id']);
        Session::put('admin_username', $admin['username']);
    }

    // Logout sạch cả session lẫn cookie session.
    public static function logoutAdmin(): void
    {
        Session::flush();

        if (ini_get('session.use_cookies')) {
            $params = session_get_cookie_params();

            setcookie(
                session_name(),
                '',
                time() - 42000,
                $params['path'],
                $params['domain'],
                $params['secure'],
                $params['httponly']
            );
        }

        session_destroy();
    }

    // Guard đơn giản: chưa login thì đẩy về trang login.
    public static function requireAdmin(): void
    {
        if (!self::checkAdmin()) {
            (new Response())->redirect('/admin/login');
        }
    }
}
