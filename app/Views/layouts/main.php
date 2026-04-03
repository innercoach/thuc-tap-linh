<?php
/*
|-----------------------------------------------------------------------
| Layout: main
|-----------------------------------------------------------------------
| Đây là layout chính cho frontend.
| Layout này chứa phần khung chung của trang:
| - thẻ head, css, js
| - header và footer
| - vùng nội dung động được nạp từ $contentView
*/
/** @var string $contentView */

$themeAsset = static fn(string $path): string => '/themes/wranga/assets/' . ltrim($path, '/');
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="format-detection" content="telephone=no">
    <title>Landing Page Tuyển Sinh</title>
    <meta name="author" content="tansh">
    <meta name="description" content="HTML Landing Page Template">
    <meta name="keywords" content="coach, feminine, agency, business, one page">

    <link href="<?= $themeAsset('images/icons/apple-touch-icon-144-precomposed.png'); ?>" rel="apple-touch-icon" sizes="144x144">
    <link href="<?= $themeAsset('images/icons/apple-touch-icon-120-precomposed.png'); ?>" rel="apple-touch-icon" sizes="120x120">
    <link href="<?= $themeAsset('images/icons/apple-touch-icon-76-precomposed.png'); ?>" rel="apple-touch-icon" sizes="76x76">
    <link href="<?= $themeAsset('images/icons/favicon.png'); ?>" rel="shortcut icon">

    <link rel="stylesheet" href="<?= $themeAsset('css/bootstrap.min.css'); ?>">
    <link rel="stylesheet" href="<?= $themeAsset('fonts/iconfonts.css'); ?>">
    <link rel="stylesheet" href="<?= $themeAsset('css/plugins.css'); ?>">
    <link rel="stylesheet" href="<?= $themeAsset('css/style.css'); ?>">
    <link rel="stylesheet" href="<?= $themeAsset('css/responsive.css'); ?>">
    <link rel="stylesheet" href="<?= $themeAsset('css/color.css'); ?>">
</head>
<body>
<div id="dtr-wrapper" class="clearfix">
    <?php require __DIR__ . '/../partials/wranga/header.php'; ?>

    <div id="dtr-main-content">
        <?php require $contentView; ?>
    </div>

    <?php require __DIR__ . '/../partials/wranga/footer.php'; ?>
</div>

<script src="<?= $themeAsset('js/jquery.min.js'); ?>"></script>
<script src="<?= $themeAsset('js/bootstrap.min.js'); ?>"></script>
<script src="<?= $themeAsset('js/plugins.js'); ?>"></script>
<script src="<?= $themeAsset('js/custom.js'); ?>"></script>
</body>
</html>
