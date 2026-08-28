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

      // Swiper — стили (CDN)
    wp_enqueue_style(
        'swiper',
        'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css',
        array(),
        '11'
    );

    // Swiper — скрипт (CDN)
    wp_enqueue_script(
        'swiper',
        'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js',
        array(),
        '11',
        true
    );

      wp_enqueue_script(
        'cottages-slider',
        get_template_directory_uri() . '/js/slider.js',
        array('swiper'),
        filemtime( get_template_directory() . '/js/slider.js' ),
        true
    );

     // Библиотека IMask (маска телефона) с CDN
    wp_enqueue_script(
        'imask',
        'https://unpkg.com/imask@7.6.1/dist/imask.min.js',
        array(),
        '7.6.1',
        true
    );
    

    // Наш скрипт формы (зависит от imask — грузится после него)
    wp_enqueue_script(
        'cottages-form',
        get_template_directory_uri() . '/js/form.js',
        array('imask'),
       filemtime( get_template_directory() . '/js/form.js' ),
        true
    );

     wp_localize_script('cottages-form', 'cottagesAjax', array(
        'url' => admin_url('admin-ajax.php'),
    ));
    
}
add_action('wp_enqueue_scripts', 'cottages_theme_enqueue_assets');


function cottages_register_application_cpt() {
    $labels = array(
        'name'          => 'Заявки',
        'singular_name' => 'Заявка',
        'menu_name'     => 'Заявки',
        'all_items'     => 'Все заявки',
        'add_new'       => 'Добавить заявку',
        'add_new_item'  => 'Новая заявка',
        'edit_item'     => 'Редактировать заявку',
        'view_item'     => 'Просмотр заявки',
        'search_items'  => 'Искать заявки',
        'not_found'     => 'Заявок не найдено',
    );

    $args = array(
        'labels'        => $labels,
        'public'        => false,      // не публичный тип — заявки не показываются на сайте
        'show_ui'       => true,       // но управляются через админку
        'show_in_menu'  => true,
        'menu_icon'     => 'dashicons-email-alt',
        'menu_position' => 25,
        'supports'      => array('title'), // нам нужен только заголовок; остальные данные — в мета-полях
        'capability_type' => 'post',
    );

    register_post_type('application', $args);
}
add_action('init', 'cottages_register_application_cpt');



/**
 * Обработчик отправки формы заявки (AJAX)
 */
function cottages_handle_application() {

    // 1. Проверка nonce — запрос действительно пришёл с нашей формы
    if ( ! isset($_POST['cottages_application_nonce']) ||
         ! wp_verify_nonce($_POST['cottages_application_nonce'], 'cottages_application_action') ) {
        wp_send_json_error(array('message' => 'Ошибка безопасности. Обновите страницу.'), 403);
    }

    // 2. Получаем и санитизируем данные
    $name  = isset($_POST['name'])  ? sanitize_text_field($_POST['name'])  : '';
    $phone = isset($_POST['phone']) ? sanitize_text_field($_POST['phone']) : '';
    $method = isset($_POST['contact_method']) ? sanitize_text_field($_POST['contact_method']) : '';
    $consent = isset($_POST['consent']) ? true : false;

    // 3. Серверная валидация
    $errors = array();

    if ( mb_strlen($name) < 2 ) {
        $errors[] = 'Укажите имя';
    }
    // Оставляем в телефоне только цифры и проверяем длину (11 цифр для +7...)
    $phone_digits = preg_replace('/\D/', '', $phone);
    if ( mb_strlen($phone_digits) < 11 ) {
        $errors[] = 'Укажите корректный телефон';
    }
    if ( ! $consent ) {
        $errors[] = 'Требуется согласие на обработку данных';
    }

    if ( ! empty($errors) ) {
        wp_send_json_error(array('message' => implode('. ', $errors)), 422);
    }

    // 4. Сохраняем заявку как запись типа "application"
    $post_id = wp_insert_post(array(
        'post_type'   => 'application',
        'post_status' => 'publish',
        'post_title'  => $name . ' — ' . date('d.m.Y H:i'),
    ));

    if ( is_wp_error($post_id) || ! $post_id ) {
        wp_send_json_error(array('message' => 'Не удалось сохранить заявку. Попробуйте позже.'), 500);
    }

    // Сохраняем детали в мета-поля
    update_post_meta($post_id, 'applicant_phone', $phone);
    update_post_meta($post_id, 'applicant_method', $method);

    // 5. Отправляем письмо менеджеру
    $to = get_option('admin_email'); // почта администратора сайта
    $subject = 'Новая заявка с сайта';
    $body = "Имя: {$name}\n"
          . "Телефон: {$phone}\n"
          . "Способ связи: {$method}\n"
          . "Дата: " . date('d.m.Y H:i');
    $headers = array('Content-Type: text/plain; charset=UTF-8');

    wp_mail($to, $subject, $body, $headers);

    // 6. Успех — отвечаем фронту
    wp_send_json_success(array('message' => 'Спасибо! Заявка отправлена, менеджер свяжется с вами.'));
}
add_action('wp_ajax_cottages_application', 'cottages_handle_application');
add_action('wp_ajax_nopriv_cottages_application', 'cottages_handle_application');



/**
 * Мета-бокс с данными заявки на странице редактирования
 */
function cottages_add_application_metabox() {
    add_meta_box(
        'application_details',           // id блока
        'Данные заявки',                 // заголовок блока
        'cottages_render_application_metabox', // функция вывода
        'application',                   // на каком типе записи показывать
        'normal',                        // расположение (основная колонка)
        'high'                           // приоритет (выше остальных)
    );
}
add_action('add_meta_boxes', 'cottages_add_application_metabox');

/**
 * Содержимое мета-бокса
 */
function cottages_render_application_metabox($post) {
    $phone  = get_post_meta($post->ID, 'applicant_phone', true);
    $method = get_post_meta($post->ID, 'applicant_method', true);
    ?>
    <p><strong>Телефон:</strong> <?php echo esc_html($phone ?: '—'); ?></p>
    <p><strong>Способ связи:</strong> <?php echo esc_html($method ?: '—'); ?></p>
    <?php
}

/**
 * Добавляем колонки в список заявок
 */
function cottages_application_columns($columns) {
    $columns['applicant_phone']  = 'Телефон';
    $columns['applicant_method'] = 'Способ связи';
    return $columns;
}
add_filter('manage_application_posts_columns', 'cottages_application_columns');

/**
 * Заполняем содержимое колонок
 */
function cottages_application_columns_content($column, $post_id) {
    if ($column === 'applicant_phone') {
        echo esc_html(get_post_meta($post_id, 'applicant_phone', true) ?: '—');
    }
    if ($column === 'applicant_method') {
        echo esc_html(get_post_meta($post_id, 'applicant_method', true) ?: '—');
    }
}
add_action('manage_application_posts_custom_column', 'cottages_application_columns_content', 10, 2);

/**
 * Регистрация типа записи "Объекты" (коттеджи для инвестиций)
 */
function cottages_register_object_cpt() {
    $labels = array(
        'name'          => 'Объекты',
        'singular_name' => 'Объект',
        'menu_name'     => 'Объекты',
        'all_items'     => 'Все объекты',
        'add_new'       => 'Добавить объект',
        'add_new_item'  => 'Новый объект',
        'edit_item'     => 'Редактировать объект',
        'view_item'     => 'Просмотр объекта',
        'search_items'  => 'Искать объекты',
        'not_found'     => 'Объектов не найдено',
    );

    $args = array(
        'labels'        => $labels,
        'public'        => false,      // на сайте отдельными страницами не открываются
        'show_ui'       => true,       // но управляются через админку
        'show_in_menu'  => true,
        'menu_icon'     => 'dashicons-admin-home',
        'menu_position' => 24,
        'supports'      => array('title'), // заголовок используем как внутреннее имя объекта
    );

    register_post_type('object_item', $args);
}
add_action('init', 'cottages_register_object_cpt');