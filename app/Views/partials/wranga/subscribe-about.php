<?php
/*
|-----------------------------------------------------------------------
| Partial: wranga/subscribe-about
|-----------------------------------------------------------------------
| Đây là cụm section nội dung giữa landing page.
| File này chứa:
| - subscribe section
| - about section
| - logo slider
| - promobox/freebie section
*/
?>
<section id="subscribe" class="dtr-section position-relative dtr-py-100 bg-dark-blue">
    <div class="container">
        <span class="dtr-section-tagline bg-light-blue color-white">Join the waitlist</span>

        <div class="row">
            <div class="col-12">
                <h2 class="dtr-section-heading dtr-mb-10 text-center color-white">Are you ready for a change?</h2>
                <p class="text-center color-white">I'll teach you balancing the needs of your business & relationships</p>

                <div class="row dtr-mt-40">
                    <div class="col-12 col-md-10 offset-md-1">
                        <form id="subscribeform" method="post" action="#contact">
                            <fieldset>
                                <div class="dtr-form-row dtr-form-row-3col clearfix">
                                    <div class="dtr-form-column">
                                        <p class="dtr-form-field">
                                            <input name="waitlist_name" type="text" placeholder="Name">
                                        </p>
                                    </div>
                                    <div class="dtr-form-column">
                                        <p class="dtr-form-field">
                                            <input name="waitlist_email" type="text" placeholder="Email">
                                        </p>
                                    </div>
                                    <div class="dtr-form-column">
                                        <button class="button dtr-btn-styled dtr-btn-styled-white" type="submit"><span class="bg-light-blue"></span>Subscribe</button>
                                    </div>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="about" class="dtr-section dtr-pt-130">
    <div class="container">
        <div class="dtr-about bg-grey dtr-rounded">
            <div class="dtr-about-img">
                <span class="dtr-about-tagline bg-dark-blue color-blue">Little about myself</span>
                <img src="<?= $themeAsset('images/about-img1.jpg'); ?>" alt="image">
            </div>

            <div class="dtr-about-content">
                <h2 class="dtr-section-heading"><span class="color-blue">Hi...</span>I’m Solveig Pink!</h2>
                <h4>My Belief</h4>
                <p class="dtr-mb-20">Lorem ipsum dolor sit amet, consectetur adipiscing elit quis nostrud rem aperiam. Ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                <h4>My Process</h4>
                <p>Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet dolore magnam aliquam quaerat voluptatem at enim ad minima veniam. Aliquid ex ea commodi consequatur</p>
                <p>To me, it’s what living is about.</p>
                <a href="#contact" class="dtr-btn-styled dtr-mt-30 dtr-btn-styled-dark"><span class="bg-light-blue"></span>Schedule a Session now</a>
            </div>
        </div>
    </div>
</section>

<section class="dtr-section dtr-pt-50 dtr-pb-100">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h6 class="text-center dtr-mb-40">As featured in...</h6>
                <div class="dtr-slick-slider dtr-img-slider-6col">
                    <div><img src="<?= $themeAsset('images/client-2.png'); ?>" alt="image"></div>
                    <div><img src="<?= $themeAsset('images/client-1.png'); ?>" alt="image"></div>
                    <div><img src="<?= $themeAsset('images/client-3.png'); ?>" alt="image"></div>
                    <div><img src="<?= $themeAsset('images/client-4.png'); ?>" alt="image"></div>
                    <div><img src="<?= $themeAsset('images/client-5.png'); ?>" alt="image"></div>
                    <div><img src="<?= $themeAsset('images/client-6.png'); ?>" alt="image"></div>
                    <div><img src="<?= $themeAsset('images/client-2.png'); ?>" alt="image"></div>
                    <div><img src="<?= $themeAsset('images/client-4.png'); ?>" alt="image"></div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="dtr-section dtr-py-100 bg-grey-alt">
    <div class="dtr-section-with-bg bg-shape-top" style="background-image: url(<?= $themeAsset('images/shape_top.svg'); ?>);"></div>
    <div class="dtr-section-with-bg bg-shape-bottom" style="background-image: url(<?= $themeAsset('images/shape_bottom.svg'); ?>);"></div>

    <div class="container">
        <h2 class="dtr-section-heading text-center">Start your journey with<br>these freebies!</h2>

        <div class="row">
            <div class="col-12 col-md-4">
                <div class="dtr-promobox">
                    <div class="dtr-promobox-img"><img src="<?= $themeAsset('images/freebie-img1.jpg'); ?>" alt="image"></div>
                    <div class="dtr-promobox-content bg-white">
                        <p class="dtr-promobox-tagline bg-light-blue color-white">Freebie</p>
                        <h4>Do you have healthy habbits?</h4>
                        <p>Duisi auti irure dolor in reprehenderit in voluptate velit esse cillum eius modi tempora incidunt labore dolor.</p>
                        <a href="#" class="dtr-btn-styled dtr-btn-styled-small dtr-mt-20 dtr-btn-styled-dark"><span class="bg-light-blue"></span>Get Access</a>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-4">
                <div class="dtr-promobox">
                    <div class="dtr-promobox-img"><img src="<?= $themeAsset('images/freebie-img2.jpg'); ?>" alt="image"></div>
                    <div class="dtr-promobox-content bg-white">
                        <p class="dtr-promobox-tagline bg-light-blue color-white">How they do it?</p>
                        <h4>Mindsets of successful people</h4>
                        <p>Duisi auti irure dolor in reprehenderit in voluptate velit esse cillum eius modi tempora incidunt labore dolor.</p>
                        <a href="#" class="dtr-btn-styled dtr-btn-styled-small dtr-mt-20 dtr-btn-styled-dark"><span class="bg-light-blue"></span>Get Access</a>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-4">
                <div class="dtr-promobox">
                    <div class="dtr-promobox-img"><img src="<?= $themeAsset('images/freebie-img3.jpg'); ?>" alt="image"></div>
                    <div class="dtr-promobox-content bg-white">
                        <p class="dtr-promobox-tagline bg-light-blue color-white">Secret of success</p>
                        <h4>Shhh... Yes! There's a secret to success</h4>
                        <p>Duisi auti irure dolor in reprehenderit in voluptate velit esse cillum eius modi tempora incidunt labore dolor.</p>
                        <a href="#" class="dtr-btn-styled dtr-btn-styled-small dtr-mt-20 dtr-btn-styled-dark"><span class="bg-light-blue"></span>Get Access</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
