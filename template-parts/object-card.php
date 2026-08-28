<?php
/**
 * Часть шаблона: карточка объекта
 * Ожидает в $args: title, image, market_price, buy_price, term, profit
 */

$title        = $args['title']        ?? '';
$image        = $args['image']        ?? '';
$market_price = $args['market_price'] ?? '';
$buy_price    = $args['buy_price']    ?? '';
$term         = $args['term']         ?? '';
$profit       = $args['profit']       ?? '';
?>

<article class="object-card">
    <div class="object-card__image">
        <img src="<?php echo esc_url($image); ?>" alt="<?php echo esc_attr($title); ?>">
    </div>
    <div class="object-card__body">
        <h3 class="object-card__title"><?php echo esc_html($title); ?></h3>
        <ul class="object-card__params">
            <li><span>Рыночная стоимость</span><span><?php echo esc_html($market_price); ?></span></li>
            <li><span>Цена покупки</span><span><?php echo esc_html($buy_price); ?></span></li>
            <li><span>Срок реализации</span><span><?php echo esc_html($term); ?></span></li>
            <li><span>Доходность</span><span class="object-card__profit"><?php echo esc_html($profit); ?></span></li>
        </ul>
    </div>
</article>