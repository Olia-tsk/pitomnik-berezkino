<?php

/*
Plugin Name:  Reviews Admin Table
Description: Генерирует и выводит таблицу отзывов в админ-панели
Author: Olia Kurbatova
License: Free
Text Domain: reviews-admin-table
Version: 1.0
*/

// Loading WP_List_Table class file
// We need to load it as it's not automatically loaded by WordPress
if (!class_exists('WP_List_Table')) {
    require_once(ABSPATH . 'wp-admin/includes/class-wp-list-table.php');
}

// Extending class
class Reviews_List_Table extends WP_List_Table
{
    // define $table_data property
    private $table_data;

    // Define table columns
    function get_columns()
    {
        $columns = array(
            'cb'            => '<input type="checkbox" />',
            'review_name'          => __('Автор', 'reviews-cookie-consent'),
            'review_text'         => __('Текст отзыва', 'reviews-cookie-consent'),
            'review_status'   => __('Статус публикации', 'reviews-cookie-consent'),
            'review_date'        => __('Дата написания', 'reviews-cookie-consent')
        );
        return $columns;
    }

    // Bind table with columns, data and all
    /**
     * @global string $mode           List table view mode.
     * @global int    $post_id
     */
    function prepare_items()
    {
        //data
        $this->table_data = $this->get_table_data();

        $columns = $this->get_columns();
        $hidden = (is_array(get_user_meta(get_current_user_id(), 'managetoplevel_page_reviews_list_tablecolumnshidden', true))) ? get_user_meta(get_current_user_id(), 'managetoplevel_page_reviews_list_tablecolumnshidden', true) : array();
        $sortable = $this->get_sortable_columns();
        $primary  = 'name';
        $this->_column_headers = array($columns, $hidden, $sortable, $primary);

        usort($this->table_data, array(&$this, 'usort_reorder'));

        /* pagination */
        $per_page = $this->get_items_per_page('elements_per_page', 10);
        $current_page = $this->get_pagenum();
        $total_items = count($this->table_data);

        $this->table_data = array_slice($this->table_data, (($current_page - 1) * $per_page), $per_page);

        $this->set_pagination_args(array(
            'total_items' => $total_items, // total number of items
            'per_page'    => $per_page, // items to show on a page
            'total_pages' => ceil($total_items / $per_page) // use ceil to round up
        ));

        $this->items = $this->table_data;
    }

    // Get table data
    private function get_table_data()
    {
        global $wpdb;

        $table = $wpdb->prefix . 'reviews';

        return $wpdb->get_results(
            "SELECT * from {$table}",
            ARRAY_A
        );
    }

    function column_default($item, $column_name)
    {
        switch ($column_name) {
            case 'review_id':
            case 'review_name':
            case 'review_text':
            case 'review_status':
            case 'review_date':
            default:
                return $item[$column_name];
        }
    }

    function column_cb($item)
    {
        return sprintf(
            '<input type="checkbox" name="element[]" value="%s" />',
            $item['review_id']
        );
    }

    protected function get_sortable_columns()
    {
        $sortable_columns = array(
            'review_name'  => array('review_name', false),
            'review_status' => array('review_status', false),
            'review_date'   => array('review_date', false)
        );
        return $sortable_columns;
    }

    function usort_reorder($a, $b)
    {
        // If no sort, default to user_login
        $orderby = (!empty($_GET['orderby'])) ? $_GET['orderby'] : 'review_date';

        // If no order, default to asc
        $order = (!empty($_GET['order'])) ? $_GET['order'] : 'desc';

        // Determine sort order
        $result = strcmp($a[$orderby], $b[$orderby]);

        // Send final sort direction to usort
        return ($order === 'asc') ? $result : -$result;
    }



    // Adding action links to column
    function column_review_name($item)
    {
        $actions = array(
            'accept'      => sprintf('<a href="?page=%s&action=%s&element=%s">' . __('Опубликовать', 'reviews-admin-table') . '</a>', $_REQUEST['page'], 'accept', $item['review_id']),
            'unapprove'      => sprintf('<a class="unapprove" href="?page=%s&action=%s&element=%s">' . __('Отклонить', 'reviews-admin-table') . '</a>', $_REQUEST['page'], 'unapprove', $item['review_id']),
            'delete'    => sprintf('<a href="?page=%s&action=%s&element=%s">' . __('Удалить', 'reviews-admin-table') . '</a>', $_REQUEST['page'], 'delete', $item['review_id']),
        );

        return sprintf('%1$s %2$s', $item['review_name'], $this->row_actions($actions));
    }

    // To show bulk action dropdown
    function get_bulk_actions()
    {
        $actions = array(
            'accept_all' => __('Опубликовать', 'reviews-admin-table'),
            'unapprove_all' => __('Отклонить', 'reviews-admin-table'),
            'delete_all'    => __('Удалить', 'reviews-admin-table'),
        );

        return $actions;
    }

    function process_bulk_action()
    {
        global $wpdb;

        if ('delete_all' === $this->current_action()) {
            $ids = isset($_REQUEST['element']) ? $_REQUEST['element'] : array();

            if (is_array($ids)) $ids = implode(',', $ids);

            if (!empty($ids)) {
                $wpdb->query("DELETE FROM wp_reviews WHERE review_id IN($ids)");
            }
        }

        if ('delete' === $this->current_action()) {
            $id = $_REQUEST['element'];
            if (!empty($id)) {
                $wpdb->delete('wp_reviews', ['review_id' => $id]);
            }
        }

        if ('accept_all' === $this->current_action()) {
            $ids = isset($_REQUEST['element']) ? $_REQUEST['element'] : array();

            if (is_array($ids)) $ids = implode(',', $ids);

            if (!empty($ids)) {
                $wpdb->query("UPDATE wp_reviews SET review_status = 'опубликовано' WHERE review_id IN($ids)");
            }
        }

        if ('accept' === $this->current_action()) {
            $id = $_REQUEST['element'];
            if (!empty($id)) {
                $wpdb->update(
                    'wp_reviews',
                    ['review_status' => 'опубликовано'],
                    ['review_id' => $id]
                );
            }
        }

        if ('unapprove_all' === $this->current_action()) {
            $ids = isset($_REQUEST['element']) ? $_REQUEST['element'] : array();

            if (is_array($ids)) $ids = implode(',', $ids);

            if (!empty($ids)) {
                $wpdb->query("UPDATE wp_reviews SET review_status = 'отказ' WHERE review_id IN($ids)");
            }
        }

        if ('unapprove' === $this->current_action()) {
            $id = $_REQUEST['element'];
            if (!empty($id)) {
                $wpdb->update(
                    'wp_reviews',
                    ['review_status' => 'отказ'],
                    ['review_id' => $id]
                );
            }
        }
    }
}


// Adding menu
function add_reviews_menu_item()
{

    global $reviews_sample_page;

    // add settings page
    $reviews_sample_page = add_menu_page(__('Отзывы', 'reviews-admin-table'), __('Отзывы', 'reviews-admin-table'), 'edit_pages', 'reviews_table', 'reviews_list_init', 'dashicons-admin-comments', 9);

    add_action("load-$reviews_sample_page", "reviews_sample_screen_options");
}
add_action('admin_menu', 'add_reviews_menu_item');

// add screen options
function reviews_sample_screen_options()
{

    global $reviews_sample_page;
    global $table;

    $screen = get_current_screen();

    // get out of here if we are not on our settings page
    if (!is_object($screen) || $screen->id != $reviews_sample_page)
        return;

    $args = array(
        'label' => __('Количество элементов на странице', 'reviews-admin-table'),
        'default' => 5,
        'option' => 'elements_per_page'
    );
    add_screen_option('per_page', $args);

    $table = new Reviews_List_Table();
}

add_filter('set-screen-option', 'reviews_table_set_option', 10, 5);
function reviews_table_set_option($status, $option, $value)
{
    return $value;
}

// Plugin menu callback function
function reviews_list_init()
{
    // Creating an instance
    $table = new Reviews_List_Table();
    $table->process_bulk_action();
    // Prepare table
    $table->prepare_items();


    $message = '';
    if ('delete_all' === $table->current_action()) {
        $message = '<div class="updated below-h2" id="message"><p>' . sprintf(__('Успешно удалено: %d', 'reviews-admin-table'), count($_REQUEST['element'])) . '</p></div>';
    }

    if ('delete' === $table->current_action()) {
        $message = '<div class="updated below-h2" id="message"><p>' . sprintf(__('Отзыв успешно удален', 'reviews-admin-table')) . '</p></div>';
    }

    if ('accept' === $table->current_action()) {
        $message = '<div class="updated below-h2" id="message"><p>' . sprintf(__('Отзыв успешно опубликован на сайте', 'reviews-admin-table')) . '</p></div>';
    }

    if ('accept_all' === $table->current_action()) {
        $message = '<div class="updated below-h2" id="message"><p>' . sprintf(__('Отзывы успешно опубликованы на сайте', 'reviews-admin-table')) . '</p></div>';
    }

    if ('unapprove' === $table->current_action()) {
        $message = '<div class="updated below-h2" id="message"><p>' . sprintf(__('Отзыв снят с публикации на сайте', 'reviews-admin-table')) . '</p></div>';
    }

    if ('unapprove_all' === $table->current_action()) {
        $message = '<div class="updated below-h2" id="message"><p>' . sprintf(__('Отзывы сняты с публикации на сайте', 'reviews-admin-table')) . '</p></div>';
    }

    echo '<div class="wrap"><h2>Модерация отзывов</h2>';

    echo $message;
    echo '<form action="" method="post">';

    // Display table
    $table->display();
    echo '</form></div>';
}

// подправим ширину колонки через css
add_action('admin_head', 'resize_columns');
function resize_columns()
{
    echo '<style type="text/css">.column-review_name{ width:21%; }</style>';
    echo '<style type="text/css">.column-review_status{ width:15%; }</style>';
    echo '<style type="text/css">.column-review_date{ width:15%; }</style>';
    echo '<style type="text/css">.unapprove{ color:#996800; } .unapprove:hover{ color:#996800; } </style>';
}
