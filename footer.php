<?php
/**
 * Подвал темы: закрытие main, футер и конец документа
 */
?>
</main>

<footer class="site-footer">
    <div class="site-footer__inner container">

        <div class="site-footer__logo">
            <a href="<?php echo esc_url( home_url('/') ); ?>">FundHouse</a>
        </div>

        <div class="site-footer__contacts">
            <p class="site-footer__label">Контакты</p>
            <a href="tel:+79000000000" class="site-footer__contact-value">+7 (900) 000-00-00</a>
            <a href="mailto:info@mail.com" class="site-footer__contact-value">info@mail.com</a>
        </div>

        <div class="site-footer__nav">
            <p class="site-footer__label">Навигация</p>
            <nav class="site-footer__links">
                <a href="#reasons">Почему именно мы</a>
                <a href="#about">Коротко о нас</a>
                <a href="#cycle">Этапы инвестиций</a>
                <a href="#objects">Актуальные предложения</a>
                <a href="#contact">Оставьте заявку</a>
            </nav>
        </div>

        <div class="site-footer__address">
            <p class="site-footer__label">Наш адрес</p>
            <p class="site-footer__address-text">Санкт-Петербург, Новгородская ул., 42, 5 эт. 215 каб. 191757</p>
            <p class="site-footer__hours">Пн-Пт, 10-19</p>
        </div>

    </div>
</footer>

</div>

<?php wp_footer(); ?>
</body>
</html>