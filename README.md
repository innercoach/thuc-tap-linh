# Landing Page Tuyển Sinh - Custom PHP MVC

Đây là dự án Landing Page tuyển sinh được xây dựng bằng PHP thuần theo mô hình Custom MVC, sử dụng MySQL để lưu dữ liệu đăng ký và PHP Session để quản lý đăng nhập admin.

## 1. Yêu cầu hệ thống, môi trường

Để chạy dự án trên một môi trường mới, máy cần có:

- PHP 8.x
- MySQL 8.x hoặc tương đương
- Apache hoặc PHP built-in server
- Trình duyệt web hiện đại

Khuyến nghị cho môi trường local:

- macOS / Linux / Windows
- Apache 2.4+
- PHP CLI để kiểm tra và chạy local server

## 2. Cách cài đặt và khởi chạy dự án

### Bước 1: clone hoặc copy source code

Đặt source code vào một thư mục làm việc, ví dụ:

```bash
/path/to/project
```

### Bước 2: tạo file `.env`

Copy file mẫu:

```bash
cp .env.example .env
```

Sau đó chỉnh lại thông tin database nếu cần:

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

SESSION_NAME=landing_page_session
SESSION_LIFETIME=0
SESSION_IDLE_TIMEOUT=1800
SESSION_PATH=/
SESSION_DOMAIN=
SESSION_SECURE=false
SESSION_HTTPONLY=true
SESSION_SAMESITE=Lax
```

### Bước 3: tạo database

Có thể import file SQL mẫu đã chuẩn bị sẵn:

```bash
mysql -uroot < ops/sql/landing_page_db.example.sql
```

Nếu MySQL của bạn có mật khẩu:

```bash
mysql -uroot -p < ops/sql/landing_page_db.example.sql
```

### Bước 4: khởi chạy dự án

#### Cách 1: chạy bằng PHP built-in server

```bash
php -S 127.0.0.1:8000 -t public public/index.php
```

Truy cập:

- `http://127.0.0.1:8000/`
- `http://127.0.0.1:8000/admin/login`

#### Cách 2: chạy bằng Apache local

Dự án đã có file cấu hình mẫu trong thư mục `ops/apache/`.

Nếu dùng Apache trên local:

```bash
sudo cp /path/to/project/ops/apache/landing-page.conf /etc/apache2/other/landing-page.conf
sudo apachectl configtest
sudo apachectl -k restart
```

Truy cập:

- `http://localhost:8080/`

Lưu ý:

- Apache phải trỏ `DocumentRoot` vào thư mục `public/`
- phải bật `rewrite_module`
- phải cho phép `.htaccess` với `AllowOverride All`

## 3. Tài khoản đăng nhập mặc định đã tạo

Hệ thống đã có sẵn tài khoản admin mặc định:

- `username`: `admin`
- `password`: `saduqkl)2.`

Trang đăng nhập:

- `/admin/login`

Dashboard admin:

- `/admin/dashboard`

## 4. Cấu trúc thư mục và mô tả chức năng chính

```text
app/
├── Controllers/
├── Core/
├── Models/
└── Views/
bootstrap/
config/
docs/
ops/
public/
routes/
themes/
```

### `app/Controllers`

Chứa các controller xử lý request:

- `HomeController.php`: hiển thị landing page, xử lý form đăng ký
- `AuthController.php`: đăng nhập, đăng xuất admin
- `DashboardController.php`: hiển thị dashboard admin

### `app/Core`

Chứa các lớp lõi của hệ thống:

- `Router.php`: điều hướng URL
- `Database.php`: kết nối PDO theo Singleton
- `Request.php`: xử lý dữ liệu request
- `Response.php`: hỗ trợ redirect/response
- `Session.php`: thao tác với session
- `Auth.php`: kiểm tra đăng nhập admin
- `Validator.php`: validate dữ liệu đầu vào
- `Csrf.php`: bảo vệ form POST bằng token CSRF

### `app/Models`

Chứa model làm việc với database:

- `AdminModel.php`: lấy dữ liệu admin
- `RegistrationModel.php`: lưu và lấy danh sách đăng ký

### `app/Views`

Chứa giao diện:

- `layouts/`: layout tổng của frontend
- `home/`: view trang chủ
- `auth/`: view đăng nhập admin
- `partials/wranga/`: các phần giao diện được tách từ theme Wranga
- `dashboard.php`: giao diện dashboard admin

### `bootstrap`

Chứa file khởi tạo ứng dụng:

- autoload class
- load `.env`
- nạp config
- start session
- khởi tạo router

### `config`

Chứa cấu hình chính của app:

- `app.php`: cấu hình app, database, session

### `routes`

Chứa khai báo route:

- `web.php`: danh sách route frontend và admin

### `public`

Là web root của dự án:

- `index.php`: entry point chính
- `.htaccess`: rewrite request về router

### `themes`

Chứa theme HTML/CSS/JS gốc:

- `themes/wranga/`

### `ops`

Chứa file hỗ trợ setup môi trường:

- `apache/`: cấu hình Apache mẫu
- `database/`: file `.env` mẫu
- `sql/`: file SQL tạo database

### `docs`

Chứa tài liệu thiết kế hệ thống:

- tổng quan hệ thống
- sơ đồ hệ thống
- thiết kế database
- luồng request
- hướng dẫn chạy local

## Route chính của dự án

- `GET /`: landing page
- `POST /submit`: lưu form đăng ký
- `GET /admin/login`: trang login admin
- `POST /admin/login`: xử lý login
- `GET /admin/logout`: đăng xuất
- `GET /admin/dashboard`: dashboard admin

## Chức năng chính

- Hiển thị landing page tuyển sinh
- Nhận form đăng ký học viên
- Lưu dữ liệu đăng ký vào MySQL
- Admin đăng nhập bằng session
- Dashboard xem danh sách học viên đã đăng ký

## Tài liệu chi tiết

Xem thêm trong thư mục:

- `docs/README.md`
- `docs/system-overview.md`
- `docs/system-diagrams.md`
- `docs/database-design.md`
- `docs/request-flow.md`
- `docs/deployment-local.md`
