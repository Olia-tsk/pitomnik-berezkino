<?php
/*
Template Name: Статьи
*/

$my_articles = getArticles();
global $post;
?>

<?php get_header() ?>

<main class="articles-page articles">
    <div class="container">
        <div class="articles__header page-header">
            <h2 class="articles__header-title page-header__title">Полезная информация</h2>
            <p class="articles__header-subtitle page-header__subtitle">
                Откройте для себя разнообразие растений для вашего дома и сада прямо сейчас!
            </p>
        </div>

        <ul class="articles-list">

            <?php foreach ($my_articles as $post): ?>
                <?php setup_postdata($post) ?>
                <li class="articles-list__item">
                    <a class="articles-list__link" href="<?php the_permalink() ?>">
                        <div class="articles-list__img">
                            <img src="<?= get_the_post_thumbnail_url() ?>" alt="Фоновое изображение для статьи" />
                        </div>
                        <h4><?php the_title() ?></h4>
                        <?php the_excerpt(); ?>
                        <span>Подробнее</span>
                    </a>
                </li>
            <?php endforeach; ?>
            <?php wp_reset_postdata() ?>

        </ul>

        <!-- <a class="articles__button button button--outline" href="">Больше статей</a> -->
    </div>
</main>

<?php get_footer() ?>