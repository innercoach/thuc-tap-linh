<?php
/*
|-----------------------------------------------------------------------
| Model
|-----------------------------------------------------------------------
| Đây là lớp cha cho mọi model trong dự án.
| Khi một model kế thừa class này, nó sẽ tự có thuộc tính $db là kết
| nối PDO để thực hiện query với database.
*/

namespace App\Core;

use PDO;

class Model
{
    protected PDO $db;

    // Model con chỉ cần extends Model là có ngay kết nối PDO.
    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }
}
