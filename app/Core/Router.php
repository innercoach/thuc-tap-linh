<?php
/*
|-----------------------------------------------------------------------
| Router
|-----------------------------------------------------------------------
| File này là router tự viết của dự án MVC.
| Nó dùng để:
| - khai báo route GET, POST
| - chuẩn hóa URL
| - tìm action phù hợp
| - gọi controller tương ứng khi có request đi vào
*/

namespace App\Core;

class Router
{
    // Mỗi HTTP method có một bảng route riêng.
    private array $routes = [
        'GET' => [],
        'POST' => [],
    ];

    public function get(string $uri, $action): void
    {
        $this->addRoute('GET', $uri, $action);
    }

    public function post(string $uri, $action): void
    {
        $this->addRoute('POST', $uri, $action);
    }

    private function addRoute(string $method, string $uri, $action): void
    {
        $this->routes[$method][$this->normalizeUri($uri)] = $action;
    }

    // Tìm route khớp với URL hiện tại rồi gọi controller tương ứng.
    public function dispatch(string $uri, string $method): void
    {
        $uri = $this->normalizeUri($uri);
        $action = $this->routes[$method][$uri] ?? null;

        if ($action === null) {
            http_response_code(404);
            exit('404 - Page not found');
        }

        if (is_callable($action)) {
            call_user_func($action);
            return;
        }

        if (is_array($action) && count($action) === 2) {
            [$controller, $handler] = $action;
            $instance = new $controller();
            call_user_func([$instance, $handler]);
        }
    }

    // Chuẩn hóa URL để '/admin/' và '/admin' được hiểu giống nhau.
    private function normalizeUri(string $uri): string
    {
        $uri = parse_url($uri, PHP_URL_PATH) ?: '/';
        $uri = '/' . trim($uri, '/');

        return $uri === '//' ? '/' : $uri;
    }
}
