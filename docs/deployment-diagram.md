# Biểu Đồ Triển Khai

Tài liệu này mô tả cách hệ thống được triển khai trên môi trường local hoặc môi trường chạy thật đơn giản.

## 1. Mô hình triển khai local

```mermaid
flowchart TD
    A["Trình duyệt người dùng"]
    B["Apache hoặc PHP Built-in Server"]
    C["public/index.php"]
    D["Ứng dụng PHP MVC"]
    E["MySQL Server"]
    F["Thư mục themes/wranga/assets"]

    A --> B
    B --> C
    C --> D
    D --> E
    B --> F
```

## 2. Mô hình triển khai chi tiết

```mermaid
flowchart LR
    subgraph Client
        Browser["Browser"]
    end

    subgraph WebServer
        Apache["Apache / PHP Built-in"]
        Public["public/"]
        Index["public/index.php"]
        Assets["themes assets"]
    end

    subgraph App
        Bootstrap["bootstrap/app.php"]
        Routes["routes/web.php"]
        Controllers["Controllers"]
        Models["Models"]
        Views["Views"]
        Core["Core classes"]
    end

    subgraph Data
        MySQL["MySQL"]
    end

    Browser --> Apache
    Apache --> Public
    Public --> Index
    Index --> Bootstrap
    Bootstrap --> Routes
    Routes --> Controllers
    Controllers --> Models
    Controllers --> Views
    Models --> Core
    Models --> MySQL
    Apache --> Assets
```

## 3. Giải thích các node triển khai

### Trình duyệt

Là nơi người dùng hoặc admin truy cập hệ thống.

### Web server

Có thể là:

- Apache
- PHP built-in server khi chạy local

Vai trò:

- nhận request từ browser
- trả asset tĩnh
- chuyển request động vào `public/index.php`

### Ứng dụng PHP MVC

Bao gồm:

- bootstrap
- routes
- core
- controllers
- models
- views

### MySQL

Là nơi lưu:

- tài khoản admin
- dữ liệu đăng ký học viên

## 4. Biểu đồ triển khai theo môi trường mới

```mermaid
flowchart TD
    A["Máy phát triển mới"]
    A --> B["Cài PHP"]
    A --> C["Cài MySQL"]
    A --> D["Cài Apache hoặc dùng php -S"]
    A --> E["Copy source code dự án"]
    E --> F["Tạo file .env"]
    E --> G["Import file SQL mẫu"]
    F --> H["Khởi chạy ứng dụng"]
    G --> H
    H --> I["Browser truy cập hệ thống"]
```

## 5. Kết luận

Biểu đồ triển khai cho thấy hệ thống có kiến trúc triển khai đơn giản:

- 1 web server
- 1 ứng dụng PHP
- 1 database MySQL

Đây là mô hình phù hợp với:

- đồ án môn học
- project demo
- hệ thống landing page quy mô nhỏ

Nếu phát triển thêm trong tương lai, có thể mở rộng theo hướng:

- tách web server và app server
- thêm reverse proxy
- thêm logging service
- thêm backup database
