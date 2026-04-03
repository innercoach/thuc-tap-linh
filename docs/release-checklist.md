# Release Checklist v1

Tài liệu này dùng để kiểm tra nhanh trước khi bàn giao hoặc nộp bài.

## 1. Kiểm tra môi trường

- Có PHP 8.x
- Có MySQL
- Có file `.env`
- Đã import SQL mẫu
- Web server trỏ đúng vào `public/`

## 2. Kiểm tra frontend

- Mở landing page được
- CSS load đúng, không vỡ giao diện
- Ảnh load đúng, không 404
- Form đăng ký hiển thị đầy đủ các field

## 3. Kiểm tra chức năng đăng ký

- Gửi form với dữ liệu hợp lệ
- Dữ liệu được lưu vào bảng `registrations`
- Submit thiếu dữ liệu thì có thông báo lỗi
- Token CSRF sai thì hệ thống từ chối request

## 4. Kiểm tra admin

- Vào được `/admin/login`
- Đăng nhập bằng tài khoản mặc định thành công
- Vào được `/admin/dashboard`
- Dashboard hiển thị danh sách đăng ký
- Logout hoạt động

## 5. Kiểm tra tài liệu

- `README.md` root có hướng dẫn chạy
- `docs/README.md` có đầy đủ link tài liệu
- Có sơ đồ hệ thống, use case, database, deployment
- `ops/` có đủ file mẫu Apache, env, SQL

## 6. Kiểm tra source code

- Không còn file rác như `.DS_Store`
- Không commit file `.env`
- Có `.gitignore`
- Có `CHANGELOG.md`
- Có `VERSION`
