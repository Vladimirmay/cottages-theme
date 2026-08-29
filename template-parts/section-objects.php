<?php
/**
 * Часть шаблона: секция "Примеры объектов для инвестиций"
 */

$objects_query = new WP_Query(array(
    'post_type'      => 'object_item',
    'post_status'    => 'publish',
    'posts_per_page' => -1,
    'orderby'        => 'date',
    'order'          => 'DESC',
));
?>

<section id="objects" class="section section--objects">
    <div class="objects container">

        <div class="objects__side">
            <span class="objects__label">Актуальные предложения</span>
        </div>

        <div class="objects__main">
            <div class="objects__head">
                <h2 class="objects__title">Примеры объектов<br>для инвестиций</h2>
                <div class="objects__nav">
                    <button type="button" class="objects__arrow objects__arrow--prev" aria-label="Назад">
                        <svg viewBox="0 0 5 9">
                            <path d="M0.419,9.000 L0.003,8.606 L4.164,4.500 L0.003,0.394 L0.419,0.000 L4.997,4.500 L0.419,9.000 Z" />
                        </svg>
                    </button>
                    <button type="button" class="objects__arrow objects__arrow--next" aria-label="Вперёд">
                        <svg viewBox="0 0 5 9">
                            <path d="M0.419,9.000 L0.003,8.606 L4.164,4.500 L0.003,0.394 L0.419,0.000 L4.997,4.500 L0.419,9.000 Z" />
                        </svg>
                    </button>
                </div>
            </div>

            <div class="objects__slider swiper">
                <div class="swiper-wrapper">
                    <?php
                    if ($objects_query->have_posts()) :
                        while ($objects_query->have_posts()) : $objects_query->the_post();

                            $card = array(
                                'title'        => get_the_title(),
                                'image'        => get_field('object_image'),
                                'market_price' => get_field('object_market_price'),
                                'buy_price'    => get_field('object_buy_price'),
                                'term'         => get_field('object_term'),
                                'profit'       => get_field('object_profit'),
                            );

                            echo '<div class="swiper-slide">';
                            get_template_part('template-parts/object-card', null, $card);
                            echo '</div>';

                        endwhile;
                        wp_reset_postdata();
                    endif;
                    ?>
                </div>
            </div>
        </div>

    </div>
</section>