<?php
/*
|-----------------------------------------------------------------------
| Partial: wranga/contact
|-----------------------------------------------------------------------
| Đây là section liên hệ/đăng ký của landing page.
| File này chứa form chính của dự án với các field:
| full_name, phone, email, course_name, kèm token CSRF và thông báo.
*/
/** @var string|null $formSuccess */
/** @var string|null $formError */
/** @var string $csrfField */
?>
<section id="contact" class="dtr-section dtr-mb-minus60">
    <div class="container">
        <div class="row dtr-box dtr-rounded bg-blue color-white dtr-mx-0">
            <div class="col-12 col-md-5">
                <h2>Get in touch</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore.</p>
                <h4 class="dtr-mt-30">Do not hesitate!</h4>
                <p class="text-size-md font-weight-extrabold"><span class="color-blue">t:</span> 1 800 23 45 6789</p>
                <p class="text-size-md font-weight-extrabold"><span class="color-blue">e:</span> hello@example.com</p>
            </div>

            <div class="col-12 col-md-7 small-device-space">
                <?php if (!empty($formSuccess)): ?>
                    <div class="alert alert-success mb-4"><?= htmlspecialchars($formSuccess, ENT_QUOTES, 'UTF-8'); ?></div>
                <?php elseif (!empty($formError)): ?>
                    <div class="alert alert-danger mb-4"><?= htmlspecialchars($formError, ENT_QUOTES, 'UTF-8'); ?></div>
                <?php endif; ?>

                <div class="dtr-form">
                    <form id="contactform" method="post" action="/submit">
                        <fieldset>
                            <?= $csrfField; ?>
                            <div class="dtr-form-row dtr-form-row-2col clearfix">
                                <div class="dtr-form-column">
                                    <p class="dtr-form-field">
                                        <input name="full_name" type="text" placeholder="Ho ten" required>
                                    </p>
                                </div>
                                <div class="dtr-form-column">
                                    <p class="dtr-form-field">
                                        <input name="phone" type="text" placeholder="So dien thoai" required>
                                    </p>
                                </div>
                            </div>

                            <p class="dtr-form-field">
                                <input name="email" type="email" placeholder="Email" required>
                            </p>
                            <p class="dtr-form-field">
                                <input name="course_name" type="text" placeholder="Khoa hoc quan tam" required>
                            </p>
                            <p class="text-left">
                                <button class="button dtr-btn-styled dtr-btn-styled-white" type="submit"><span class="bg-light-blue"></span>Dang ky ngay</button>
                            </p>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
