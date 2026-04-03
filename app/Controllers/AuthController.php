<?php
/*
|-----------------------------------------------------------------------
| AuthController
|-----------------------------------------------------------------------
| File này xử lý chức năng đăng nhập và đăng xuất admin.
| - login(): hiển thị form đăng nhập.
| - processLogin(): kiểm tra dữ liệu form và tạo session đăng nhập.
| - logout(): hủy session admin và quay về trang login.
*/

namespace App\Controllers;

use App\Core\Auth;
use App\Core\Controller;
use App\Core\Csrf;
use App\Core\Session;
use App\Core\Validator;
use App\Models\AdminModel;

class AuthController extends Controller
{
    // Hiển thị form login; nếu đã login thì đi thẳng vào dashboard.
    public function login(): void
    {
        if (Auth::checkAdmin()) {
            $this->redirect('/admin/dashboard');
        }

        $this->view('auth/login', [
            'error' => Session::getFlash('error'),
            'success' => Session::getFlash('success'),
            'csrfField' => Csrf::field(),
        ]);
    }

    // Xử lý đăng nhập admin bằng username + password bcrypt.
    public function processLogin(): void
    {
        if (!Csrf::validate($this->request->input('_token'))) {
            Session::flash('error', 'Phien dang nhap da het han. Vui long thu lai.');
            $this->redirect('/admin/login');
        }

        $data = [
            'username' => trim((string) $this->request->input('username', '')),
            'password' => (string) $this->request->input('password', ''),
        ];

        $errors = Validator::validate($data, [
            'username' => ['required', 'min:3'],
            'password' => ['required', 'min:6'],
        ]);

        if ($errors !== []) {
            Session::flash('error', reset($errors));
            $this->redirect('/admin/login');
        }

        $admin = (new AdminModel())->getAdminByUsername($data['username']);

        if (!$admin || !password_verify($data['password'], $admin['password'])) {
            Session::flash('error', 'Thong tin dang nhap khong dung.');
            $this->redirect('/admin/login');
        }

        Auth::loginAdmin($admin);
        Session::flash('success', 'Dang nhap thanh cong.');
        $this->redirect('/admin/dashboard');
    }

    // Logout rồi quay lại màn hình login.
    public function logout(): void
    {
        Auth::logoutAdmin();
        session_start();
        Session::flash('success', 'Dang xuat thanh cong.');
        $this->redirect('/admin/login');
    }
}
