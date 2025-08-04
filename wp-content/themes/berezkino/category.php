<?php

global $categories;
global $cat_posts;
$current_cat = get_category(get_query_var('cat'));
$current_cat_id = $current_cat->cat_ID;
$parents = get_ancestors($current_cat->cat_ID, 'category');

?>

<?php get_header() ?>

<main class="categories-page categories subcategories">
    <div class="container">
        <?php if (function_exists('qt_custom_breadcrumbs')) qt_custom_breadcrumbs(); ?>

        <div class="categories__header page-header">
            <h2 class="categories__header-title page-header__title"><?= $current_cat->name ?></h2>
        </div>

        <div class="two-columns-container">
            <?php get_sidebar(); ?>

            <div class="subcategories__wrapper">

                <?php $subcategories = getSubCategories($current_cat_id); ?>
                <?php foreach ($subcategories as $subcategory): ?>

                    <a href="<?= $subcategory->slug ?>" class="subcategories__item">
                        <div class="subcategories__item-img">
                            <img src="<?= wp_get_attachment_url(carbon_get_term_meta($subcategory->term_id, 'category_cover')) ?>" alt="Обложка категории" />
                        </div>
                        <span><?= $subcategory->name ?></span>
                    </a>

                <?php endforeach; ?>

                <?php if (empty($subcategories)): ?>
                    <?php $cat_posts = getCatPosts($current_cat_id); ?>
                    <?php if ($cat_posts): ?>
                        <?php foreach ($cat_posts as $post): ?>
                            <a href="<?php the_permalink() ?>" class="subcategories__item">
                                <div class="subcategories__item-img">
                                    <img src="<?= wp_get_attachment_url(carbon_get_post_meta(get_the_ID(), 'product_item_images')[0]); ?>" alt="Фото саженца" />
                                </div>
                                <span><?= $post->post_title ?></span>
                            </a>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p style="position: absolute;">Саженцов в этой категории пока нет</p>
                    <?php endif; ?>
                <?php endif; ?>

            </div>
        </div>
    </div>
</main>

<?php get_footer() ?>