<?php
/*
|-----------------------------------------------------------------------
| Partial: wranga/reviews-blog
|-----------------------------------------------------------------------
| Đây là cụm section giữa và cuối của landing page.
| File này chứa:
| - phần đánh giá học viên
| - video giới thiệu
| - blog section
*/
?>
<section id="reviews" class="dtr-section dtr-py-100">
    <div class="container">
        <h2 class="dtr-section-heading text-center">What people say</h2>
        <p class="text-center dtr-mb-20"><img src="<?= $themeAsset('images/quote.svg'); ?>" alt="image"></p>

        <div class="row">
            <div class="col-12 col-md-10 offset-md-1">
                <div class="dtr-slick-slider dtr-testimonial-slider dtr-slick-has-dots">
                    <div class="dtr-testimonial">
                        <h4 class="dtr-testimonial-tagline">' Absolutely phenomenal coach '</h4>
                        <div class="dtr-testimonial-content clearfix">
                            <p>"Solveig is an absolutely phenomenal coach and I highly recommend her services if you want to make some lasting changes in your life! The powerful effects from these coaching sessions with Charvi can’t be underestimated."</p>
                        </div>
                        <div class="dtr-client-info clearfix">
                            <div class="dtr-testimonial-user"><img src="<?= $themeAsset('images/user-1.jpg'); ?>" alt="image"></div>
                            <div class="dtr-testimonial-user-info">
                                <h6 class="dtr-client-name">Eleanor Jensen</h6>
                                <span class="dtr-client-job">Musician, UK</span>
                            </div>
                        </div>
                    </div>

                    <div class="dtr-testimonial">
                        <h4 class="dtr-testimonial-tagline">' Best guide for life '</h4>
                        <div class="dtr-testimonial-content clearfix">
                            <p>"She inspired me to take actions that can move me forward to creating the life of my dreams. After 2 months I have accomplished so much!"</p>
                        </div>
                        <div class="dtr-client-info clearfix">
                            <div class="dtr-testimonial-user"><img src="<?= $themeAsset('images/user-2.jpg'); ?>" alt="image"></div>
                            <div class="dtr-testimonial-user-info">
                                <h6 class="dtr-client-name">Rebecca DeGenres</h6>
                                <span class="dtr-client-job">Apex Counseling, Ontario</span>
                            </div>
                        </div>
                    </div>

                    <div class="dtr-testimonial">
                        <h4 class="dtr-testimonial-tagline">' Really very grateful '</h4>
                        <div class="dtr-testimonial-content clearfix">
                            <p>"You’ve clearly helped me see things I could never see before. You’ve changed my life and I am so very grateful."</p>
                        </div>
                        <div class="dtr-client-info clearfix">
                            <div class="dtr-testimonial-user"><img src="<?= $themeAsset('images/user-3.jpg'); ?>" alt="image"></div>
                            <div class="dtr-testimonial-user-info">
                                <h6 class="dtr-client-name">Emily Anderson</h6>
                                <span class="dtr-client-job">Entrepreneur</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="dtr-section bg-grey">
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-6 dtr-py-50">
                <h2>Get help now!</h2>
                <p>Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem at enim ad minima veniam.</p>
                <p class="dtr-mt-20">Sign up to turn those $1k months into $5k months!</p>
                <a href="#contact" class="dtr-btn-styled dtr-mt-30 dtr-btn-styled-dark"><span class="bg-light-blue"></span>Schedule a Session</a>
            </div>

            <div class="col-12 col-md-6 dtr-mt-minus30 dtr-pb-50">
                <div class="dtr-video-wrapper">
                    <img src="<?= $themeAsset('images/help-section-img.jpg'); ?>" alt="image" class="dtr-rounded-img">
                    <div class="dtr-video-wrapper-inner">
                        <div class="video-button-white">
                            <a class="dtr-video-popup dtr-video-button" data-autoplay="true" data-vbtype="video" href="https://www.youtube.com/watch?v=kuceVNBTJio">
                                <span class="dtr-video-button-wrap-inner"></span>
                                <span class="dtr-border-animation dtr-border-1"></span>
                                <span class="dtr-border-animation dtr-border-2"></span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="blog" class="dtr-section dtr-py-100">
    <div class="container">
        <h2 class="dtr-section-heading text-center">From the blog</h2>

        <div class="row">
            <div class="col-12 col-md-4">
                <div class="dtr-blog-item">
                    <div class="dtr-post-img"><img src="<?= $themeAsset('images/blogpost-img1.jpg'); ?>" alt="image"> <span class="dtr-blog-cat">Business</span></div>
                    <div class="dtr-post-content">
                        <h5>10 Tips to turn limitations into fuel for success</h5>
                        <p class="dtr-blog-meta"><span>on</span> <a href="#">22 December 2020</a></p>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-4">
                <div class="dtr-blog-item">
                    <div class="dtr-post-img"><img src="<?= $themeAsset('images/blogpost-img2.jpg'); ?>" alt="image"> <span class="dtr-blog-cat">Spirituality</span></div>
                    <div class="dtr-post-content">
                        <h5>How to keep going even if you feel like giving up</h5>
                        <p class="dtr-blog-meta"><span>on</span> <a href="#">22 December 2020</a></p>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-4">
                <div class="dtr-blog-item">
                    <div class="dtr-post-img"><img src="<?= $themeAsset('images/blogpost-img3.jpg'); ?>" alt="image"> <span class="dtr-blog-cat">Marketing</span></div>
                    <div class="dtr-post-content">
                        <h5>Checklist to achieve social media marketing goals</h5>
                        <p class="dtr-blog-meta"><span>on</span> <a href="#">22 December 2020</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
