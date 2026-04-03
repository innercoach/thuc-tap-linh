<?php
/*
|-----------------------------------------------------------------------
| Partial: wranga/hero-services
|-----------------------------------------------------------------------
| Đây là cụm section đầu của landing page.
| File này chứa:
| - hero section
| - services section
| Đây là nơi người dùng nhìn thấy đầu tiên khi mở trang chủ.
*/
?>
<section id="home" class="dtr-section dtr-section-with-bg dtr-hero-section-top-padding dtr-pb-100" style="background-image: url(<?= $themeAsset('images/hero-bg.jpg'); ?>);">
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-6">
                <h1>Great change<br>requires support</h1>
                <p class="text-size-md font-weight-extrabold color-blue">Live a life with a passion</p>
                <p>Lorem ipsum dolor sit consectetur adipiscing elit, sed do eiusmod tempor incididunt soluta nobis assumenda labore quod maxime dolore magna aliqua.</p>
                <a href="#contact" class="dtr-btn-styled dtr-mt-30 dtr-btn-styled-dark"><span class="bg-light-blue"></span>Schedule a Session</a>
            </div>
        </div>
    </div>
</section>

<section id="services" class="dtr-section dtr-py-100">
    <div class="container">
        <h2 class="dtr-section-heading text-center">Create your vision.<br>Stay on track with your goals</h2>

        <div class="row">
            <div class="col-12 col-md-4">
                <div class="dtr-servicebox dtr-rounded" style="background-image: url(<?= $themeAsset('images/service-img1.jpg'); ?>);">
                    <div class="dtr-servicebox-caption bg-white">
                        <span class="dtr-servicebox-subtitle color-blue">Family</span>
                        <h5 class="dtr-servicebox-title">Loving Relationships That Work</h5>
                        <div class="dtr-servicebox-caption-inner"><a href="#" class="dtr-btn-styled dtr-btn-styled-dark"><span class="bg-light-blue"></span>Explore</a></div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-4">
                <div class="dtr-servicebox dtr-rounded" style="background-image: url(<?= $themeAsset('images/service-img2.jpg'); ?>);">
                    <div class="dtr-servicebox-caption bg-white">
                        <span class="dtr-servicebox-subtitle color-blue">Life</span>
                        <h5 class="dtr-servicebox-title">The Mastery of Cultural Balance</h5>
                        <div class="dtr-servicebox-caption-inner"><a href="#" class="dtr-btn-styled dtr-btn-styled-dark"><span class="bg-light-blue"></span>Explore</a></div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-4">
                <div class="dtr-servicebox dtr-rounded" style="background-image: url(<?= $themeAsset('images/service-img3.jpg'); ?>);">
                    <div class="dtr-servicebox-caption bg-white">
                        <span class="dtr-servicebox-subtitle color-blue">Career</span>
                        <h5 class="dtr-servicebox-title">Creating Workplaces That Work</h5>
                        <div class="dtr-servicebox-caption-inner"><a href="#" class="dtr-btn-styled dtr-btn-styled-dark"><span class="bg-light-blue"></span>Explore</a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
