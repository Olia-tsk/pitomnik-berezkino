<?php

use Carbon_Fields\Container;
use Carbon_Fields\Field;

Container::make('theme_options', 'Прайсы')
    ->set_icon('dashicons-money-alt')
    ->set_page_menu_position(5)
    ->add_fields(array(
        Field::make('html', 'information_text')
            ->set_html('<h2 class="information-warning">После загрузки прайсов, не забудьте нажать кнопку "Сохранить изменения".</h2>'),

        Field::make('file', 'price_full', 'Полный прайс')
            ->set_type(array('application/pdf', 'application/excel')),

        Field::make('file', 'price_fruit_berry', 'Плодово-ягодные культуры')
            ->set_type(array('application/pdf', 'application/excel')),

        Field::make('file', 'price_coniferous', 'Хвойные Растения')
            ->set_type(array('application/pdf', 'application/excel')),

        Field::make('file', 'price_ornamental_shrubs', 'Декоративные кустарники')
            ->set_type(array('application/pdf', 'application/excel')),

        Field::make('file', 'price_lianas', 'Лианы')
            ->set_type(array('application/pdf', 'application/excel')),

        Field::make('file', 'price_ornamental_trees', 'Декоративные деревья')
            ->set_type(array('application/pdf', 'application/excel')),
    ));
