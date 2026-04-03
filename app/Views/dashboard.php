<?php
/*
|-----------------------------------------------------------------------
| View: dashboard
|-----------------------------------------------------------------------
| Đây là giao diện dashboard admin.
| View này nhận mảng $registrations từ controller và in ra bảng dữ liệu
| để người quản trị xem danh sách học viên đã đăng ký.
*/
/** @var array $registrations */
/** @var string|null $success */
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 mb-0">Danh sach dang ky</h1>
            <a href="/admin/logout" class="btn btn-danger btn-sm">Dang xuat</a>
        </div>

        <?php if (!empty($success)): ?>
            <div class="alert alert-success"><?= htmlspecialchars($success, ENT_QUOTES, 'UTF-8'); ?></div>
        <?php endif; ?>

        <div class="table-responsive">
            <table class="table table-bordered table-striped align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>STT</th>
                        <th>Ho Ten</th>
                        <th>SDT</th>
                        <th>Email</th>
                        <th>Khoa hoc</th>
                        <th>Ngay dang ky</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($registrations)): ?>
                        <?php foreach ($registrations as $index => $registration): ?>
                            <tr>
                                <td><?= $index + 1; ?></td>
                                <td><?= htmlspecialchars($registration['full_name'], ENT_QUOTES, 'UTF-8'); ?></td>
                                <td><?= htmlspecialchars($registration['phone'], ENT_QUOTES, 'UTF-8'); ?></td>
                                <td><?= htmlspecialchars($registration['email'], ENT_QUOTES, 'UTF-8'); ?></td>
                                <td><?= htmlspecialchars($registration['course_name'], ENT_QUOTES, 'UTF-8'); ?></td>
                                <td><?= htmlspecialchars($registration['created_at'], ENT_QUOTES, 'UTF-8'); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="text-center">Chua co du lieu dang ky.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
