<?php global $categories; ?>

<!DOCTYPE html>
<html <?php language_attributes() ?>>

<head>
    <meta charset="<?php bloginfo('charset') ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" type="image/png" href="<?php bloginfo('template_url') ?>/assets/favicon/favicon-96x96.png" sizes="96x96" />
    <link rel="icon" type="image/svg+xml" href="<?php bloginfo('template_url') ?>/assets/favicon/favicon.svg" />
    <link rel="shortcut icon" href="<?php bloginfo('template_url') ?>/assets/favicon/favicon.ico" />
    <link rel="apple-touch-icon" sizes="180x180" href="<?php bloginfo('template_url') ?>/assets/favicon/apple-touch-icon.png" />
    <meta name="apple-mobile-web-app-title" content="Берёзкино" />
    <link rel="manifest" href="<?php bloginfo('template_url') ?>/assets/favicon/site.webmanifest" />
    <?php wp_head() ?>
</head>

<body>
    <header class="header">
        <div class="header-top">
            <div class="container">
                <div class="header-top__contacts">
                    <a href="https://go.2gis.com/roUHm" target="_blank">
                        <svg class="svg-icon">
                            <use xlink:href="<?php bloginfo('template_url') ?>/assets/images/sprite.svg#icon-map"></use>
                        </svg>
                        Деревня Березкино, 1 ст1
                    </a>
                    <p>
                        <svg class="svg-icon">
                            <use xlink:href="<?php bloginfo('template_url') ?>/assets/images/sprite.svg#icon-clock"></use>
                        </svg>
                        9:00 до 19:00
                    </p>
                    <a href="tel:+79539234214">
                        <svg class="svg-icon">
                            <use xlink:href="<?php bloginfo('template_url') ?>/assets/images/sprite.svg#icon-call"></use>
                        </svg>
                        8-953-923-42-14
                    </a>
                </div>

                <p class="header__announce header-top__announce">Старт продаж с 1 мая 2025</p>

                <div class="header-top__buttons">
                    <a class="header-top__button social-button social-button--green" href="https://wa.me/79539234214">
                        <svg class="svg-icon svg-icon--wa">
                            <use xlink:href="<?php bloginfo('template_url') ?>/assets/images/sprite.svg#icon-wa"></use>
                        </svg>
                        Whats App
                    </a>
                    <a class="header-top__button social-button social-button--blue" href="https://t.me/+79539234214">
                        <svg class="svg-icon svg-icon--tg">
                            <use xlink:href="<?php bloginfo('template_url') ?>/assets/images/sprite.svg#icon-tg"></use>
                        </svg>
                        Telegram
                    </a>
                </div>
            </div>
        </div>

        <div class="header-main">
            <div class="container">
                <a class="header-main__logo-link logo-link" href="/">
                    <img class="header-main__logo logo" src="<?php bloginfo('template_url') ?>/assets/images/logo.svg" alt="Logo: Питомник Берёзкино" />
                </a>

                <ul class="header-main__menu">
                    <li class="header-main__menu-item">
                        <a class="header-main__menu-link" href="/">Главная</a>
                    </li>
                    <li class="header-main__menu-item">
                        <a class="header-main__menu-link" href="<?php bloginfo('url') ?>/about">О Питомнике</a>
                    </li>
                    <li class="header-main__menu-item">
                        <a class="header-main__menu-link" href="<?php bloginfo('url') ?>/categories">
                            Каталог
                            <svg class="svg-icon">
                                <use xlink:href="<?php bloginfo('template_url') ?>/assets/images/sprite.svg#icon-dropdown"></use>
                            </svg>
                        </a>
                        <ul>
                            <?php foreach ($categories as $category): ?>
                                <li><a href="<?php bloginfo('url') ?>/categories/<?= $category->slug ?>"><?= $category->name ?></a></li>
                            <?php endforeach; ?>
                        </ul>
                    </li>
                    <li class="header-main__menu-item">
                        <a class="header-main__menu-link" href="<?php bloginfo('url') ?>/price">Цены</a>
                    </li>
                    <li class="header-main__menu-item">
                        <a class="header-main__menu-link" href="<?php bloginfo('url') ?>/articles">Статьи</a>
                    </li>
                    <li class="header-main__menu-item">
                        <a class="header-main__menu-link" href="<?php bloginfo('url') ?>/delivery">Как заказать</a>
                    </li>
                </ul>

                <p class="header__announce header-main__announce">Старт продаж с 1 мая 2025</p>

                <div class="header-main__buttons">
                    <a class="header-main__cart" href="<?php bloginfo('url') ?>/order">
                        <svg class="svg-icon">
                            <use xlink:href="<?php bloginfo('template_url') ?>/assets/images/sprite.svg#icon-shopping-cart"></use>
                        </svg>
                        <span class="header-main__cart-amount"></span>
                        Заказ
                    </a>

                    <div id="burgerBtn" class="header-main__burger burger-menu">
                        <span class="burger-menu__item burger-menu__item--top"></span>
                        <span class="burger-menu__item burger-menu__item--middle"></span>
                        <span class="burger-menu__item burger-menu__item--bottom"></span>
                    </div>
                </div>
            </div>
        </div>

        <div id="mobileMenu" class="header-main__mobile mobile-menu">
            <p class="header__announce mobile-menu__announce">Старт продаж с 1 мая 2025</p>

            <ul class="mobile-menu__list">
                <li><a class="header-main__menu-link" href="/">Главная</a></li>
                <li><a class="header-main__menu-link" href="<?php bloginfo('url') ?>/about">О Питомнике</a></li>
                <li><a class="header-main__menu-link" href="<?php bloginfo('url') ?>/categories"> Каталог </a></li>
                <li><a class="header-main__menu-link" href="<?php bloginfo('url') ?>/price">Цены</a></li>
                <li><a class="header-main__menu-link" href="<?php bloginfo('url') ?>/articles">Статьи</a></li>
                <li><a class="header-main__menu-link" href="<?php bloginfo('url') ?>/delivery">Как заказать</a></li>
            </ul>

            <div class="mobile-menu__contacts">
                <a href="https://go.2gis.com/roUHm" target="_blank">
                    <svg class="svg-icon">
                        <use xlink:href="<?php bloginfo('template_url') ?>/assets/images/sprite.svg#icon-map"></use>
                    </svg>
                    Деревня Березкино, 1 ст1
                </a>
                <p>
                    <svg class="svg-icon">
                        <use xlink:href="<?php bloginfo('template_url') ?>/assets/images/sprite.svg#icon-clock"></use>
                    </svg>
                    9:00 до 19:00
                </p>
                <a href="tel:+79539234214">
                    <svg class="svg-icon">
                        <use xlink:href="<?php bloginfo('template_url') ?>/assets/images/sprite.svg#icon-call"></use>
                    </svg>
                    8-953-923-42-14
                </a>
            </div>

            <div class="mobile-menu__buttons">
                <a class="header-top__button social-button social-button--green" href="https://wa.me/79539234214">
                    <svg class="svg-icon svg-icon--wa">
                        <use xlink:href="<?php bloginfo('template_url') ?>/assets/images/sprite.svg#icon-wa"></use>
                    </svg>
                    Whats App
                </a>
                <a class="header-top__button social-button social-button--blue" href="https://t.me/+79539234214">
                    <svg class="svg-icon svg-icon--tg">
                        <use xlink:href="<?php bloginfo('template_url') ?>/assets/images/sprite.svg#icon-tg"></use>
                    </svg>
                    Telegram
                </a>
            </div>
        </div>
    </header>