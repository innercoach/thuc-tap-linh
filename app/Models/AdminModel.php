<?php
/*
|-----------------------------------------------------------------------
| AdminModel
|-----------------------------------------------------------------------
| File này làm việc với bảng admins trong database.
| Ở phiên bản hiện tại, model này chủ yếu phục vụ chức năng login admin
| bằng cách tìm tài khoản theo username.
*/

namespace App\Models;

use App\Core\Model;

class AdminModel extends Model
{
    // Tìm đúng 1 admin theo username để phục vụ bước login.
    public function getAdminByUsername(string $username): array|false
    {
        $sql = 'SELECT id, username, password, created_at FROM admins WHERE username = :username LIMIT 1';
        $statement = $this->db->prepare($sql);
        $statement->execute([
            ':username' => $username,
        ]);

        return $statement->fetch();
    }
}
