# Tổng Quan Hệ Thống

## 1. Giới thiệu

Đây là dự án Landing Page tuyển sinh được xây dựng bằng:

- PHP thuần
- Custom MVC
- MySQL
- Apache hoặc PHP built-in server
- Theme giao diện Wranga được tích hợp vào phần View

Mục tiêu của hệ thống là:

- Hiển thị landing page tuyển sinh
- Nhận dữ liệu đăng ký học viên
- Lưu dữ liệu vào database
- Cho phép admin đăng nhập để xem danh sách đăng ký

## 2. Kiến trúc tổng thể

Dự án sử dụng mô hình MVC tự xây dựng:

- `Model`: làm việc với database
- `View`: hiển thị giao diện
- `Controller`: xử lý request và điều phối model/view
- `Core`: chứa các lớp lõi như Router, Database, Request, Response, Session, Auth, Validator, Csrf

Luồng cơ bản:

1. Trình duyệt gửi request vào `public/index.php`
2. `bootstrap/app.php` khởi tạo ứng dụng
3. `routes/web.php` định tuyến request
4. Router gọi đúng controller tương ứng
5. Controller xử lý nghiệp vụ, gọi model nếu cần
6. Model thao tác MySQL bằng PDO
7. Controller trả view hoặc redirect về trình duyệt

## 3. Cấu trúc thư mục chính

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

### Giải thích

- `app/Controllers`: chứa controller xử lý request
- `app/Core`: chứa các lớp lõi của framework MVC tự viết
- `app/Models`: chứa model làm việc với bảng dữ liệu
- `app/Views`: chứa giao diện frontend và admin
- `bootstrap`: khởi tạo ứng dụng
- `config`: cấu hình app, database, session
- `public`: web root cho Apache/PHP server
- `routes`: khai báo route
- `themes`: chứa theme HTML/CSS/JS gốc
- `ops`: chứa file hỗ trợ cấu hình môi trường và SQL mẫu
- `docs`: tài liệu thiết kế hệ thống

## 4. Thành phần nghiệp vụ chính

### 4.1 Frontend landing page

Chức năng:

- Hiển thị giao diện tuyển sinh
- Có form đăng ký học viên
- Kiểm tra CSRF và validate dữ liệu đầu vào

File liên quan:

- `app/Controllers/HomeController.php`
- `app/Models/RegistrationModel.php`
- `app/Views/layouts/main.php`
- `app/Views/home/index.php`
- `app/Views/partials/wranga/*`

### 4.2 Admin authentication

Chức năng:

- Hiển thị form đăng nhập
- Kiểm tra username/password
- Dùng `password_verify()` để so sánh hash bcrypt
- Tạo và hủy session admin

File liên quan:

- `app/Controllers/AuthController.php`
- `app/Models/AdminModel.php`
- `app/Core/Auth.php`
- `app/Core/Session.php`
- `app/Core/Csrf.php`
- `app/Views/auth/login.php`

### 4.3 Admin dashboard

Chức năng:

- Chỉ cho phép admin đã đăng nhập truy cập
- Lấy danh sách học viên đăng ký
- Hiển thị ra bảng HTML

File liên quan:

- `app/Controllers/DashboardController.php`
- `app/Models/RegistrationModel.php`
- `app/Views/dashboard.php`

## 5. Các lớp lõi của hệ thống

### `Router`

Nhiệm vụ:

- Đăng ký route GET và POST
- Chuẩn hóa URL
- Tìm route phù hợp và gọi controller

### `Database`

Nhiệm vụ:

- Tạo kết nối PDO tới MySQL
- Dùng Singleton để tái sử dụng một kết nối chung

### `Request`

Nhiệm vụ:

- Lấy method
- Lấy URI
- Lấy dữ liệu từ GET/POST

### `Response`

Nhiệm vụ:

- Redirect
- Thiết lập HTTP status code
- Trả text response

### `Session`

Nhiệm vụ:

- Lưu trạng thái người dùng
- Tạo flash message
- Xóa session khi logout

### `Auth`

Nhiệm vụ:

- Kiểm tra admin đã đăng nhập hay chưa
- Lưu session admin
- Chặn truy cập dashboard khi chưa đăng nhập

### `Validator`

Nhiệm vụ:

- Kiểm tra dữ liệu form trước khi lưu database

### `Csrf`

Nhiệm vụ:

- Tạo token CSRF
- Gắn token vào form
- Kiểm tra token khi submit

## 6. Điểm mạnh của thiết kế hiện tại

- Tách rõ MVC
- Có lớp lõi riêng, không viết tất cả vào một file
- Có CSRF protection
- Có validation đầu vào
- Có session-based authentication cho admin
- Tách route và bootstrap rõ ràng
- Tách theme thành layout và partials để dễ bảo trì

## 7. Hạn chế hiện tại

- Router hiện mới hỗ trợ GET và POST cơ bản
- Chưa có middleware riêng
- Chưa có logging và exception handler hoàn chỉnh
- Chưa có unit test/feature test bằng PHPUnit
- Dashboard chưa có tìm kiếm, phân trang, export

## 8. Hướng phát triển tiếp theo

- Bổ sung logger và error handler
- Thêm middleware chuẩn
- Viết test tự động
- Thêm phân trang cho dashboard
- Thêm export CSV
- Tách layout admin riêng
