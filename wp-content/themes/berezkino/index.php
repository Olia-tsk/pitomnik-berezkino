<?php

$my_articles = getArticles();
global $post;

?>

<?php get_header() ?>

<section class="cover">
    <div class="container">
        <div class="cover__wrapper">
            <img class="cover__image" src="<?php bloginfo('template_url') ?>/assets/images/cover-bg-1.png" alt="Фото из питомника" />
            <img class="cover__image" src="<?php bloginfo('template_url') ?>/assets/images/cover-bg-2.png" alt="Фото из питомника" />
            <div class="cover__content">
                <p class="cover__subtitle">Питомник Растений</p>
                <h1 class="cover__title">Берёзкино</h1>
                <a class="cover__button button button--fill" href="#contactsBlock">Связаться</a>
            </div>
        </div>
    </div>
</section>

<section class="advantages">
    <div class="container">
        <div class="advantages__header section-header">
            <h2 class="advantages__header-title section-header__title">Преимущества</h2>
            <p class="advantages__header-subtitle section-header__subtitle">почему выбирают нас</p>
        </div>
        <div class="advantages__wrapper">
            <img class="advantages__bg" src="<?php bloginfo('template_url') ?>/assets/images/advantages-bg.png" alt="" />
            <div class="advantages__item">
                <span>01</span>
                <p>Саженцы только собственного производства, выращенные в суровых климатических условиях Томской области</p>
            </div>
            <div class="advantages__item">
                <span>02</span>
                <p>Питомник находится рядом с городом Томском</p>
            </div>
            <div class="advantages__item">
                <span>03</span>
                <p>
                    Растения выращенные в местном питомнике, всегда более устойчивы к существующим климатическим условиям и гарантируют высокие
                    урожаи по сравнению с растениями привезенными из другой климатической зоны.
                </p>
            </div>
            <div class="advantages__item">
                <span>04</span>
                <p>Широкий ассортимент сортов и видов дает возможность приобрести плодовые и декоративные культуры в одном месте</p>
            </div>
            <div class="advantages__item">
                <span>05</span>
                <p>
                    Саженцы с закрытой корневой системой дают возможность посадки в течение всего вегетационного сезона и гарантируют успешную
                    приживаемость.
                </p>
            </div>
            <div class="advantages__item">
                <span>06</span>
                <p>В питомнике применяются современные технологии размножения и выращивания</p>
            </div>
        </div>
    </div>
</section>

<section class="categories">
    <div class="container">
        <div class="categories__header section-header">
            <h2 class="categories__header-title section-header__title">Категории растений</h2>
            <p class="categories__header-subtitle section-header__subtitle">для вашего дома и сада</p>
        </div>
        <div class="categories__wrapper">
            <a href="<?= get_category_link(2) ?>" class="categories__item categories__item--fruit-berry-crops">
                <p>
                    Плодово-ягодные <br />
                    культуры
                </p>
                <img src="<?php bloginfo('template_url') ?>/assets/images/catalog-fruit-berry-crops.png" alt="" />
            </a>
            <a href="<?= get_category_link(29) ?>" class="categories__item categories__item--decorative-shrubs">
                <p>
                    Декоративные <br />
                    Кустарники
                </p>
                <img src="<?php bloginfo('template_url') ?>/assets/images/catalog-decorative-shrubs.png" alt="" />
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
</section>

<section class="reviews">
    <div class="container">
        <div class="reviews__header section-header">
            <h2 class="reviews__header-title section-header__title">Отзывы</h2>
            <p class="reviews__header-subtitle section-header__subtitle">наших покупателей</p>
        </div>

        <div id="reviewsSlider" class="reviews__slider splide" role="group" aria-label="Галерея отзывов">
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
            <div class="reviews__slider-track splide__track">
                <ul class="reviews__slider-list splide__list">
                    <?php $reviews = getReviews() ?>
                    <?php foreach ($reviews as $review): ?>
                        <li class="reviews__slider-slide splide__slide" style="background-image: url(<?php bloginfo('template_url') ?>/assets/images/reviews-item-bg.svg);">
                            <p>“<?php echo ($review->review_text) ?>”</p>
                            <span><?= ($review->review_name) ?></span>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>

        <button id="addReviewButton" class="reviews__button button button--outline" type="button" onclick="addReview.showModal()">
            Оставить отзыв
        </button>
    </div>

    <dialog id="addReview" class="dialog dialog" aria-label="Отправить отзыв" aria-labelledby="sendReviewHeader" closedby="any">
        <div id="sendReviewHeader" class="dialog__header">
            <h2 class="dialog__title">Оставить отзыв</h2>
            <form class="dialog__close" method="dialog">
                <button class="dialog__close-btn" type="submit">
                    <svg class="dialog__close-icon icon">
                        <use xlink:href="<?php bloginfo('template_url') ?>/assets/images/sprite.svg#icon-close"></use>
                    </svg>
                </button>
            </form>
        </div>

        <form action="" method="post" id="reviewForm" class="form form--column">
            <div class="form-group form-group--column">
                <label for="name" class="form__label">
                    Имя:
                </label>
                <input type="text" name="name" id="name" minlength="2" required>
            </div>

            <div class="form-group form-group--column">
                <label for="review" class="form__label">
                    Текст отзыва:
                </label>
                <textarea name="review" id="review" minlength="2" required></textarea>
            </div>

            <input type="hidden" name="checkField" class="checkField">

            <button type="submit" class="form__button button button--fill" id="sendReviewButton">Отправить</button>
        </form>
    </dialog>

    <dialog id="successMessage" class="dialog" aria-label="Отзыв успешно отправлен" aria-labelledby="successMessageHeader" closedby="any">
        <div id="successMessageHeader" class="dialog__header">
            <h2 class="dialog__title dialog__title--success">Отзыв успешно отправлен</h2>
            <form class="dialog__close" method="dialog">
                <button class="dialog__close-btn" type="submit">
                    <svg class="dialog__close-icon icon">
                        <use xlink:href="<?php bloginfo('template_url') ?>/assets/images/sprite.svg#icon-close"></use>
                    </svg>
                </button>
            </form>
        </div>

        <p class="dialog__content">
            Благодарим Вас за обратную связь! <br> После прохождения модерации отзыв будет опубликован на нашем сайте.
        </p>

        <form class="dialog__controls" method="dialog">
            <button type="submit" class="dialog__button button button--fill">Закрыть</button>
        </form>
    </dialog>

    <dialog id="errorMessage" class="dialog" aria-label="Ошибка при отправке" aria-labelledby="errorMessageHeader" closedby="any">
        <div id="errorMessageHeader" class="dialog__header">
            <h2 class="dialog__title dialog__title--error">Что-то пошло не так...</h2>
            <form class="dialog__close" method="dialog">
                <button class="dialog__close-btn" type="submit">
                    <svg class="dialog__close-icon icon">
                        <use xlink:href="<?php bloginfo('template_url') ?>/assets/images/sprite.svg#icon-close"></use>
                    </svg>
                </button>
            </form>
        </div>

        <p class="dialog__content">
            При отправке отзыва произошла непредвиденная ошибка. <br> Попробуйте повторить отправку через пару минут или свяжитесь с нами с помощью контактов, указанных внизу сайта.
        </p>

        <form class="dialog__controls" method="dialog">
            <button type="submit" class="dialog__button button button--red">Закрыть</button>
        </form>
    </dialog>
</section>

<section class="about">
    <div class="container">
        <div class="about__header section-header">
            <h2 class="about__header-title section-header__title">О питомнике</h2>
            <p class="about__header-subtitle section-header__subtitle">наша история</p>
        </div>
        <div class="about__wrapper">
            <div class="about__content">
                <p class="about__text">
                    Питомник растений «Берёзкино» находится в Томской области в 20 км от г. Томска, рядом с деревней Берёзкино Зоркальцевского
                    сельского поселения.
                </p>
                <p class="about__text">
                    Мы являемся производителями саженцев плодовых и декоративных культур и реализуем саженцы только собственного производства,
                    выращенные в Томском районе...
                </p>
                <a class="about__button button button--outline" href="<?php bloginfo('url') ?>/about">Читать подробнее</a>
            </div>
            <img class="about__image" src="<?php bloginfo('template_url') ?>/assets/images/about-img.png" alt="Фото из питомника" />
        </div>
    </div>
</section>

<section class="articles">
    <div class="container">
        <div class="articles__header section-header">
            <h2 class="articles__header-title section-header__title">Полезная Информация</h2>
        </div>

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

        <a class="articles__button button button--outline" href="<?php bloginfo('url') ?>/articles">Посмотреть все</a>
    </div>
</section>

<section id="contactsBlock" class="contacts">
    <div class="container">
        <div class="contacts__wrapper">
            <div class="contacts__content">
                <h3 class="contacts__title">Контакты</h3>

                <div class="contacts__data">
                    <div class="contacts__data-wrapper">
                        <span>Адрес:</span>
                        <a href="https://go.2gis.com/roUHm" target="_blank">
                            1 км до д. Березкино, <br />
                            адрес в 2GIS - Деревня Березкино, 1 ст1
                        </a>
                    </div>
                    <div class="contacts__data-wrapper">
                        <span>Время работы:</span>
                        <p>Питомник с 9:00 до 19:00</p>
                    </div>
                </div>

                <div class="contacts__data">
                    <a href="tel:+79539234214">8-953-923-42-14</a>
                    <a href="mailto:pitomnik-berezkino70@yandex.ru">pitomnik-berezkino70@yandex.ru</a>
                </div>
            </div>

            <div class="contacts__map">
                <iframe id="map_538792126" frameborder="0" width="100%" height="100%" sandbox="allow-modals allow-forms allow-scripts allow-same-origin allow-popups allow-top-navigation-by-user-activation"></iframe>
                <script type="text/javascript">
                    (function(e, t) {
                        var r = document.getElementById(e);
                        r.contentWindow.document.open(), r.contentWindow.document.write(atob(t)), r.contentWindow.document.close()
                    })("map_538792126", "PGJvZHk+PHN0eWxlPgogICAgICAgIGh0bWwsIGJvZHkgewogICAgICAgICAgICBtYXJnaW46IDA7CiAgICAgICAgICAgIHBhZGRpbmc6IDA7CiAgICAgICAgfQogICAgICAgIGh0bWwsIGJvZHksICNtYXAgewogICAgICAgICAgICB3aWR0aDogMTAwJTsKICAgICAgICAgICAgaGVpZ2h0OiAxMDAlOwogICAgICAgIH0KICAgICAgICAuYnVsbGV0LW1hcmtlciB7CiAgICAgICAgICAgIHdpZHRoOiAyMHB4OwogICAgICAgICAgICBoZWlnaHQ6IDIwcHg7CiAgICAgICAgICAgIGJveC1zaXppbmc6IGJvcmRlci1ib3g7CiAgICAgICAgICAgIGJhY2tncm91bmQtY29sb3I6ICNmZmY7CiAgICAgICAgICAgIGJveC1zaGFkb3c6IDAgMXB4IDNweCAwIHJnYmEoMCwgMCwgMCwgMC4yKTsKICAgICAgICAgICAgYm9yZGVyOiA0cHggc29saWQgIzAyODFmMjsKICAgICAgICAgICAgYm9yZGVyLXJhZGl1czogNTAlOwogICAgICAgIH0KICAgICAgICAucGVybWFuZW50LXRvb2x0aXAgewogICAgICAgICAgICBiYWNrZ3JvdW5kOiBub25lOwogICAgICAgICAgICBib3gtc2hhZG93OiBub25lOwogICAgICAgICAgICBib3JkZXI6IG5vbmU7CiAgICAgICAgICAgIHBhZGRpbmc6IDZweCAxMnB4OwogICAgICAgICAgICBjb2xvcjogIzI2MjYyNjsKICAgICAgICB9CiAgICAgICAgLnBlcm1hbmVudC10b29sdGlwOmJlZm9yZSB7CiAgICAgICAgICAgIGRpc3BsYXk6IG5vbmU7CiAgICAgICAgfQogICAgICAgIC5kZy1wb3B1cF9oaWRkZW5fdHJ1ZSB7CiAgICAgICAgICAgIGRpc3BsYXk6IGJsb2NrOwogICAgICAgIH0KICAgICAgICAubGVhZmxldC1jb250YWluZXIgLmxlYWZsZXQtcG9wdXAgLmxlYWZsZXQtcG9wdXAtY2xvc2UtYnV0dG9uIHsKICAgICAgICAgICAgdG9wOiAwOwogICAgICAgICAgICByaWdodDogMDsKICAgICAgICAgICAgd2lkdGg6IDIwcHg7CiAgICAgICAgICAgIGhlaWdodDogMjBweDsKICAgICAgICAgICAgZm9udC1zaXplOiAyMHB4OwogICAgICAgICAgICBsaW5lLWhlaWdodDogMTsKICAgICAgICB9CiAgICA8L3N0eWxlPjxkaXYgaWQ9Im1hcCI+PC9kaXY+PHNjcmlwdCB0eXBlPSJ0ZXh0L2phdmFzY3JpcHQiIHNyYz0iaHR0cHM6Ly9tYXBzLmFwaS4yZ2lzLnJ1LzIuMC9sb2FkZXIuanM/cGtnPWZ1bGwmYW1wO3NraW49bGlnaHQiPjwvc2NyaXB0PjxzY3JpcHQ+KGZ1bmN0aW9uKGUpe3ZhciB0PUpTT04ucGFyc2UoZSkscj10Lm9yZGVyZWRHZW9tZXRyaWVzLG49dC5tYXBQb3NpdGlvbixhPXQuaXNXaGVlbFpvb21FbmFibGVkO2Z1bmN0aW9uIG8oZSl7cmV0dXJuIGRlY29kZVVSSUNvbXBvbmVudChhdG9iKGUpLnNwbGl0KCIiKS5tYXAoZnVuY3Rpb24oZSl7cmV0dXJuIiUiKygiMDAiK2UuY2hhckNvZGVBdCgwKS50b1N0cmluZygxNikpLnNsaWNlKC0yKX0pLmpvaW4oIiIpKX1ERy50aGVuKGZ1bmN0aW9uKCl7dmFyIGU9REcubWFwKCJtYXAiLHtjZW50ZXI6W24ubGF0LG4ubG9uXSx6b29tOm4uem9vbSxzY3JvbGxXaGVlbFpvb206YSx6b29tQ29udHJvbDohYX0pO0RHLmdlb0pTT04ocix7c3R5bGU6ZnVuY3Rpb24oZSl7dmFyIHQscixuLGEsbztyZXR1cm57ZmlsbENvbG9yOm51bGw9PT0odD1lKXx8dm9pZCAwPT09dD92b2lkIDA6dC5wcm9wZXJ0aWVzLmZpbGxDb2xvcixmaWxsT3BhY2l0eTpudWxsPT09KHI9ZSl8fHZvaWQgMD09PXI/dm9pZCAwOnIucHJvcGVydGllcy5maWxsT3BhY2l0eSxjb2xvcjpudWxsPT09KG49ZSl8fHZvaWQgMD09PW4/dm9pZCAwOm4ucHJvcGVydGllcy5zdHJva2VDb2xvcix3ZWlnaHQ6bnVsbD09PShhPWUpfHx2b2lkIDA9PT1hP3ZvaWQgMDphLnByb3BlcnRpZXMuc3Ryb2tlV2lkdGgsb3BhY2l0eTpudWxsPT09KG89ZSl8fHZvaWQgMD09PW8/dm9pZCAwOm8ucHJvcGVydGllcy5zdHJva2VPcGFjaXR5fX0scG9pbnRUb0xheWVyOmZ1bmN0aW9uKGUsdCl7cmV0dXJuInJhZGl1cyJpbiBlLnByb3BlcnRpZXM/REcuY2lyY2xlKHQsZS5wcm9wZXJ0aWVzLnJhZGl1cyk6REcubWFya2VyKHQse2ljb246ZnVuY3Rpb24oZSl7cmV0dXJuIERHLmRpdkljb24oe2h0bWw6IjxkaXYgY2xhc3M9J2J1bGxldC1tYXJrZXInIHN0eWxlPSdib3JkZXItY29sb3I6ICIrZSsiOyc+PC9kaXY+IixjbGFzc05hbWU6Im92ZXJyaWRlLWRlZmF1bHQiLGljb25TaXplOlsyMCwyMF0saWNvbkFuY2hvcjpbMTAsMTBdfSl9KGUucHJvcGVydGllcy5jb2xvcil9KX0sb25FYWNoRmVhdHVyZTpmdW5jdGlvbihlLHQpe2UucHJvcGVydGllcy5kZXNjcmlwdGlvbiYmdC5iaW5kUG9wdXAobyhlLnByb3BlcnRpZXMuZGVzY3JpcHRpb24pLHtjbG9zZUJ1dHRvbjohMCxjbG9zZU9uRXNjYXBlS2V5OiEwfSksZS5wcm9wZXJ0aWVzLnRpdGxlJiZ0LmJpbmRUb29sdGlwKG8oZS5wcm9wZXJ0aWVzLnRpdGxlKSx7cGVybWFuZW50OiEwLG9wYWNpdHk6MSxjbGFzc05hbWU6InBlcm1hbmVudC10b29sdGlwIn0pfX0pLmFkZFRvKGUpfSl9KSgneyJvcmRlcmVkR2VvbWV0cmllcyI6W3sidHlwZSI6IkZlYXR1cmUiLCJwcm9wZXJ0aWVzIjp7ImNvbG9yIjoiIzE5NzYwNiIsInRpdGxlIjoiMEpIUXRkR0EwWkhRdDlDNjBMalF2ZEMrTENEUXY5QzQwWUxRdnRDODBMM1F1TkM2IiwiZGVzY3JpcHRpb24iOiIiLCJ6SW5kZXgiOjEwMDAwMDAwMDB9LCJnZW9tZXRyeSI6eyJ0eXBlIjoiUG9pbnQiLCJjb29yZGluYXRlcyI6Wzg0LjY1MjMyOSw1Ni40OTI5NThdfSwiaWQiOjgzMX1dLCJtYXBQb3NpdGlvbiI6eyJsYXQiOjU2LjQ5MjgyNzE0NTAyNjY2LCJsb24iOjg0LjY0NzU5ODI2NjYwMTU4LCJ6b29tIjoxM30sImlzV2hlZWxab29tRW5hYmxlZCI6dHJ1ZX0nKTwvc2NyaXB0PjxzY3JpcHQgYXN5bmM9IiIgc3JjPSJodHRwczovL3d3dy5nb29nbGV0YWdtYW5hZ2VyLmNvbS9ndGFnL2pzP2lkPUctVDg2S01EMDNDNyI+PC9zY3JpcHQ+PHNjcmlwdCBpZD0iZ29vZ2xlLWFuYWx5dGljcyI+CiAgICAgIHdpbmRvdy5kYXRhTGF5ZXIgPSB3aW5kb3cuZGF0YUxheWVyIHx8IFtdOwogICAgICBmdW5jdGlvbiBndGFnKCl7ZGF0YUxheWVyLnB1c2goYXJndW1lbnRzKTt9CiAgICAgIGd0YWcoJ2pzJywgbmV3IERhdGUoKSk7CiAgICAgIGd0YWcoJ2NvbmZpZycsICdHLVQ4NktNRDAzQzcnLCB7ImNvb2tpZV9mbGFncyI6IlNhbWVTaXRlPU5vbmU7IFNlY3VyZTsgUGFydGl0aW9uZWQiLCJjb29raWVfdXBkYXRlIjpmYWxzZX0pOwogICAgICB0cnVlICYmIGd0YWcoJ2V2ZW50JywgJ2Zyb21faWZyYW1lJyk7CiAgICA8L3NjcmlwdD48L2JvZHk+")
                </script>

            </div>
        </div>
    </div>
</section>

<?php get_footer() ?>