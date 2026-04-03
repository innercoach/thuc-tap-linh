# Phạm Vi Phiên Bản v1

Tài liệu này mô tả rõ phiên bản `v1.0.0` đang bao gồm những gì và chưa bao gồm những gì.

## 1. Mục tiêu của v1

Mục tiêu của `v1` là hoàn thiện một hệ thống landing page tuyển sinh cơ bản nhưng chạy được đầu cuối:

- hiển thị giao diện giới thiệu khóa học
- nhận đăng ký từ người dùng
- lưu dữ liệu vào MySQL
- cho phép admin đăng nhập
- hiển thị danh sách đăng ký trong dashboard

## 2. Chức năng có trong v1

- Landing page frontend
- Form đăng ký học viên
- Kết nối MySQL
- Lưu dữ liệu đăng ký
- Đăng nhập admin bằng session
- Dashboard danh sách đăng ký
- CSRF protection
- Validate dữ liệu đầu vào
- Tài liệu thiết kế hệ thống
- Hướng dẫn chạy local

## 3. Thành phần kỹ thuật có trong v1

- Custom MVC
- Router GET/POST
- PDO Singleton
- Session wrapper
- Auth helper
- Request/Response helper
- Theme Wranga tách thành layout + partials

## 4. Những gì chưa nằm trong v1

- Test tự động bằng PHPUnit
- Logging tập trung
- Exception handler hoàn chỉnh
- Middleware chuẩn tách riêng
- Upload file
- CRUD admin đầy đủ
- Phân trang / tìm kiếm dashboard
- Export CSV / Excel
- Deploy production hoàn chỉnh

## 5. Định hướng cho v2

- thêm logger
- thêm middleware
- thêm test tự động
- cải tiến dashboard
- thêm quản lý khóa học
- chuẩn hóa admin layout riêng
