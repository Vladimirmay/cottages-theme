<?php
/**
 * Часть шаблона: секция "Почему именно мы"
 * данные захардкожены
 */

$reasons = array(
    array(
        'area'  => 'one',
        'dark'  => true,
        'title' => '18% годовых',
        'text'  => 'При грамотном управлении проектами и продуманной маркетинговой стратегии доходность вложений в коттеджи может достигать до 18% годовых.',
    ),
    array(
        'area'  => 'two',
        'dark'  => false,
        'title' => 'Уникальная локация',
        'text'  => 'Расположенный в экологически чистом Подмосковье в 40 минутах от МКАД, посёлок окружён лесами и водоёмами, создавая атмосферу уединения',
    ),
    array(
        'area'  => 'three',
        'dark'  => false,
        'title' => 'Закрытый поселок',
        'text'  => 'Частная территория с круглосуточной охраной и контролем доступа обеспечивает полную безопасность жителей.',
    ),
    array(
        'area'  => 'four',
        'dark'  => false,
        'title' => 'Девелопер с опытом',
        'text'  => 'Над проектом работает девелопер с более чем 15-летним опытом реализации элитных коттеджных посёлков, где есть все для жизни',
    ),
    array(
        'area'  => 'five',
        'dark'  => true,
        'title' => 'Инфраструктура',
        'text'  => 'На территории предусмотрены супермаркет, кафе, фитнес-центр, детские и спортивные площадки, и подземные паркинги.',
    ),
);
?>

<section id="reasons" class="section section--reasons">
    <div class="reasons container">

        <div class="reasons__head">
            <span class="reasons__label">Почему именно мы</span>
            <h2 class="reasons__title">Почему стоит<br>инвестировать с нами</h2>
        </div>

        <!-- Десктоп: сетка -->
        <div class="reasons__grid">
            <?php foreach ($reasons as $index => $reason) : ?>
                <div class="reasons__card reasons__card--<?php echo esc_attr($reason['area']); ?><?php echo $reason['dark'] ? ' reasons__card--dark' : ''; ?>">
                    <span class="reasons__number"><?php echo $index + 1; ?></span>
                    <div class="reasons__body">
                        <h3 class="reasons__card-title"><?php echo esc_html($reason['title']); ?></h3>
                        <p class="reasons__card-text"><?php echo esc_html($reason['text']); ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Планшет/мобилка: слайдер -->
        <div class="reasons__slider swiper">
            <div class="swiper-wrapper">
                <?php foreach ($reasons as $index => $reason) : ?>
                    <div class="swiper-slide">
                        <div class="reasons__card<?php echo $reason['dark'] ? ' reasons__card--dark' : ''; ?>">
                            <span class="reasons__number"><?php echo $index + 1; ?></span>
                            <div class="reasons__body">
                                <h3 class="reasons__card-title"><?php echo esc_html($reason['title']); ?></h3>
                                <p class="reasons__card-text"><?php echo esc_html($reason['text']); ?></p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

    </div>
</section>
