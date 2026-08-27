<header class="site-header">
    <div class="site-header__inner container">

        <a href="<?php echo esc_url( home_url('/') ); ?>" class="site-header__logo">FundHouse</a>

        <nav class="site-header__nav">
            <a href="#prodazha">Продажа</a>
            <a href="#arenda">Аренда</a>
            <a href="#posutochno">Посуточно</a>
            <a href="#zhurnal">Журнал</a>
            <a href="#investicii">Инвестиции</a>
        </nav>

        <div class="site-header__actions">
            <a href="tel:+79000000000" class="site-header__phone">+7 (9000) 000-00-00</a>
            <a href="#contact" class="site-header__btn">Написать нам</a>
        </div>

    </div>
     <?php wp_head(); ?>
</header>