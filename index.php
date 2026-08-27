<?php
/**
 * Запасной шаблон (fallback).
 * Используется, если не найден более специфичный шаблон.
 */

get_header();
?>

<section class="section">
    <h1><?php the_title(); ?></h1>
</section>

<?php
get_footer();