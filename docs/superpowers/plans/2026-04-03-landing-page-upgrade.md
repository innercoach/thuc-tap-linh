# Plan: Upgrade Landing Page PHP MVC

## Current State

- Entry point ở `index.php`, tự autoload class và tự khai báo route.
- `app/Core/Router.php` chỉ hỗ trợ map route tĩnh GET/POST.
- `app/Core/Database.php` dùng PDO Singleton, cấu hình lấy từ `app/Core/config.php`.
- Landing page render bằng cách đọc trực tiếp `themes/wranga/index.html` rồi `str_replace` trong `app/Views/home/index.php`.
- Admin auth dùng `$_SESSION['admin_logged_in']` và chặn truy cập dashboard trong constructor của `app/Controllers/DashboardController.php`.
- Model đã có prepared statement cho insert registration và query admin theo username.
- Chưa có cấu trúc public web root, middleware, request/response abstraction, logging, CSRF protection, validation layer, test harness, migration/seeder, hoặc cơ chế debug chuẩn.

## Goals

1. Logic rõ ràng hơn, ít phụ thuộc vào xử lý string trong view.
2. Dễ phát hiện lỗi và tái hiện lỗi.
3. Bảo mật tốt hơn cho form và admin area.
4. Dễ test thủ công và tự động.
5. Dễ mở rộng thêm module sau này.

## Files To Create Or Modify

### Bootstrap / Entry

- `public/index.php`
  - Web entry point chuẩn.
  - Load bootstrap, session, routes.
- `index.php`
  - Giữ lại tạm thời để compatibility hoặc chuyển thành file redirect/bootstrap mỏng.
- `bootstrap/app.php`
  - Khởi tạo autoload, config, error handling, session, router.
- `routes/web.php`
  - Tách khai báo route khỏi entry point.

### Config / Environment

- `app/Core/config.php`
  - Giữ config mặc định tối thiểu hoặc chuyển một phần sang env.
- `.env.example`
  - Mẫu biến môi trường DB, app url, debug.
- `app/Core/Env.php`
  - Loader đọc `.env`.

### Core

- `app/Core/Router.php`
  - Bổ sung route groups, named routes hoặc middleware hooks tối thiểu.
- `app/Core/Request.php`
  - Đọc query, post, method, uri một cách thống nhất.
- `app/Core/Response.php`
  - Chuẩn hóa `redirect`, `json`, `view`, status code.
- `app/Core/Session.php`
  - Wrapper cho session, flash message.
- `app/Core/Validator.php`
  - Validate dữ liệu form tập trung.
- `app/Core/Auth.php`
  - Check trạng thái admin login thay vì dùng session raw ở nhiều chỗ.
- `app/Core/View.php`
  - Render view/layout nhất quán.
- `app/Core/ExceptionHandler.php`
  - Bắt exception và log lỗi.
- `app/Core/Logger.php`
  - Ghi log file đơn giản vào `storage/logs/app.log`.

### Controllers

- `app/Controllers/HomeController.php`
  - Giữ trách nhiệm trang chủ và submit form.
  - Bỏ logic trình bày khỏi controller.
- `app/Controllers/AuthController.php`
  - Thêm redirect rõ ràng, flash message, session regeneration sau login.
- `app/Controllers/DashboardController.php`
  - Chỉ giữ logic lấy dữ liệu dashboard.
- `app/Controllers/BaseController.php` hoặc dùng `app/Core/Controller.php`
  - Hỗ trợ render layout, flash, redirect.

### Models / Repositories

- `app/Models/RegistrationModel.php`
  - Tách insert/list, thêm pagination và filter về sau.
- `app/Models/AdminModel.php`
  - Giữ truy vấn admin.
- `app/Repositories/RegistrationRepository.php`
  - Tùy chọn, nếu muốn tách query khỏi model.

### Views

- `app/Views/layouts/main.php`
  - Layout chung frontend.
- `app/Views/layouts/admin.php`
  - Layout chung admin.
- `app/Views/home/index.php`
  - Chuyển từ `file_get_contents + str_replace` sang PHP view sạch hơn.
- `app/Views/auth/login.php`
  - Hiển thị lỗi/thông báo.
- `app/Views/dashboard/index.php`
  - Tách riêng dashboard view và hỗ trợ empty state.
- `app/Views/partials/...`
  - Header, footer, alerts, form fragments.

### Theme / Public Assets

- `public/themes/wranga/...`
  - Chuyển assets ra public web root.
- `themes/wranga/index.html`
  - Giữ làm nguồn tham chiếu, không render trực tiếp trong runtime.

### Error Handling / Storage

- `storage/logs/.gitkeep`
- `storage/cache/.gitkeep`

### Tests / Tooling

- `phpunit.xml`
- `tests/Feature/HomeSubmitTest.php`
- `tests/Feature/AdminLoginTest.php`
- `tests/Feature/DashboardAccessTest.php`
- `tests/Unit/RegistrationModelTest.php`
- `composer.json`
  - Autoload PSR-4, phpunit, dotenv nếu dùng.

### Infra / Docs

- `.htaccess` hoặc cấu hình virtual host trỏ về `public/`
- `README.md`
  - Cách chạy local, DB setup, login admin, route list, test commands.

## Phased Plan

### Phase 1: Ổn định kiến trúc nền

#### Task 1.1: Tách bootstrap khỏi `index.php`

- Tạo `bootstrap/app.php` và `routes/web.php`.
- Giữ `index.php` mỏng, chỉ require bootstrap và dispatch.
- Mục tiêu:
  - Entry point rõ ràng.
  - Route không còn lẫn với bootstrap.
- Test:
  - Truy cập `/`, `/admin/login`, `/admin/dashboard`.
  - Gửi POST `/submit`.

#### Task 1.2: Chuẩn hóa web root `public/`

- Tạo `public/index.php`.
- Chuyển asset công khai vào `public/themes/wranga/assets`.
- Nếu cần, giữ symlink hoặc copy strategy cho theme.
- Mục tiêu:
  - Không lộ toàn bộ source PHP ra web root.
  - Asset path đơn giản hơn.
- Test:
  - CSS, JS, image load thành công trên landing page.
  - Route vẫn hoạt động khi webserver trỏ vào `public/`.

#### Task 1.3: Thêm `.env` và loader config

- DB host, port, name, user, pass lấy từ env.
- Có fallback an toàn cho local dev.
- Mục tiêu:
  - Tách config nhạy cảm khỏi code.
- Test:
  - Đổi DB name qua `.env` và xác nhận app kết nối được.

### Phase 2: Làm sạch luồng request/response

#### Task 2.1: Tạo `Request` và `Response`

- `Request` cung cấp `input()`, `method()`, `uri()`, `all()`.
- `Response` cung cấp `redirect()`, `view()`, `setStatusCode()`.
- Mục tiêu:
  - Không dùng raw `$_POST`, `$_SERVER`, `header()` rải rác.
- Test:
  - Login, logout, submit registration, redirect sau action.

#### Task 2.2: Thêm `Session` wrapper và flash message

- Hỗ trợ `set`, `get`, `forget`, `flash`.
- Mục tiêu:
  - Trạng thái thông báo form nhất quán, debug dễ hơn.
- Test:
  - Login fail hiển thị flash error.
  - Submit thành công hiển thị flash success một lần.

#### Task 2.3: Tạo `Auth` helper

- `checkAdmin()`, `loginAdmin()`, `logoutAdmin()`, `requireAdmin()`.
- Mục tiêu:
  - Không để auth logic trôi nổi trong controller.
- Test:
  - Vào `/admin/dashboard` khi chưa login bị redirect.
  - Login xong vào dashboard được.

### Phase 3: Tăng độ an toàn dữ liệu và bảo mật

#### Task 3.1: Validation tập trung

- Tạo `Validator` cho registration:
  - `full_name`: required, min length.
  - `phone`: required, regex cơ bản.
  - `email`: required, valid email.
  - `course_name`: required.
- Tạo validation cho login:
  - `username`, `password` required.
- Mục tiêu:
  - Dễ kiểm tra lỗi nhập liệu.
  - Không lặp validation trong controller.
- Test:
  - Submit thiếu field.
  - Email sai định dạng.
  - Login thiếu username/password.

#### Task 3.2: CSRF protection

- Sinh token trong session.
- Chèn hidden input vào form frontend và admin login.
- Verify token ở mọi POST route.
- Mục tiêu:
  - Chặn request giả mạo.
- Test:
  - Submit không có token phải fail `419` hoặc redirect lỗi.

#### Task 3.3: Cứng hóa session admin

- `session_regenerate_id(true)` sau login.
- Cookie session cấu hình `httponly`, `samesite`, `secure` khi phù hợp.
- Có thể thêm timeout idle cho admin.
- Mục tiêu:
  - Giảm rủi ro session fixation.
- Test:
  - Login thành công tạo session mới.
  - Logout xóa session đúng.

### Phase 4: Refactor view để dễ bảo trì và debug

#### Task 4.1: Dừng render theme bằng `file_get_contents + str_replace`

- Tách `themes/wranga/index.html` thành:
  - `app/Views/layouts/main.php`
  - `app/Views/home/index.php`
  - partials cho sections và form.
- Giữ nguyên markup/theme nhiều nhất có thể.
- Mục tiêu:
  - Thay đổi form hoặc text không phải dùng regex/string replace.
  - Lỗi render dễ xác định vị trí hơn.
- Test:
  - So khớp giao diện trước và sau refactor.
  - Form submit vẫn đúng.

#### Task 4.2: Tách layout admin

- Tạo `layouts/admin.php`.
- `dashboard/index.php`, `auth/login.php` dùng layout thống nhất.
- Mục tiêu:
  - Dễ mở rộng thêm quản trị sau này.
- Test:
  - Login page và dashboard render đúng layout.

### Phase 5: Dễ kiểm lỗi và quan sát runtime

#### Task 5.1: Error handler + log file

- Bắt exception và warning quan trọng.
- Ghi log vào `storage/logs/app.log`.
- Nếu `APP_DEBUG=true`, hiển thị stack trace dev-friendly.
- Nếu production, trả trang lỗi an toàn.
- Mục tiêu:
  - Khi lỗi xảy ra biết chính xác request nào lỗi ở đâu.
- Test:
  - Cố tình làm DB sai để kiểm tra log.
  - Cố tình throw exception trong controller.

#### Task 5.2: Route 404/405 rõ ràng

- Trả view lỗi hoặc response chuẩn.
- Mục tiêu:
  - Không `exit('404 - Page not found')` cứng.
- Test:
  - Truy cập route không tồn tại.
  - Gửi POST vào route chỉ hỗ trợ GET.

#### Task 5.3: Logging cho action nhạy cảm

- Log login fail, login success, submit registration fail.
- Không log password.
- Mục tiêu:
  - Điều tra lỗi vận hành nhanh hơn.
- Test:
  - Sai password có dòng log.

### Phase 6: Dễ kiểm thử bằng automation

#### Task 6.1: Thiết lập Composer + PHPUnit

- Tạo `composer.json` với PSR-4 autoload cho `App\\` và `Tests\\`.
- Cài `phpunit/phpunit`.
- Mục tiêu:
  - Có test runner chuẩn.
- Test:
  - `vendor/bin/phpunit` chạy được.

#### Task 6.2: Viết feature tests cho luồng chính

- `HomeSubmitTest`
  - Submit thành công.
  - Submit thiếu field.
  - Submit sai CSRF.
- `AdminLoginTest`
  - Login đúng.
  - Login sai password.
- `DashboardAccessTest`
  - Chưa login bị redirect.
  - Đã login xem được danh sách.
- Mục tiêu:
  - Phát hiện regression sớm.

#### Task 6.3: Seed dữ liệu test

- SQL seed hoặc PHP seed cho admin mặc định và vài registrations.
- Mục tiêu:
  - Kiểm thử lặp lại được.
- Test:
  - Reset DB local nhanh.

### Phase 7: Nâng cấp nghiệp vụ admin

#### Task 7.1: Thêm phân trang và tìm kiếm dashboard

- Lọc theo tên, email, khóa học.
- Phân trang nếu dữ liệu lớn.
- Mục tiêu:
  - Dashboard usable hơn khi số lượng đăng ký tăng.
- Test:
  - Query filter đúng.
  - Chuyển trang không mất filter.

#### Task 7.2: Thêm export CSV

- Admin có thể tải danh sách đăng ký.
- Mục tiêu:
  - Phục vụ vận hành tuyển sinh.
- Test:
  - CSV đúng header và data.

#### Task 7.3: Thêm audit cơ bản

- Lưu thời điểm đăng nhập admin gần nhất hoặc số lần login fail.
- Mục tiêu:
  - Điều tra sự cố tốt hơn.

## Debug Checklist

### Khi form đăng ký lỗi

- Kiểm tra route POST `/submit`.
- Kiểm tra tên input có đúng `full_name`, `phone`, `email`, `course_name`.
- Kiểm tra token CSRF nếu đã bật.
- Kiểm tra log DB insert fail.
- Kiểm tra DB table `registrations`.

### Khi admin login lỗi

- Kiểm tra record trong bảng `admins`.
- Kiểm tra hash bcrypt và `password_verify`.
- Kiểm tra session đã start chưa.
- Kiểm tra cookie session trong browser.
- Kiểm tra log login fail.

### Khi dashboard không vào được

- Kiểm tra `$_SESSION['admin_logged_in']`.
- Kiểm tra redirect loop do route/middleware.
- Kiểm tra query `getAllRegistrations()`.
- Kiểm tra DB connection và logs.

## Recommended Execution Order

1. Phase 1: Ổn định kiến trúc nền.
2. Phase 2: Chuẩn hóa request/response/session.
3. Phase 3: Bảo mật và validation.
4. Phase 4: Refactor views/theme integration.
5. Phase 5: Logging và error handling.
6. Phase 6: Composer + PHPUnit + test data.
7. Phase 7: Tính năng admin nâng cao.

## Acceptance Criteria

- Có web root chuẩn `public/` và routes tách riêng.
- Frontend submit và admin login/dashboard chạy ổn sau refactor.
- Mọi POST route có validation và CSRF.
- Mọi lỗi chính được log file.
- Có ít nhất 3 feature tests cho registration, login, dashboard access.
- Theme không còn render bằng `file_get_contents + str_replace`.
- README mô tả được cách chạy, seed DB, test, debug.
