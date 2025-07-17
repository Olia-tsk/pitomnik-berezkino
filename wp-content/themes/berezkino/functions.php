<?php

add_theme_support('title-tag');
add_theme_support('post-thumbnails', array('article'));

// удаляем скрипты, которые подгружаются автоматически
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'rsd_link');

// подключение стилей и скриптов
add_action('wp_enqueue_scripts', function () {
    // подключение стилей
    wp_enqueue_style('splide', get_template_directory_uri() . '/assets/css/splide.min.css');
    wp_enqueue_style('toastify', 'https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css', array(), '1.12');
    wp_enqueue_style('style', get_template_directory_uri() . '/assets/css/style.min.css', array(), '1.0');

    // подключение скриптов
    wp_enqueue_script('splide', get_template_directory_uri() . '/assets/script/splide.min.js', array(), '1.0', true);
    wp_enqueue_script('toastify', 'https://cdn.jsdelivr.net/npm/toastify-js', array(), '1.12', true);
    wp_enqueue_script('validate', get_template_directory_uri() . '/assets/script/jquery.validate.min.js', array(), '1.19', true);
    wp_enqueue_script('mask', get_template_directory_uri() . '/assets/script/jquery.mask.min.js', array(), '1.14', true);
    wp_enqueue_script('main', get_template_directory_uri() . '/assets/script/main.js', array('jquery'), '1.0', true);

    wp_localize_script('main', 'ajax', array(
        'url' => admin_url('admin-ajax.php'),
    ));
});

// подключаем плагин Carbon Fields
add_action('after_setup_theme', 'crb_load');
function crb_load()
{
    require_once('plugins/carbon-fields/vendor/autoload.php');
    \Carbon_Fields\Carbon_Fields::boot();
}

// подключаем файлы с настройками Carbon Fields для отдельных разделов
add_action('carbon_fields_register_fields', 'register_new_carbon_fields');
function register_new_carbon_fields()
{
    require_once('plugins/carbon-fields-options/post-meta-options.php');
    require_once('plugins/carbon-fields-options/term-meta-options.php');
}

// Открываем видимость Carbon Fields theme-options для пользователей с ролью ниже администратора
add_filter('carbon_fields_theme_options_container_admin_only_access', '__return_false');

// Регистрируем новые колонки для таблицы в разделе Саженцы
add_filter('manage_posts_columns', 'custom_posts_columns');
function custom_posts_columns($columns)
{
    // Удаляем ненужные колонки
    unset($columns['author']);
    unset($columns['tags']);

    // Добавляем свои колонки
    $columns['plant_age'] = 'Возраст';
    $columns['plant_height'] = 'Высота, см';
    $columns['plant_size'] =  'Объём, л';
    $columns['plant_diameter'] = 'Диаметр, м';
    $columns['plant_price'] = 'Цена, ₽/шт';

    // Можно переставить порядок колонок, создав новый массив
    $new_columns = array(
        'cb' => $columns['cb'], // Чекбокс
        'title' => $columns['title'], // Заголовок
        'categories' => $columns['categories'], // Категории
        'plant_age' => $columns['plant_age'],
        'plant_height' => $columns['plant_height'],
        'plant_size' => $columns['plant_size'],
        'plant_diameter' => $columns['plant_diameter'],
        'plant_price' => $columns['plant_price'],
        'date' => $columns['date'], // Дата

    );

    return $new_columns;
}

// Заполняем новые колонки в разделе Саженцы данными
add_action('manage_posts_custom_column', 'custom_posts_column_content', 10, 2);
function custom_posts_column_content($column_name, $post_id)
{
    $plant_data = carbon_get_the_post_meta('product_item');

    if ($column_name == 'plant_age') {
        foreach ($plant_data as $item) {
            echo $item['product_item_age'] . "<br>";
        }
    }
    if ($column_name == 'plant_height') {
        foreach ($plant_data as $item) {
            echo $item['product_item_height'] . "<br>";
        }
    }
    if ($column_name == 'plant_size') {
        foreach ($plant_data as $item) {
            echo $item['product_item_size'] . "<br>";
        }
    }
    if ($column_name == 'plant_diameter') {
        foreach ($plant_data as $item) {
            echo $item['product_item_diameter'] . "<br>";
        }
    }
    if ($column_name == 'plant_price') {
        foreach ($plant_data as $item) {
            echo $item['product_item_price'] . "<br>";
        }
    }
}

// получаем список главных категорий
$categories = get_categories([
    'taxonomy'     => 'category',
    'orderby'      => 'name',
    'order'        => 'ASC',
    'hide_empty'   => 0,
    'hierarchical' => 1,
    'pad_counts'   => true,
    'childless'    => false,
    'parent'       => 0,
    'type'         => 'post',
    'exclude'       => 1
]);

// получаем список подкатегорий
function getSubCategories($current_cat_id)
{
    $subcategories = get_categories([
        'taxonomy'     => 'category',
        'orderby'      => 'name',
        'order'        => 'ASC',
        'hide_empty'   => 1,
        'parent'        => $current_cat_id,
        'type'         => 'post',
    ]);

    return $subcategories;
}

// получаем список саженцев
function getCatPosts($current_cat_id)
{
    $cat_posts = get_posts(array(
        'numberposts'       => -1,
        'posts_per_page'    => -1,
        'category'          => $current_cat_id,
        'post_type'         => 'post',
        'post_status'       => 'publish',
        'orderby'           => 'title',
        'order'             => 'ASC',
    ));

    return $cat_posts;
}

// изменяем названия типа записи - post
add_filter('register_post_type_args', 'filter_register_post_type_args', 10, 2);
function filter_register_post_type_args($args, $post_type)
{
    if ('post' == $post_type) {
        $args['labels'] = [
            'name'          => 'Саженцы',
            'singular_name' => 'Саженец',
            'add_new'       => 'Добавить саженец',
            'add_new_item'  => 'Добавить саженец',
            'edit_item'     => 'Редактирование',
            'search_items'  => 'Поиск',
        ];

        $args['menu_icon'] = 'dashicons-palmtree';
        $args['show_in_rest'] = false;
    }

    return $args;
}

// скрываем тектовый редактор для типа записи - post
add_action('init', 'my_remove_post_formats_support', 10);
function my_remove_post_formats_support()
{
    remove_post_type_support('post', 'editor');
}

// удаляем ненужные поля для типа записи - post
add_action('add_meta_boxes', 'remove_post_custom_fields', 10);
function remove_post_custom_fields()
{
    remove_meta_box('tagsdiv-post_tag', 'post', 'normal');
    remove_meta_box('revisionsdiv', 'post', 'normal');
    remove_meta_box('commentsdiv', 'post', 'normal');
}

// регистрируем новые типы записей
add_action('init', 'register_post_types');
function register_post_types()
{
    register_post_type('article', [
        'label'  => 'article',
        'labels' => [
            'name'                     => 'Статьи',
            'singular_name'            => 'Статья',
            'add_new'                  => 'Добавить статью',
            'add_new_item'             => 'Добавить новую статью',
            'edit_item'                => 'Редактировать статью',
            'new_item'                 => 'Новая статья',
            'view_item'                => 'Посмотреть статью',
            'search_items'             => 'Найти статью',
            'not_found'                => 'Статьи не найдены',
            'not_found_in_trash'       => 'Статьи в корзине не найдены',
            'parent_item_colon'        => '',

            'insert_into_item'         => 'Добавить в статью',
            'uploaded_to_this_item'    => 'Загружено для этой статьи',
            'featured_image'           => 'Миниатюра статьи',
            'set_featured_image'       => 'Установить миниатюру',
            'remove_featured_image'    => 'Удалить миниатюру',
            'use_featured_image'       => 'Использовать как миниатюру статьи',
            'filter_items_list'        => 'Фильтровать список статей',
            'items_list_navigation'    => 'Навигация',
            'items_list'               => 'Список статей',
            'menu_name'                => 'Статьи',
            'name_admin_bar'           => 'Статью',
            'view_items'               => 'Посмотреть статьи',
            'attributes'               => 'Свойства статьи',

            'item_updated'             => 'Статья обновлена',
            'item_published'           => 'Статья опубликована',
            'item_published_privately' => 'Статья опубликована как личная',
            'item_reverted_to_draft'   => 'Статья сохранена как черновик',
            'item_scheduled'           => 'Публикация статьи отложена',

        ],
        'description'           => '',
        'public'                => true,
        'show_in_menu'          => true,
        'show_in_rest'          => true,
        'rest_base'             => null,
        'menu_position'         => 9,
        'menu_icon'             => 'dashicons-media-document',
        'hierarchical'          => true,
        'supports'              => ['title', 'editor', 'thumbnail'],
        'taxonomies'            => [],
        'rewrite'               => ['slug' => 'articles'],
    ]);
}

// получаем список всех статей
function getArticles($article_id = '')
{
    $my_articles = get_posts(array(
        'numberposts'       => -1,
        'posts_per_page'    => -1,
        'exclude'           => $article_id,
        'orderby'           => 'date',
        'order'             => 'DESC',
        'post_type'         => 'article',
    ));

    return $my_articles;
}

// хлебные крошки
function qt_custom_breadcrumbs()
{

    $showOnHome = 0; // 1 - show breadcrumbs on the homepage, 0 - don't show
    $delimiter = '/';
    $home = 'Главная';
    $showCurrent = 1; // 1 - show current post/page title in breadcrumbs, 0 - don't show
    $before = '<span class="breadcrumps__link breadcrumps__link--active">';
    $after = '</span>';

    global $post;
    $homeLink = get_bloginfo('url');
    $catLink = get_bloginfo('url') . '/categories';

    if (is_home() || is_front_page()) {
        if ($showOnHome == 1) echo '<div id="crumbs"><a href="' . $homeLink . '">' . $home . '</a></div>';
    } else {
        if (is_category() || is_single()) {
            echo '<div class="product__breadcrumps breadcrumps"><a class="breadcrumps__link" href="' . $homeLink . '">' . $home . '</a> ' . $delimiter . '<a class="breadcrumps__link" href="' . $catLink . '">' . 'Категории' . '</a>' . $delimiter;
        } else {

            echo '<div class="product__breadcrumps breadcrumps"><a class="breadcrumps__link" href="' . $homeLink . '">' . $home . '</a> ' . $delimiter . $before  . 'Категории' . $after;
        }
    }
    if (is_category()) {
        $thisCat = get_category(get_query_var('cat'), false);
        if ($thisCat->parent != 0) echo  get_category_parents($thisCat->parent, TRUE, $delimiter);

        echo  $before . single_cat_title('', false) . $after;
    } elseif (is_single() && !is_attachment()) {
        $cat = get_the_category();
        $cat = $cat[0];
        $cats = get_category_parents($cat, TRUE,  $delimiter);
        if ($showCurrent == 0) $cats = preg_replace("#^(.+)\s$delimiter\s$#", "$1", $cats);
        echo $cats;
        if ($showCurrent == 1) echo $before . get_the_title() . $after;
    }

    echo '</div>';
}

// скрываем кнопку add media из редактора TinyMCE
add_filter('crb_media_buttons_html', 'truemisha_no_tinymce_buttons_at_all', 25);
function truemisha_no_tinymce_buttons_at_all($html)
{
    return;
}

add_action('wp_ajax_get_cart_items', 'get_cart_items_ajax');
add_action('wp_ajax_nopriv_get_cart_items', 'get_cart_items_ajax');

function get_cart_items_ajax()
{
    $order_items = [];
    // Получаем и фильтруем данные из JS
    if (isset($_POST['localStorage']) && !empty($_POST['localStorage'])) {
        $decoded = json_decode(wp_unslash($_POST['localStorage']));
        if (is_array($decoded)) {
            $order_items = $decoded;
            sort($order_items);
        }
    }

    // Передаём переменные в шаблон
    set_query_var('order_items', $order_items);

    // Генерируем HTML через шаблон
    ob_start();
    get_template_part('template-parts/ajax-response');
    $html = ob_get_clean();

    wp_send_json_success(['html' => $html]);
}

add_action('wp_ajax_send_order_to_telegram', 'send_order_to_telegram_callback');
add_action('wp_ajax_nopriv_send_order_to_telegram', 'send_order_to_telegram_callback');

function send_order_to_telegram_callback()
{
    $message = "";

    $token = defined('TELEGRAM_BOT_TOKEN') ? TELEGRAM_BOT_TOKEN : '';
    $chat_id = defined('TELEGRAM_CHAT_ID') ? TELEGRAM_CHAT_ID : '';

    if (isset($_POST['checkField']) && empty($_POST['checkField'])) {
        $phone = isset($_POST['phone']) && !empty($_POST['phone']) ? htmlspecialchars($_POST['phone']) : "error";

        $name = isset($_POST['name']) && !empty($_POST['name']) ? htmlspecialchars($_POST['name']) : "error";

        $comment = isset($_POST['comment']) && !empty($_POST['comment']) ? htmlspecialchars($_POST['comment']) : "Комментарий не указан";

        $orderContentRaw = isset($_POST['orderContent']) ? wp_unslash($_POST['orderContent']) : '';

        $orderContent = !empty($orderContentRaw) ? json_decode($orderContentRaw, true) : [];

        $totalItemsAmount = isset($_POST['totalItemsAmount']) && !empty($_POST['totalItemsAmount']) ? htmlspecialchars($_POST['totalItemsAmount']) : "0";

        $totalSumm = isset($_POST['totalItemsSumm']) && !empty($_POST['totalItemsSumm']) ? htmlspecialchars($_POST['totalItemsSumm']) : "0";

        if (!is_array($orderContent)) {
            $orderContent = [];
        }

        if (is_array($orderContent) && count($orderContent) > 0) {
            $orderList = "";
            $lastIndex = count($orderContent) - 1;
            foreach ($orderContent as $i => $item) {
                $orderList .= "\n" . ($item['name'] ?? 'Без названия') . "\n" . ($item['data'] ?? 'Нет данных') . "\n" . "Количество: " . ($item['amount'] ?? '0');
                if ($i !== $lastIndex) {
                    $orderList .= "\n***";
                }
            }
        } else {
            $orderList = "Нет данных";
        }

        $messageData = array(
            'Имя:' => $name,
            'Телефон:' => $phone,
            'Комментарий к заказу:' => $comment,
            'Состав заказа:' => $orderList,
            'Общее количество:' => $totalItemsAmount,
            'Общая стоимость:' => $totalSumm,
        );

        foreach ($messageData as $key => $value) {
            $message .= "<b>" . $key . "</b> " . $value . "\n";
        };

        $url = "https://api.telegram.org/bot{$token}/sendMessage?chat_id={$chat_id}&parse_mode=html&text=" . urlencode($message);
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($http_code == 200) {
            wp_send_json_success(['message' => 'Message has been sent']);
        } else {
            wp_send_json_error([
                'status' => 'fail',
                'http_code' => $http_code,
                'response' => $response
            ]);
        }
    }
}
