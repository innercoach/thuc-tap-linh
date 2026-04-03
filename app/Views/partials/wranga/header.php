<?php
/*
|-----------------------------------------------------------------------
| Partial: wranga/header
|-----------------------------------------------------------------------
| Đây là phần đầu trang của landing page.
| File này chứa preloader, header desktop/mobile, logo và menu điều
| hướng tới các section ngay trên cùng một trang.
*/
?>
<!-- preloader starts -->
<div class="dtr-preloader">
    <div class="dtr-preloader-inner">
        <div class="dtr-loader">Loading...</div>
    </div>
</div>
<!-- preloader ends -->

<div class="dtr-responsive-header fixed-top">
    <div class="container">
        <a href="/"><img src="<?= $themeAsset('images/logo-dark.png'); ?>" alt="logo"></a>
        <button id="dtr-menu-button" class="dtr-hamburger" type="button"><span class="dtr-hamburger-lines-wrapper"><span class="dtr-hamburger-lines"></span></span></button>
    </div>
    <div class="dtr-responsive-header-menu"></div>
</div>

<header id="dtr-header-global" class="fixed-top">
    <div class="d-flex align-items-center justify-content-between">
        <div class="dtr-header-left">
            <a class="logo-default dtr-scroll-link" href="#home"><img src="<?= $themeAsset('images/logo-dark.png'); ?>" alt="logo"></a>
            <a class="logo-alt dtr-scroll-link" href="#home"><img src="<?= $themeAsset('images/logo-dark.png'); ?>" alt="logo"></a>
        </div>

        <div class="dtr-header-right ml-auto">
            <div class="dtr-header-social dtr-social-large dtr-ml-50">
                <ul class="dtr-social dtr-social-list text-right">
                    <li><a href="#" class="dtr-facebook" target="_blank" title="facebook"></a></li>
                    <li><a href="#" class="dtr-twitter" target="_blank" title="twitter"></a></li>
                </ul>
            </div>

            <div class="main-navigation dtr-menu-light">
                <ul class="sf-menu dtr-scrollspy dtr-nav dark-nav-on-load dark-nav-on-scroll">
                    <li><a class="nav-link" href="#home">home.</a></li>
                    <li><a class="nav-link" href="#services">services.</a></li>
                    <li><a class="nav-link" href="#about">about.</a></li>
                    <li><a class="nav-link" href="#reviews">reviews.</a></li>
                    <li><a class="nav-link" href="#blog">blog.</a></li>
                    <li><a class="nav-link" href="#contact">contact.</a></li>
                </ul>
            </div>
        </div>
    </div>
</header>
