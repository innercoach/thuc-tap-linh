<?php
/*
|-----------------------------------------------------------------------
| View: auth/login
|-----------------------------------------------------------------------
| Đây là giao diện đăng nhập cho admin.
| View này hiển thị:
| - form username/password
| - token CSRF
| - thông báo lỗi hoặc thành công từ session flash
*/
?>
<?php
/** @var string|null $error */
/** @var string|null $success */
/** @var string $csrfField */
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container py-5" style="max-width: 480px;">
        <h1 class="h3 mb-4">Admin Login</h1>

        <?php if (!empty($success)): ?>
            <div class="alert alert-success"><?= htmlspecialchars($success, ENT_QUOTES, 'UTF-8'); ?></div>
        <?php endif; ?>

        <?php if (!empty($error)): ?>
            <div class="alert alert-danger"><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></div>
        <?php endif; ?>

        <form action="/admin/login" method="POST">
            <?= $csrfField; ?>
            <div class="mb-3">
                <input type="text" name="username" class="form-control" placeholder="Username" required>
            </div>
            <div class="mb-3">
                <input type="password" name="password" class="form-control" placeholder="Password" required>
            </div>
            <button type="submit" class="btn btn-primary">Dang nhap</button>
        </form>
    </div>
</body>
</html>
