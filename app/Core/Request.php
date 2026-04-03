<?php
/*
|-----------------------------------------------------------------------
| Request
|-----------------------------------------------------------------------
| File này đóng gói dữ liệu request hiện tại.
| Nó giúp controller lấy dữ liệu từ $_GET, $_POST, method, URI...
| theo cách gọn hơn thay vì truy cập superglobal trực tiếp mọi nơi.
*/

namespace App\Core;

class Request
{
    // Trả về method hiện tại như GET, POST...
    public function method(): string
    {
        return strtoupper($_SERVER['REQUEST_METHOD'] ?? 'GET');
    }

    // Trả về URI gốc của request, ví dụ /admin/login.
    public function uri(): string
    {
        return $_SERVER['REQUEST_URI'] ?? '/';
    }

    // Lấy dữ liệu ưu tiên từ POST, nếu không có thì lấy từ GET.
    public function input(string $key, mixed $default = null): mixed
    {
        return $_POST[$key] ?? $_GET[$key] ?? $default;
    }

    public function all(): array
    {
        return array_merge($_GET, $_POST);
    }

    // Chỉ lấy các field cần thiết để tránh xử lý thừa dữ liệu form.
    public function only(array $keys): array
    {
        $data = [];

        foreach ($keys as $key) {
            $data[$key] = $this->input($key);
        }

        return $data;
    }
}
