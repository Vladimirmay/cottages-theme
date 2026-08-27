<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

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

        <button type="button" class="site-header__burger" aria-label="Открыть меню" aria-expanded="false" aria-controls="site-mobile-menu">
            <span></span>
            <span></span>
            <span></span>
        </button>

    </div>

    <div class="site-header__mobile-menu" id="site-mobile-menu">
        <div class="site-header__mobile-top container">
            <a href="<?php echo esc_url( home_url('/') ); ?>" class="site-header__logo">FundHouse</a>

            <button type="button" class="site-header__close" aria-label="Закрыть меню">
                <span></span>
                <span></span>
            </button>
        </div>

        <nav class="site-header__mobile-nav">
            <a href="#prodazha">Продажа</a>
            <a href="#arenda">Аренда</a>
            <a href="#posutochno">Посуточно</a>
            <a href="#zhurnal">Журнал</a>
            <a href="#investicii">Инвестиции</a>
        </nav>

        <div class="site-header__mobile-actions container">
            <a href="tel:+79000000000" class="site-header__phone">+7 (9000) 000-00-00</a>
            <a href="#contact" class="site-header__btn">Написать нам</a>
        </div>
    </div>
</header>

<main class="site-main">