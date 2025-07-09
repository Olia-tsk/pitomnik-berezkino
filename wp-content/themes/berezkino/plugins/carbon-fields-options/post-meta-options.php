<?php

use Carbon_Fields\Container;
use Carbon_Fields\Field;

$item_labels = array(
    'plural_name' => 'Employees',
    'singular_name' => 'вариант',
);

Container::make('post_meta', 'Подробная информация')
    ->where('post_type', '=', 'post')
    ->add_fields(array(
        Field::make('text', 'product_item_latin', __('Латинское название')),

        Field::make('rich_text', 'product_item_desc', __('Описание'))
            ->set_required(true),

        Field::make('complex', 'product_item', __('Варианты товара'))
            ->set_layout('tabbed-vertical')
            ->setup_labels($item_labels)
            ->add_fields(array(
                Field::make('text', 'product_item_age', __('Возраст саженца, лет'))
                    ->set_width(50),
                Field::make('text', 'product_item_height', __('Высота саженца, см'))
                    ->set_width(50),
                Field::make('text', 'product_item_size', __('Объём горшка, л'))
                    ->set_width(50),
                Field::make('text', 'product_item_diameter', __('Диаметр кома, м'))
                    ->set_width(50),
                Field::make('text', 'product_item_vaccination', 'Прививка'),
                Field::make('text', 'product_item_price', __('Цена, руб'))
            )),

        Field::make('image', 'product_item_image', __('Фото саженца')),
    ));
