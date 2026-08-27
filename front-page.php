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
                <span class="hero__button-icon">↓</span>
            </a>
        </div>

        <div class="hero__region">
            <span class="hero__region-icon">◎</span>
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

<section id="investicii" class="section section--investicii">
    <h2>Инвестиции</h2>
</section>

<?php
get_footer();