<?php
/*
Template Name: Страница не найдена
*/
?>

<?php get_header() ?>

<main class="not-found">
    <div class="container">
        <h1 class="not-found__title" style="background-image: url(<?php bloginfo('template_url') ?>/assets/images/cover-bg-2.png);">
            404
        </h1>
        <h2 class="not-found__subtitle">Страница не найдена</h2>
        <p class="not-found__text">Страница, которую Вы запрашиваете, возможно, перемещена на другой адрес или никогда не существовала.</p>
        <div class="not-found__buttons">
            <a href="" class="button button--outline">На главную</a>
            <a href="" class="button button--outline">В каталог</a>
        </div>
    </div>
</main>

<?php get_footer() ?>
<!-- background-image: url('https://media.geeksforgeeks.org/wp-content/uploads/20231218224644/w.jpg') -->