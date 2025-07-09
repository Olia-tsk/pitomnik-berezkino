<?php
$article_id = get_the_ID();
$my_articles = getArticles($article_id);
global $post;

?>

<?php get_header() ?>

<main class="article">
    <div class="container">
        <img class="article__image" src="<?= get_the_post_thumbnail_url() ?>" alt="Обложка статьи" />


        <h2 class="article__title"><?= get_the_title() ?></h2>

        <div class="article__content">
            <?= get_the_content() ?>
        </div>

        <?php if ($my_articles): ?>
            <div class="article__others">
                <h3 class="article__others-title">Другие статьи</h3>

                <div id="articlesSlider" class="articles__slider splide" role="group" aria-label="Галерея статей">
                    <div class="splide__arrows">
                        <button class="splide__arrow splide__arrow--prev">
                            <svg class="svg-icon">
                                <use xlink:href="<?php bloginfo('template_url') ?>/assets/images/sprite.svg#icon-next"></use>
                            </svg>
                        </button>
                        <button class="splide__arrow splide__arrow--next">
                            <svg class="svg-icon">
                                <use xlink:href="<?php bloginfo('template_url') ?>/assets/images/sprite.svg#icon-next"></use>
                            </svg>
                        </button>
                    </div>
                    <div class="articles__slider-track splide__track">
                        <ul class="articles__slider-list articles-list splide__list">

                            <?php foreach ($my_articles as $post): ?>
                                <?php setup_postdata($post) ?>
                                <li class="articles__slider-slide articles-list__item splide__slide">
                                    <a class="articles__slider-slide-link articles-list__link" href="<?php the_permalink() ?>">
                                        <div class="articles__slider-slide-img articles-list__img">
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
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</main>

<?php get_footer() ?>