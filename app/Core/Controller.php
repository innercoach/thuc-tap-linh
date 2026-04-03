<?php
/*
|-----------------------------------------------------------------------
| Controller
|-----------------------------------------------------------------------
| Đây là lớp cha cho mọi controller trong dự án.
| Nó cung cấp sẵn:
| - Request và Response
| - hàm view() để nạp view thường
| - hàm render() để nạp view bên trong layout
| - hàm redirect() để chuyển trang
*/

namespace App\Core;

class Controller
{
    protected Request $request;
    protected Response $response;

    // Controller nào cũng có sẵn request và response để dùng lại.
    public function __construct()
    {
        $this->request = new Request();
        $this->response = new Response();
    }

    // Nạp file view và truyền dữ liệu ra giao diện.
    protected function view(string $path, array $data = []): void
    {
        extract($data);
        require __DIR__ . '/../Views/' . $path . '.php';
    }

    // Render view bên trong layout để tách head/body/partials rõ ràng hơn.
    protected function render(string $view, array $data = [], string $layout = 'layouts/main'): void
    {
        $contentView = __DIR__ . '/../Views/' . $view . '.php';

        extract($data);
        require __DIR__ . '/../Views/' . $layout . '.php';
    }

    protected function redirect(string $url, int $statusCode = 302): never
    {
        $this->response->redirect($url, $statusCode);
    }
}
