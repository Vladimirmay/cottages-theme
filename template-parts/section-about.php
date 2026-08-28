<?php
/**
 * Часть шаблона: секция "О проекте"
 */

$front_page_id = get_option('page_on_front');

$about_text   = get_field('about_text', $front_page_id);
$image_main   = get_field('about_image_main', $front_page_id);
$image_top    = get_field('about_image_top', $front_page_id);
$image_bottom = get_field('about_image_bottom', $front_page_id);
?>

<section id="about" class="section section--about">
    <div class="about container">

        <div class="about__head">
            <span class="about__label">Коротко о нас</span>
            <div class="about__content">
                <h2 class="about__title">О проекте</h2>
                <div class="about__text">
                    <?php echo $about_text; ?>
                </div>
            </div>
        </div>

        <div class="about__gallery">
            <?php if ($image_main) : ?>
                <div class="about__photo about__photo--main">
                    <img src="<?php echo esc_url($image_main); ?>" alt="О проекте">
                </div>
            <?php endif; ?>

            <?php if ($image_top) : ?>
                <div class="about__photo about__photo--top">
                    <img src="<?php echo esc_url($image_top); ?>" alt="О проекте">
                </div>
            <?php endif; ?>

            <?php if ($image_bottom) : ?>
                <div class="about__photo about__photo--bottom">
                    <img src="<?php echo esc_url($image_bottom); ?>" alt="О проекте">
                </div>
            <?php endif; ?>
        </div>

    </div>
</section>