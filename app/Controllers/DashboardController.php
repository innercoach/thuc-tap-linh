<?php
/*
|-----------------------------------------------------------------------
| DashboardController
|-----------------------------------------------------------------------
| File này xử lý trang dashboard quản trị.
| Controller sẽ kiểm tra admin đã đăng nhập hay chưa, sau đó lấy danh
| sách đăng ký từ database và truyền xuống view dashboard.
*/

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Auth;
use App\Core\Session;
use App\Models\RegistrationModel;

class DashboardController extends Controller
{
    // Constructor đóng vai trò guard: mọi action trong controller này đều cần login.
    public function __construct()
    {
        parent::__construct();
        Auth::requireAdmin();
    }

    // Lấy danh sách đăng ký và truyền xuống view dashboard.
    public function index(): void
    {
        $registrations = (new RegistrationModel())->getAllRegistrations();

        $this->view('dashboard', [
            'registrations' => $registrations,
            'success' => Session::getFlash('success'),
        ]);
    }
}
