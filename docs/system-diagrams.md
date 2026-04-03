# Sơ Đồ Hệ Thống

Tài liệu này mô tả hệ thống bằng sơ đồ Mermaid để dễ đưa vào báo cáo hoặc thuyết trình.

## 1. Sơ đồ kiến trúc tổng thể

```mermaid
flowchart TD
    A["Trình duyệt"] --> B["public/index.php"]
    B --> C["bootstrap/app.php"]
    C --> D["routes/web.php"]
    D --> E["Router"]
    E --> F["Controller"]
    F --> G["Model"]
    G --> H["MySQL Database"]
    F --> I["View"]
    I --> A
```

## 2. Sơ đồ thành phần MVC

```mermaid
flowchart LR
    subgraph Core
        R["Router"]
        DB["Database"]
        Req["Request"]
        Res["Response"]
        Ses["Session"]
        Au["Auth"]
        Val["Validator"]
        Cs["Csrf"]
    end

    subgraph Controllers
        HC["HomeController"]
        AC["AuthController"]
        DC["DashboardController"]
    end

    subgraph Models
        AM["AdminModel"]
        RM["RegistrationModel"]
    end

    subgraph Views
        HV["Landing Page Views"]
        LV["Login View"]
        DV["Dashboard View"]
    end

    R --> HC
    R --> AC
    R --> DC

    HC --> RM
    AC --> AM
    DC --> RM

    HC --> HV
    AC --> LV
    DC --> DV

    RM --> DB
    AM --> DB

    HC --> Req
    HC --> Res
    HC --> Val
    HC --> Cs
    HC --> Ses

    AC --> Req
    AC --> Res
    AC --> Val
    AC --> Cs
    AC --> Ses
    AC --> Au

    DC --> Au
    DC --> Ses
```

## 3. Sơ đồ luồng đăng ký học viên

```mermaid
sequenceDiagram
    participant U as User
    participant V as Landing Page View
    participant R as Router
    participant C as HomeController
    participant Val as Validator/Csrf
    participant M as RegistrationModel
    participant DB as MySQL

    U->>V: Nhập form đăng ký
    U->>R: POST /submit
    R->>C: submit()
    C->>Val: Kiểm tra CSRF + validate dữ liệu
    alt Dữ liệu không hợp lệ
        C-->>U: Redirect về landing page + flash error
    else Dữ liệu hợp lệ
        C->>M: insertRegistration(data)
        M->>DB: INSERT INTO registrations
        DB-->>M: Thành công
        M-->>C: true
        C-->>U: Redirect về landing page + flash success
    end
```

## 4. Sơ đồ luồng đăng nhập admin

```mermaid
sequenceDiagram
    participant A as Admin
    participant R as Router
    participant C as AuthController
    participant Val as Validator/Csrf
    participant M as AdminModel
    participant DB as MySQL
    participant S as Session/Auth

    A->>R: POST /admin/login
    R->>C: processLogin()
    C->>Val: Kiểm tra CSRF + validate input
    C->>M: getAdminByUsername(username)
    M->>DB: SELECT admin theo username
    DB-->>M: Trả dữ liệu admin
    M-->>C: admin record
    C->>C: password_verify(password, hash)
    alt Sai thông tin
        C-->>A: Redirect login + flash error
    else Đúng thông tin
        C->>S: loginAdmin()
        S->>S: session_regenerate_id + lưu session
        C-->>A: Redirect /admin/dashboard
    end
```

## 5. Sơ đồ bảo vệ dashboard admin

```mermaid
flowchart TD
    A["Admin truy cập /admin/dashboard"] --> B["Router gọi DashboardController"]
    B --> C["__construct()"]
    C --> D{"admin_logged_in = true?"}
    D -- No --> E["Redirect /admin/login"]
    D -- Yes --> F["index()"]
    F --> G["RegistrationModel::getAllRegistrations()"]
    G --> H["MySQL"]
    H --> I["View dashboard.php"]
```

## 6. Sơ đồ tích hợp theme frontend

```mermaid
flowchart TD
    A["HomeController@index"] --> B["layouts/main.php"]
    B --> C["partials/wranga/header.php"]
    B --> D["home/index.php"]
    D --> E["hero-services.php"]
    D --> F["subscribe-about.php"]
    D --> G["reviews-blog.php"]
    D --> H["contact.php"]
    B --> I["partials/wranga/footer.php"]
```
