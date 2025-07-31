<?php
/*
Template Name: Прайс листы
*/
?>

<?php get_header() ?>

<main class="price-page price">
    <div class="container">
        <div class="price__header page-header">
            <h2 class="price__header-title page-header__title">Прайс листы</h2>
            <p class="price__header-subtitle page-header__subtitle">Cкачайте актуальные прайс листы и ознакомьтесь с растениями</p>
        </div>

        <div class="price__wrapper">
            <a class="price__item" href="<?= wp_get_attachment_url(carbon_get_theme_option('price_fruit_berry')) ?>" download="">
                <p class="price__item-title">
                    Плодово-ягодные <br />
                    культуры
                </p>
                <div class="price__item-col">
                    <span>
                        <?= carbon_get_theme_option('price_period') ?>
                    </span>
                    <p class="price__item-download">
                        <svg class="svg-icon">
                            <use xlink:href="<?php bloginfo('template_url') ?>/assets/images/sprite.svg#icon-download"></use>
                        </svg>
                        Скачать
                    </p>
                </div>
            </a>
            <a class="price__item" href="<?= wp_get_attachment_url(carbon_get_theme_option('price_coniferous')) ?>" download="">
                <p class="price__item-title">
                    Хвойные <br />
                    Растения
                </p>
                <div class="price__item-col">
                    <span>
                        <?= carbon_get_theme_option('price_period') ?>
                    </span>
                    <p class="price__item-download">
                        <svg class="svg-icon">
                            <use xlink:href="<?php bloginfo('template_url') ?>/assets/images/sprite.svg#icon-download"></use>
                        </svg>
                        Скачать
                    </p>
                </div>
            </a>
            <a class="price__item" href="<?= wp_get_attachment_url(carbon_get_theme_option('price_ornamental_shrubs')) ?>" download="">
                <p class="price__item-title">
                    Декоративные <br />
                    кустарники
                </p>
                <div class="price__item-col">
                    <span>
                        <?= carbon_get_theme_option('price_period') ?>
                    </span>
                    <p class="price__item-download">
                        <svg class="svg-icon">
                            <use xlink:href="<?php bloginfo('template_url') ?>/assets/images/sprite.svg#icon-download"></use>
                        </svg>
                        Скачать
                    </p>
                </div>
            </a>
            <a class="price__item" href="<?= wp_get_attachment_url(carbon_get_theme_option('price_lianas')) ?>" download="">
                <p class="price__item-title">Лианы</p>
                <div class="price__item-col">
                    <span>
                        <?= carbon_get_theme_option('price_period') ?>
                    </span>
                    <p class="price__item-download">
                        <svg class="svg-icon">
                            <use xlink:href="<?php bloginfo('template_url') ?>/assets/images/sprite.svg#icon-download"></use>
                        </svg>
                        Скачать
                    </p>
                </div>
            </a>
            <a class="price__item" href="<?= wp_get_attachment_url(carbon_get_theme_option('price_ornamental_trees')) ?>" download="">
                <p class="price__item-title">
                    Декоративные <br />
                    деревья
                </p>
                <div class="price__item-col">
                    <span>
                        <?= carbon_get_theme_option('price_period') ?>
                    </span>
                    <p class="price__item-download">
                        <svg class="svg-icon">
                            <use xlink:href="<?php bloginfo('template_url') ?>/assets/images/sprite.svg#icon-download"></use>
                        </svg>
                        Скачать
                    </p>
                </div>
            </a>
            <a class="price__item" href="<?= wp_get_attachment_url(carbon_get_theme_option('price_full')) ?>" download="">
                <p class="price__item-title">
                    Полный прайс
                </p>
                <div class="price__item-col">
                    <span>
                        <?= carbon_get_theme_option('price_period') ?>
                    </span>
                    <p class="price__item-download">
                        <svg class="svg-icon">
                            <use xlink:href="<?php bloginfo('template_url') ?>/assets/images/sprite.svg#icon-download"></use>
                        </svg>
                        Скачать
                    </p>
                </div>
            </a>
        </div>
    </div>
</main>

<?php get_footer() ?>