<?php
/*
|-----------------------------------------------------------------------
| Routes: web
|-----------------------------------------------------------------------
| File này khai báo toàn bộ route web của dự án.
| Mỗi route sẽ map một URL tới một method trong controller tương ứng.
*/

use App\Controllers\AuthController;
use App\Controllers\DashboardController;
use App\Controllers\HomeController;

// Frontend routes.
$router->get('/', [HomeController::class, 'index']);
$router->post('/submit', [HomeController::class, 'submit']);

// Admin routes.
$router->get('/admin/login', [AuthController::class, 'login']);
$router->post('/admin/login', [AuthController::class, 'processLogin']);
$router->get('/admin/logout', [AuthController::class, 'logout']);
$router->get('/admin/dashboard', [DashboardController::class, 'index']);
