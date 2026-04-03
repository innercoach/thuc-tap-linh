# Luồng Xử Lý Request

Tài liệu này mô tả mỗi route chính của hệ thống đi qua những file nào.

## 1. Route frontend

### 1.1 `GET /`

Mục đích:

- hiển thị landing page

Luồng xử lý:

1. `public/index.php`
2. `bootstrap/app.php`
3. `routes/web.php`
4. `Router` tìm route `/`
5. `HomeController@index`
6. `render('home/index', ...)`
7. `app/Views/layouts/main.php`
8. các partial của theme Wranga được nạp vào giao diện

File liên quan:

- `public/index.php`
- `bootstrap/app.php`
- `routes/web.php`
- `app/Core/Router.php`
- `app/Controllers/HomeController.php`
- `app/Views/layouts/main.php`
- `app/Views/home/index.php`

### 1.2 `POST /submit`

Mục đích:

- nhận và lưu form đăng ký học viên

Luồng xử lý:

1. user submit form từ landing page
2. `Router` gọi `HomeController@submit`
3. controller kiểm tra CSRF
4. controller validate dữ liệu
5. `RegistrationModel::insertRegistration()`
6. PDO lưu dữ liệu vào bảng `registrations`
7. controller tạo flash message
8. redirect về `/#contact`

File liên quan:

- `app/Controllers/HomeController.php`
- `app/Core/Csrf.php`
- `app/Core/Validator.php`
- `app/Core/Session.php`
- `app/Models/RegistrationModel.php`

## 2. Route admin authentication

### 2.1 `GET /admin/login`

Mục đích:

- hiển thị form đăng nhập admin

Luồng xử lý:

1. `Router` gọi `AuthController@login`
2. controller kiểm tra nếu admin đã login thì redirect dashboard
3. nếu chưa login thì nạp view login
4. view hiển thị token CSRF và flash message

File liên quan:

- `app/Controllers/AuthController.php`
- `app/Core/Auth.php`
- `app/Core/Csrf.php`
- `app/Core/Session.php`
- `app/Views/auth/login.php`

### 2.2 `POST /admin/login`

Mục đích:

- xử lý đăng nhập admin

Luồng xử lý:

1. form login gửi dữ liệu username/password
2. `Router` gọi `AuthController@processLogin`
3. kiểm tra CSRF
4. validate input
5. `AdminModel::getAdminByUsername()`
6. dùng `password_verify()` kiểm tra password
7. nếu đúng thì `Auth::loginAdmin()`
8. tạo session admin
9. redirect đến `/admin/dashboard`

File liên quan:

- `app/Controllers/AuthController.php`
- `app/Core/Auth.php`
- `app/Core/Csrf.php`
- `app/Core/Validator.php`
- `app/Models/AdminModel.php`

### 2.3 `GET /admin/logout`

Mục đích:

- đăng xuất admin

Luồng xử lý:

1. `Router` gọi `AuthController@logout`
2. `Auth::logoutAdmin()` xóa session và cookie session
3. tạo flash message
4. redirect về `/admin/login`

File liên quan:

- `app/Controllers/AuthController.php`
- `app/Core/Auth.php`
- `app/Core/Session.php`

## 3. Route dashboard

### 3.1 `GET /admin/dashboard`

Mục đích:

- hiển thị danh sách học viên đăng ký

Luồng xử lý:

1. `Router` gọi `DashboardController`
2. constructor gọi `Auth::requireAdmin()`
3. nếu chưa login thì redirect `/admin/login`
4. nếu đã login thì gọi `index()`
5. `RegistrationModel::getAllRegistrations()`
6. lấy dữ liệu từ bảng `registrations`
7. truyền dữ liệu sang `dashboard.php`

File liên quan:

- `app/Controllers/DashboardController.php`
- `app/Core/Auth.php`
- `app/Models/RegistrationModel.php`
- `app/Views/dashboard.php`

## 4. Luồng tổng quát của một request

```text
Request từ trình duyệt
-> public/index.php
-> bootstrap/app.php
-> routes/web.php
-> Router
-> Controller
-> Model (nếu cần)
-> View hoặc Redirect
-> Response về trình duyệt
```

## 5. Những điểm kiểm tra lỗi quan trọng

### Khi landing page không hiển thị

Kiểm tra:

- web server có trỏ đúng vào `public/`
- route `GET /` có tồn tại
- layout và partial có đúng đường dẫn

### Khi form đăng ký không lưu

Kiểm tra:

- token CSRF
- validate dữ liệu
- kết nối MySQL
- bảng `registrations`

### Khi admin không login được

Kiểm tra:

- bảng `admins`
- hash bcrypt
- session đã start chưa
- password nhập có đúng không

### Khi dashboard bị redirect liên tục

Kiểm tra:

- `$_SESSION['admin_logged_in']`
- cookie session
- logic trong `Auth::requireAdmin()`
