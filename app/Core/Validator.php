<?php
/*
|-----------------------------------------------------------------------
| Validator
|-----------------------------------------------------------------------
| File này chứa bộ kiểm tra dữ liệu đầu vào đơn giản cho project.
| Hiện tại nó hỗ trợ các rule cơ bản như:
| - required
| - min
| - email
| - phone
*/

namespace App\Core;

class Validator
{
    // Validator nhỏ gọn cho project học MVC: đủ dùng cho required/email/phone/min.
    public static function validate(array $data, array $rules): array
    {
        $errors = [];

        foreach ($rules as $field => $fieldRules) {
            $value = trim((string) ($data[$field] ?? ''));

            foreach ($fieldRules as $rule) {
                if ($rule === 'required' && $value === '') {
                    $errors[$field] = 'Truong nay la bat buoc.';
                    break;
                }

                if (str_starts_with($rule, 'min:')) {
                    $min = (int) substr($rule, 4);

                    if ($value !== '' && mb_strlen($value) < $min) {
                        $errors[$field] = 'Do dai toi thieu la ' . $min . ' ky tu.';
                        break;
                    }
                }

                if ($rule === 'email' && $value !== '' && filter_var($value, FILTER_VALIDATE_EMAIL) === false) {
                    $errors[$field] = 'Email khong hop le.';
                    break;
                }

                if ($rule === 'phone' && $value !== '' && preg_match('/^[0-9+\\-\\s]{8,20}$/', $value) !== 1) {
                    $errors[$field] = 'So dien thoai khong hop le.';
                    break;
                }
            }
        }

        return $errors;
    }
}
