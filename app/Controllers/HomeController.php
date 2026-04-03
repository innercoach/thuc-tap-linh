<?php
/*
|-----------------------------------------------------------------------
| HomeController
|-----------------------------------------------------------------------
| File này điều khiển landing page ngoài frontend.
| - index(): hiển thị trang chủ.
| - submit(): nhận form đăng ký, kiểm tra dữ liệu, lưu database và
|   chuyển hướng lại trang chủ kèm thông báo.
*/

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Csrf;
use App\Core\Session;
use App\Core\Validator;
use App\Models\RegistrationModel;

class HomeController extends Controller
{
    // Hiển thị landing page và đưa flash message ra view.
    public function index(): void
    {
        $this->render('home/index', [
            'formSuccess' => Session::getFlash('success'),
            'formError' => Session::getFlash('error'),
            'csrfField' => Csrf::field(),
        ]);
    }

    // Nhận dữ liệu form tuyển sinh, kiểm tra hợp lệ rồi lưu vào database.
    public function submit(): void
    {
        if (!Csrf::validate($this->request->input('_token'))) {
            Session::flash('error', 'Phien lam viec da het han. Vui long thu lai.');
            $this->redirect('/#contact');
        }

        $data = array_map('trim', $this->request->only([
            'full_name',
            'phone',
            'email',
            'course_name',
        ]));

        // Chỉ lấy lỗi đầu tiên để hiển thị ngắn gọn cho người dùng.
        $errors = Validator::validate($data, [
            'full_name' => ['required', 'min:2'],
            'phone' => ['required', 'phone'],
            'email' => ['required', 'email'],
            'course_name' => ['required', 'min:2'],
        ]);

        if ($errors !== []) {
            Session::flash('error', reset($errors));
            $this->redirect('/#contact');
        }

        $isSaved = (new RegistrationModel())->insertRegistration($data);

        if (!$isSaved) {
            Session::flash('error', 'Luu du lieu that bai.');
            $this->redirect('/#contact');
        }

        Session::flash('success', 'Dang ky thanh cong. Chung toi se lien he voi ban som nhat.');
        $this->redirect('/#contact');
    }
}
