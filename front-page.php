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

<?php get_template_part('template-parts/section-objects'); ?>

<?php get_template_part('template-parts/section-contact'); ?>

<?php
get_footer();