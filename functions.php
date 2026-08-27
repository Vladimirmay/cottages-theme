<?php
/**
 * Функции темы Cottages Theme
 */

// Подключение стилей и скриптов темы
function cottages_theme_enqueue_assets() {
    // Основной style.css темы
    // Версия берётся из времени изменения файла, чтобы браузер сразу подхватывал правки при разработке
    wp_enqueue_style(
        'cottages-theme-style',                                   // уникальный дескриптор (handle)
        get_stylesheet_uri(),                                     // ссылка на style.css в корне темы
        array(),                                                  // зависимости (пока нет)
        filemtime( get_stylesheet_directory() . '/style.css' )
    );

    // Скрипт бургер-меню шапки
    wp_enqueue_script(
        'cottages-theme-header',
        get_template_directory_uri() . '/js/header.js',
        array(),
        filemtime( get_template_directory() . '/js/header.js' ),
        true
    );
}
add_action('wp_enqueue_scripts', 'cottages_theme_enqueue_assets');