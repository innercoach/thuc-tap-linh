# Use Case Chi Tiết Cho Các Chức Năng Chính

Tài liệu này đặc tả chi tiết các use case chính của hệ thống.

## 1. UC02 - Gửi form đăng ký

### 1.1 Đặc tả use case

| Thuộc tính | Mô tả |
|---|---|
| Mã use case | UC02 |
| Tên use case | Gửi form đăng ký |
| Actor chính | Khách truy cập |
| Mục tiêu | Gửi thông tin đăng ký khóa học từ landing page |
| Tiền điều kiện | Người dùng đang truy cập landing page |
| Hậu điều kiện | Dữ liệu được lưu vào bảng `registrations` nếu hợp lệ |

### 1.2 Luồng chính

1. Người dùng nhập họ tên, số điện thoại, email, khóa học.
2. Người dùng nhấn nút gửi form.
3. Hệ thống kiểm tra CSRF token.
4. Hệ thống kiểm tra dữ liệu đầu vào.
5. Hệ thống lưu dữ liệu vào database.
6. Hệ thống thông báo đăng ký thành công.

### 1.3 Luồng thay thế

- Nếu CSRF token không hợp lệ:
  - hệ thống từ chối request
  - quay lại landing page với thông báo lỗi

- Nếu dữ liệu không hợp lệ:
  - hệ thống không lưu database
  - hiển thị lỗi đầu tiên cho người dùng

- Nếu database lỗi:
  - hệ thống trả về thông báo lưu dữ liệu thất bại

### 1.4 Biểu đồ hoạt động

```mermaid
flowchart TD
    A["Người dùng nhập form"] --> B["Nhấn gửi"]
    B --> C{"CSRF hợp lệ?"}
    C -- No --> D["Flash error và redirect"]
    C -- Yes --> E["Validate dữ liệu"]
    E --> F{"Dữ liệu hợp lệ?"}
    F -- No --> D
    F -- Yes --> G["Lưu vào registrations"]
    G --> H{"Lưu thành công?"}
    H -- No --> D
    H -- Yes --> I["Flash success và redirect về landing page"]
```

### 1.5 Biểu đồ trình tự

```mermaid
sequenceDiagram
    participant U as Khách truy cập
    participant R as Router
    participant C as HomeController
    participant CS as Csrf
    participant V as Validator
    participant M as RegistrationModel
    participant DB as MySQL

    U->>R: POST /submit
    R->>C: submit()
    C->>CS: validate(token)
    alt Token sai
        C-->>U: Redirect + flash error
    else Token đúng
        C->>V: validate(data, rules)
        alt Dữ liệu sai
            C-->>U: Redirect + flash error
        else Dữ liệu đúng
            C->>M: insertRegistration(data)
            M->>DB: INSERT INTO registrations
            DB-->>M: success
            M-->>C: true
            C-->>U: Redirect + flash success
        end
    end
```

### 1.6 Biểu đồ lớp

```mermaid
classDiagram
    class HomeController {
        +index(): void
        +submit(): void
    }

    class RegistrationModel {
        +insertRegistration(data): bool
        +getAllRegistrations(): array
    }

    class Validator {
        +validate(data, rules): array
    }

    class Csrf {
        +token(): string
        +field(): string
        +validate(token): bool
    }

    HomeController --> RegistrationModel
    HomeController --> Validator
    HomeController --> Csrf
```

## 2. UC03 - Đăng nhập admin

### 2.1 Đặc tả use case

| Thuộc tính | Mô tả |
|---|---|
| Mã use case | UC03 |
| Tên use case | Đăng nhập admin |
| Actor chính | Admin |
| Mục tiêu | Truy cập khu vực quản trị |
| Tiền điều kiện | Admin có tài khoản hợp lệ |
| Hậu điều kiện | Session admin được tạo |

### 2.2 Luồng chính

1. Admin truy cập trang login.
2. Admin nhập username và password.
3. Hệ thống kiểm tra CSRF token.
4. Hệ thống validate dữ liệu.
5. Hệ thống tìm admin theo username.
6. Hệ thống kiểm tra password bằng `password_verify()`.
7. Hệ thống tạo session admin.
8. Chuyển hướng vào dashboard.

### 2.3 Luồng thay thế

- Nếu token không hợp lệ:
  - quay lại trang login

- Nếu dữ liệu không hợp lệ:
  - hiển thị lỗi

- Nếu username hoặc password sai:
  - hiển thị lỗi đăng nhập

### 2.4 Biểu đồ hoạt động

```mermaid
flowchart TD
    A["Admin mở trang login"] --> B["Nhập username/password"]
    B --> C["Nhấn đăng nhập"]
    C --> D{"CSRF hợp lệ?"}
    D -- No --> E["Redirect login + lỗi"]
    D -- Yes --> F["Validate dữ liệu"]
    F --> G{"Dữ liệu hợp lệ?"}
    G -- No --> E
    G -- Yes --> H["Tìm admin theo username"]
    H --> I{"password_verify đúng?"}
    I -- No --> E
    I -- Yes --> J["Tạo session admin"]
    J --> K["Redirect dashboard"]
```

### 2.5 Biểu đồ trình tự

```mermaid
sequenceDiagram
    participant A as Admin
    participant R as Router
    participant C as AuthController
    participant V as Validator
    participant CS as Csrf
    participant M as AdminModel
    participant DB as MySQL
    participant AU as Auth

    A->>R: POST /admin/login
    R->>C: processLogin()
    C->>CS: validate(token)
    C->>V: validate(data)
    C->>M: getAdminByUsername(username)
    M->>DB: SELECT * FROM admins
    DB-->>M: admin record
    M-->>C: admin
    C->>C: password_verify(password, hash)
    alt Sai thông tin
        C-->>A: Redirect login + flash error
    else Đúng thông tin
        C->>AU: loginAdmin(admin)
        AU-->>C: session created
        C-->>A: Redirect /admin/dashboard
    end
```

### 2.6 Biểu đồ lớp

```mermaid
classDiagram
    class AuthController {
        +login(): void
        +processLogin(): void
        +logout(): void
    }

    class AdminModel {
        +getAdminByUsername(username): array|false
    }

    class Auth {
        +checkAdmin(): bool
        +loginAdmin(admin): void
        +logoutAdmin(): void
        +requireAdmin(): void
    }

    class Session {
        +put(key, value): void
        +get(key, default): mixed
        +flash(key, value): void
    }

    AuthController --> AdminModel
    AuthController --> Auth
    AuthController --> Session
```

## 3. UC04 - Xem dashboard đăng ký

### 3.1 Đặc tả use case

| Thuộc tính | Mô tả |
|---|---|
| Mã use case | UC04 |
| Tên use case | Xem dashboard đăng ký |
| Actor chính | Admin |
| Mục tiêu | Xem danh sách học viên đã đăng ký |
| Tiền điều kiện | Admin đã đăng nhập |
| Hậu điều kiện | Danh sách đăng ký được hiển thị trên dashboard |

### 3.2 Luồng chính

1. Admin truy cập `/admin/dashboard`
2. Hệ thống kiểm tra session đăng nhập
3. Nếu hợp lệ, hệ thống lấy danh sách đăng ký từ database
4. Hệ thống hiển thị dữ liệu dạng bảng

### 3.3 Luồng thay thế

- Nếu chưa đăng nhập:
  - redirect về `/admin/login`

### 3.4 Biểu đồ hoạt động

```mermaid
flowchart TD
    A["Admin truy cập dashboard"] --> B{"Đã login?"}
    B -- No --> C["Redirect login"]
    B -- Yes --> D["Lấy dữ liệu registrations"]
    D --> E["Render dashboard view"]
```

### 3.5 Biểu đồ trình tự

```mermaid
sequenceDiagram
    participant A as Admin
    participant R as Router
    participant C as DashboardController
    participant AU as Auth
    participant M as RegistrationModel
    participant DB as MySQL
    participant V as Dashboard View

    A->>R: GET /admin/dashboard
    R->>C: __construct()
    C->>AU: requireAdmin()
    alt Chưa login
        AU-->>A: Redirect /admin/login
    else Đã login
        R->>C: index()
        C->>M: getAllRegistrations()
        M->>DB: SELECT registrations
        DB-->>M: data
        M-->>C: registrations
        C->>V: render data
        V-->>A: HTML dashboard
    end
```

### 3.6 Biểu đồ lớp

```mermaid
classDiagram
    class DashboardController {
        +__construct()
        +index(): void
    }

    class RegistrationModel {
        +getAllRegistrations(): array
    }

    class Auth {
        +requireAdmin(): void
    }

    DashboardController --> RegistrationModel
    DashboardController --> Auth
```

## 4. UC05 - Đăng xuất admin

### 4.1 Đặc tả use case

| Thuộc tính | Mô tả |
|---|---|
| Mã use case | UC05 |
| Tên use case | Đăng xuất admin |
| Actor chính | Admin |
| Mục tiêu | Kết thúc phiên làm việc quản trị |
| Tiền điều kiện | Admin đã đăng nhập |
| Hậu điều kiện | Session bị xóa và quay về trang login |

### 4.2 Biểu đồ hoạt động

```mermaid
flowchart TD
    A["Admin chọn đăng xuất"] --> B["AuthController::logout()"]
    B --> C["Auth::logoutAdmin()"]
    C --> D["Xóa session và cookie"]
    D --> E["Redirect /admin/login"]
```

### 4.3 Biểu đồ trình tự

```mermaid
sequenceDiagram
    participant A as Admin
    participant R as Router
    participant C as AuthController
    participant AU as Auth
    participant S as Session

    A->>R: GET /admin/logout
    R->>C: logout()
    C->>AU: logoutAdmin()
    AU->>S: flush()
    AU-->>C: done
    C-->>A: Redirect /admin/login
```
