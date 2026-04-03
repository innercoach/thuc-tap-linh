<?php
/*
|-----------------------------------------------------------------------
| RegistrationModel
|-----------------------------------------------------------------------
| File này làm việc với bảng registrations.
| Nó chịu trách nhiệm:
| - lưu thông tin đăng ký từ landing page
| - lấy danh sách đăng ký để hiển thị trong dashboard admin
*/

namespace App\Models;

use App\Core\Model;

class RegistrationModel extends Model
{
    // Lưu thông tin form tuyển sinh vào bảng registrations.
    public function insertRegistration(array $data): bool
    {
        $sql = 'INSERT INTO registrations (full_name, phone, email, course_name)
                VALUES (:full_name, :phone, :email, :course_name)';

        $statement = $this->db->prepare($sql);

        return $statement->execute([
            ':full_name' => $data['full_name'],
            ':phone' => $data['phone'],
            ':email' => $data['email'],
            ':course_name' => $data['course_name'],
        ]);
    }

    // Dashboard admin dùng hàm này để đổ dữ liệu ra bảng.
    public function getAllRegistrations(): array
    {
        $sql = 'SELECT id, full_name, phone, email, course_name, created_at
                FROM registrations
                ORDER BY created_at DESC, id DESC';

        $statement = $this->db->query($sql);

        return $statement->fetchAll();
    }
}
