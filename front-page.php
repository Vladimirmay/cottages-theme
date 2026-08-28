<?php
/**
 * Шаблон главной страницы (лендинг).
 */

get_header();
?>

<section id="hero" class="section section--hero">
    <div class="hero__top container">

        <div class="hero__side">
            <p class="hero__supertitle"><?php the_field('hero_supertitle'); ?></p>
        </div>

        <div class="hero__main">
            <h1 class="hero__title"><?php the_field('hero_title'); ?></h1>
            <p class="hero__description"><?php the_field('hero_description'); ?></p>
            <a href="#contact" class="hero__button">
                <span><?php the_field('hero_button_text'); ?></span>
                <span class="hero__button-icon">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M7 10l5 5 5-5" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M12 15V3" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/>
                    </svg>
                </span>
            </a>
        </div>

        <div class="hero__region">
            <span class="hero__region-icon">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                    <path d="M12 22s7-7.373 7-12.5C19 5.358 15.866 2 12 2S5 5.358 5 9.5C5 14.627 12 22 12 22Z" stroke="currentColor" stroke-width="1.6" stroke-linejoin="round"/>
                    <circle cx="12" cy="9.5" r="2.5" stroke="currentColor" stroke-width="1.6"/>
                </svg>
            </span>
            <span>Московская область</span>
        </div>

    </div>

    <?php if ( get_field('hero_background') ) : ?>
        <div class="hero__image">
            <img src="<?php the_field('hero_background'); ?>" alt="Коттеджный посёлок">
        </div>
    <?php endif; ?>
</section>

<section id="arenda" class="section section--arenda">
    <h2>Аренда</h2>
</section>

<section id="posutochno" class="section section--posutochno">
    <h2>Посуточно</h2>
</section>

<section id="zhurnal" class="section section--zhurnal">
    <h2>Журнал</h2>
</section>

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
                        <br/>с <a href="#">политикой конфиденциальности</a>
                    </span>
                </label>

                <div class="contact-form__status" id="formStatus"></div>

            </form>
        </div>

    </div>
</section>

<?php
get_footer();