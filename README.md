# Cottages Theme

Кастомная WordPress-тема лендинга для проекта инвестиций в загородную недвижимость (коттеджные посёлки). Тема — одностраничник (`front-page.php`) с якорной навигацией по блокам.

## Стек

- WordPress + PHP-шаблоны (без Composer/автозагрузчика)
- SCSS (Dart Sass) → компилируется в `style.css`
- Advanced Custom Fields (ACF) — часть контента заведена как поля
- Swiper (подключается с CDN) — слайдеры
- IMask (с CDN) — маска телефона в форме заявки
- Vanilla JS без фреймворков и сборщика (файлы из `js/` подключаются напрямую)

## Команды

```
npm install    # ставит sass
npm run sass    # разовая сборка scss/main.scss -> style.css
npm run watch    # сборка при каждом изменении scss
```

**Важно:** `style.css` — файл идентификации темы для WordPress, он должен начинаться с блока `/* Theme Name: ... */`. Компилятор Sass это не сохраняет — после каждого запуска `npm run sass` шапку нужно вернуть в начало `style.css` вручную, иначе WordPress перестанет видеть тему.

## Структура страницы (front-page.php)

Секции идут в этом порядке, у каждой есть `id` для якорных ссылок:

| Секция | id | Файл | Контент |
|---|---|---|---|
| Hero | `#hero` | `front-page.php` | ACF-поля (`hero_supertitle`, `hero_title`, `hero_description`, `hero_button_text`, `hero_background`) |
| Почему именно мы | `#reasons` | `template-parts/section-reasons.php` | Захардкожено (5 карточек), позже переедет в ACF |
| Коротко о нас | `#about` | `template-parts/section-about.php` | ACF-поля (`about_text`, `about_image_main`, `about_image_top`, `about_image_bottom`) |
| CTA-баннер («Оставьте заявку») | `#cta` | `template-parts/section-cta.php` | Захардкожено, ссылка кнопки ведёт на `#contact` |
| Этапы инвестиций | `#cycle` | `template-parts/section-cycle.php` | ACF-группы `step_1` … `step_5` |
| Актуальные предложения | `#objects` | `template-parts/section-objects.php` + `template-parts/object-card.php` | CPT `object_item` (см. ниже) |
| Форма заявки | `#contact` | `template-parts/section-contact.php` | Статичная форма, отправка через AJAX |

Одна и та же навигация (эти 5 якорей) продублирована в трёх местах: `header.php` (десктоп-меню и бургер-меню на мобилке) и `footer.php`.

## Кастомные типы записей

- **`application`** («Заявки») — заявки с формы обратной связи. Не публичный (`public: false`), viewится только в админке. Мета: `applicant_phone`, `applicant_method`.
- **`object_item`** («Объекты») — карточки объектов для слайдера «Актуальные предложения». Тоже не публичный. Поля через ACF: `object_image`, `object_market_price`, `object_buy_price`, `object_term`, `object_profit`.

## Форма заявки

`section-contact.php` → AJAX-обработчик `cottages_handle_application()` в `functions.php`:
- проверка nonce (`cottages_application_nonce`);
- серверная валидация имени/телефона/согласия;
- сохранение как запись `application` + мета-поля;
- письмо на `admin_email` через `wp_mail()`.

## Адаптив

Общие брейкпоинты (`scss/_variables.scss`):
- `$bp-tablet: 960px`
- `$bp-mobile: 768px`

На `≤960px` в шапке появляется бургер-меню (вместо инлайн-навигации), сетки блоков `reasons`/`objects` переключаются в слайдеры на Swiper.

## Широкоформатные мониторы

Весь контент (шапка, `main`, футер) обёрнут в `.page-wrap` с `max-width: $max-content-width` (1920px) и центровкой — на экранах шире 1920px раскладка не растягивается, лишнее пространство уходит в поля по бокам. Full-bleed слайдеры (`objects`, `reasons`) в `js/slider.js` растягиваются до края `.page-wrap`, а не до истинного края окна — это учтено отдельно.

## Плавный скролл

`html { scroll-behavior: smooth; }` в `scss/_base.scss` — работает для всех якорных ссылок (шапка, футер, бургер-меню, кнопки CTA).
