# Hướng Dẫn Chạy Local

## 1. Yêu cầu môi trường

Máy local cần có:

- PHP 8.x
- MySQL
- Apache hoặc PHP built-in server

## 2. Cấu hình môi trường

### Bước 1: tạo file `.env`

Copy từ file mẫu:

- `.env.example`
hoặc
- `ops/database/database.example.env`

Ví dụ:

```env
APP_NAME="Landing Page MVC"
APP_URL="http://localhost:8080"
APP_DEBUG=true

DB_HOST=127.0.0.1
DB_PORT=3306
DB_NAME=landing_page_db
DB_USER=root
DB_PASS=
DB_CHARSET=utf8mb4
```

## 3. Tạo database

Có thể import file SQL mẫu:

- `ops/sql/landing_page_db.example.sql`

Ví dụ:

```bash
mysql -uroot < ops/sql/landing_page_db.example.sql
```

## 4. Chạy bằng PHP built-in server

Lệnh:

```bash
php -S 127.0.0.1:8000 -t public public/index.php
```

Truy cập:

- `http://127.0.0.1:8000/`
- `http://127.0.0.1:8000/admin/login`

## 5. Chạy bằng Apache local

File cấu hình hỗ trợ:

- `ops/apache/landing-page.conf`
- `ops/apache/landing-page.example.conf`

### Cách dùng nhanh

```bash
sudo cp /duong-dan-toi-du-an/ops/apache/landing-page.conf /etc/apache2/other/landing-page.conf
sudo apachectl configtest
sudo apachectl -k restart
```

Truy cập:

- `http://localhost:8080/`

## 6. Tài khoản admin mặc định

- `username`: `admin`
- `password`: `saduqkl)2.`

## 7. Kiểm tra nhanh sau khi chạy

### Frontend

- vào landing page
- kéo xuống form đăng ký
- nhập thử dữ liệu
- kiểm tra dữ liệu có xuất hiện trong database không

### Admin

- vào `/admin/login`
- đăng nhập bằng tài khoản mặc định
- vào dashboard xem bảng danh sách đăng ký

## 8. Các lỗi local thường gặp

### Lỗi không kết nối database

Nguyên nhân thường gặp:

- MySQL chưa chạy
- sai `DB_HOST`, `DB_PORT`, `DB_USER`, `DB_PASS`
- database `landing_page_db` chưa được tạo

### Lỗi route không chạy với Apache

Nguyên nhân thường gặp:

- Apache chưa trỏ đúng `DocumentRoot` tới `public/`
- chưa bật rewrite module
- `.htaccess` chưa được phép hoạt động vì `AllowOverride All` chưa bật

### Lỗi vào dashboard bị đá về login

Nguyên nhân thường gặp:

- session chưa được lưu đúng
- trình duyệt chặn cookie
- login chưa thành công do sai bcrypt hash hoặc sai password

## 9. Gợi ý cho giáo viên hoặc người chấm bài

Khi cần kiểm tra nhanh dự án:

1. Mở landing page
2. Submit một bản ghi mới
3. Đăng nhập admin
4. Kiểm tra dashboard có hiển thị bản ghi vừa tạo hay không
