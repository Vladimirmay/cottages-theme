<?php
/**
 * Часть шаблона: секция "Инвестиционный цикл"
 */

$steps = array();

for ($i = 1; $i <= 5; $i++) {
    $group = get_field('step_' . $i);

    if (empty($group) || empty($group['title'])) {
        continue;
    }

    $steps[] = array(
        'title' => $group['title'],
        'desc1' => $group['desc1'] ?? '',
        'desc2' => $group['desc2'] ?? '',
    );
}
?>

<section id="cycle" class="section section--cycle">
    <div class="cycle container">

        <div class="cycle__head">
            <span class="cycle__label">Этапы инвестиций</span>
            <h2 class="cycle__title">Инвестиционный цикл</h2>
        </div>

        <div class="cycle__list">
            <?php foreach ($steps as $index => $step) : ?>
                <div class="cycle__step">
                    <div class="cycle__number"><?php echo $index + 1; ?></div>
                    <h3 class="cycle__step-title"><?php echo esc_html($step['title']); ?></h3>
                    <div class="cycle__step-desc">
                        <p><?php echo esc_html($step['desc1']); ?><br/><?php echo esc_html($step['desc2']); ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

    </div>
</section>