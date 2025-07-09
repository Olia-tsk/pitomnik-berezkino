<?php
/*
Template Name: Категории
*/

global $categories;
?>

<?php get_header() ?>

<main class="categories-page categories">
    <div class="container">

        <?php if (function_exists('qt_custom_breadcrumbs')) qt_custom_breadcrumbs(); ?>

        <div class="categories__header page-header">
            <h2 class="categories__header-title page-header__title">Категории</h2>
        </div>

        <div class="two-columns-container">
            <?php get_sidebar(); ?>

            <div class="categories__wrapper">
                <a href="<?= get_category_link(2) ?>" class="categories__item categories__item--fruit-berry-crops">
                    <p>
                        Плодово-ягодные <br />
                        культуры

                    </p>
                    <img src="<?php bloginfo('template_url') ?>/assets/images/catalog-fruit-berry-crops-full.png" alt="" />
                </a>
                <a href="<?= get_category_link(29) ?>" class="categories__item categories__item--decorative-shrubs">
                    <p>
                        Декоративные <br />
                        Кустарники
                    </p>
                    <img src="<?php bloginfo('template_url') ?>/assets/images/catalog-decorative-shrubs-full.png" alt="" />
                </a>
                <a href="<?= get_category_link(30) ?>" class="categories__item">
                    <p>Лианы</p>
                    <img src="<?php bloginfo('template_url') ?>/assets/images/catalog-lianas.png" alt="" />
                </a>
                <a href="<?= get_category_link(31) ?>" class="categories__item">
                    <p>
                        Хвойные <br />
                        Растения
                    </p>
                    <img src="<?php bloginfo('template_url') ?>/assets/images/catalog-coniferous-plants.png" alt="" />
                </a>
                <a href="<?= get_category_link(16) ?>" class="categories__item">
                    <p>
                        Декоративные <br />
                        Деревья
                    </p>
                    <img src="<?php bloginfo('template_url') ?>/assets/images/catalog-decorative-trees.png" alt="" />
                </a>
            </div>
        </div>
    </div>
</main>

<?php get_footer() ?>