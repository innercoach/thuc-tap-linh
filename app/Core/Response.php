<?php
/*
|-----------------------------------------------------------------------
| Response
|-----------------------------------------------------------------------
| File này hỗ trợ trả response về cho trình duyệt.
| Các chức năng chính:
| - redirect sang URL khác
| - đặt HTTP status code
| - trả text đơn giản rồi kết thúc request
*/

namespace App\Core;

class Response
{
    // Redirect là response dùng nhiều nhất sau khi submit form hoặc login.
    public function redirect(string $url, int $statusCode = 302): never
    {
        http_response_code($statusCode);
        header('Location: ' . $url);
        exit;
    }

    public function back(string $default = '/'): never
    {
        $location = $_SERVER['HTTP_REFERER'] ?? $default;
        $this->redirect($location);
    }

    // Dùng khi chỉ muốn đổi mã phản hồi HTTP.
    public function setStatusCode(int $statusCode): void
    {
        http_response_code($statusCode);
    }

    // Trả text thuần rồi dừng script.
    public function text(string $content, int $statusCode = 200): never
    {
        $this->setStatusCode($statusCode);
        echo $content;
        exit;
    }
}
