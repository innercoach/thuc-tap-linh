# Changelog

## v1.0.0 - 2026-04-04

### Hoàn thành

- Xây dựng bộ khung Custom PHP MVC bằng PHP thuần
- Tách rõ `Core`, `Controllers`, `Models`, `Views`
- Kết nối MySQL bằng PDO theo mẫu Singleton
- Xây dựng router GET/POST cơ bản
- Tích hợp landing page từ theme Wranga
- Xử lý form đăng ký và lưu dữ liệu vào bảng `registrations`
- Xây dựng đăng nhập admin bằng PHP Session
- Thêm CSRF protection cho các form POST
- Thêm validate dữ liệu đầu vào
- Xây dựng dashboard admin xem danh sách đăng ký
- Tách frontend thành layout và partials để dễ bảo trì
- Bổ sung file cấu hình mẫu trong `ops/`
- Bổ sung bộ tài liệu thiết kế hệ thống trong `docs/`
- Bổ sung README root để hướng dẫn chạy dự án trên môi trường mới

### Chưa bao gồm

- Logging và exception handler hoàn chỉnh
- PHPUnit hoặc test tự động
- Middleware chuẩn
- Phân trang, tìm kiếm, export CSV cho dashboard
- Cấu hình deploy production hoàn chỉnh
