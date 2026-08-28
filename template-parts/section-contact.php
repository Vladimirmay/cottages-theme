<?php
/**
 * Часть шаблона: секция "Оставьте заявку" с формой
 */
?>

<section id="contact" class="section section--contact">
    <div class="contact container">

        <div class="contact__side">
            <span class="contact__label">Оставьте заявку</span>
        </div>

        <div class="contact__main">
            <h2 class="contact__title">Инвестируйте в свою<br>стабильность уже сегодня</h2>
            <p class="contact__description">Оставьте заявку и наш менеджер вышлет вам презентацию<br>с планами проектов и подробными расчётами</p>

            <form class="contact-form" id="contactForm" novalidate>

                <?php wp_nonce_field('cottages_application_action', 'cottages_application_nonce'); ?>

                <div class="contact-form__field">
                    <input type="text" name="name" id="field-name" class="contact-form__input" placeholder="Иван Иванов" required>
                </div>

                <div class="contact-form__field">
                    <input type="tel" name="phone" id="field-phone" class="contact-form__input" placeholder="+7 999 999 99 99" required>
                </div>

                <div class="contact-form__radio-group">
                    <p class="contact-form__radio-title">Как с вами связаться:</p>

                    <label class="contact-form__radio">
                        <input type="radio" name="contact_method" value="WhatsApp">
                        <span class="contact-form__radio-mark"></span>
                        <span>WhatsApp</span>
                    </label>

                    <label class="contact-form__radio">
                        <input type="radio" name="contact_method" value="Telegram">
                        <span class="contact-form__radio-mark"></span>
                        <span>Telegram</span>
                    </label>

                    <label class="contact-form__radio">
                        <input type="radio" name="contact_method" value="Звонок">
                        <span class="contact-form__radio-mark"></span>
                        <span>Звонок</span>
                    </label>
                </div>

                <button type="submit" class="contact-form__submit">Оставить заявку</button>

                <label class="contact-form__consent">
                    <input type="checkbox" name="consent" id="field-consent" required>
                    <span class="contact-form__consent-mark"></span>
                    <span class="contact-form__consent-text">
                        Нажимая на кнопку, вы соглашаетесь
                        с <a href="#">политикой конфиденциальности</a>
                    </span>
                </label>

                <div class="contact-form__status" id="formStatus"></div>

            </form>
        </div>

    </div>
</section>