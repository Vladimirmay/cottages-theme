<?php
/**
 * Функции темы Cottages Theme
 */

// Подключение стилей и скриптов темы
function cottages_theme_enqueue_assets() {
    // Основной style.css темы
    wp_enqueue_style(
        'cottages-theme-style',           // уникальный дескриптор (handle)
        get_stylesheet_uri(),             // ссылка на style.css в корне темы
        array(),                          // зависимости (пока нет)
        wp_get_theme()->get('Version')    // версия темы — для сброса кэша браузера
    );
}
add_action('wp_enqueue_scripts', 'cottages_theme_enqueue_assets');