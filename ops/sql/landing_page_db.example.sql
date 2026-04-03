# ----------------------------------------------------------------------
# SQL Schema Example
# ----------------------------------------------------------------------
# Đây là file SQL mẫu để khởi tạo database landing_page_db.
# File này tạo các bảng cần thiết cho dự án và thêm sẵn tài khoản admin
# mặc định để phục vụ bước đăng nhập quản trị.

CREATE DATABASE IF NOT EXISTS landing_page_db
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;

USE landing_page_db;

CREATE TABLE IF NOT EXISTS admins (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO admins (username, password)
VALUES ('admin', '$2y$10$qA/CYJ0Wad47140mVsmC/ebaV8.AYNqp.UkCsdObmVBWtX6mayqey')
ON DUPLICATE KEY UPDATE
    password = VALUES(password);

CREATE TABLE IF NOT EXISTS registrations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(150) NOT NULL,
    phone VARCHAR(20) NOT NULL,
    email VARCHAR(150) NOT NULL,
    course_name VARCHAR(150) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
