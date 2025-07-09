<footer class="footer">
    <div class="container">
        <div class="footer-main">
            <a class="footer-main__logo-link logo-link" href="/">
                <img class="footer-main__logo logo" src="<?php bloginfo('template_url') ?>/assets/images/logo.svg" alt="Logo: Питомник Берёзкино" />
            </a>

            <div class="footer-main__wrapper">
                <div class="footer-main__column">
                    <a href="<?php bloginfo('url') ?>/price">
                        Скачать прайс
                    </a>
                </div>

                <div class="footer-main__column">
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
                </div>

                <div class="footer-main__column">
                    <a href="mailto:pitomnik-berezkino70@yandex.ru">
                        <svg class="svg-icon">
                            <use xlink:href="<?php bloginfo('template_url') ?>/assets/images/sprite.svg#icon-mail"></use>
                        </svg>
                        pitomnik-berezkino70@yandex.ru
                    </a>
                    <a href="tel:+79539234214">
                        <svg class="svg-icon">
                            <use xlink:href="<?php bloginfo('template_url') ?>/assets/images/sprite.svg#icon-call"></use>
                        </svg>
                        8-953-923-42-14
                    </a>
                    <a href="tel:+79039145572">
                        <svg class="svg-icon">
                            <use xlink:href="<?php bloginfo('template_url') ?>/assets/images/sprite.svg#icon-call"></use>
                        </svg>
                        8-903-914-55-72
                    </a>
                </div>
            </div>
        </div>

        <div class="footer-bottom">
            <p class="footer-bottom__copyright">© <?= date("Y") ?> Березкино</p>
            <div class="footer-bottom__links">
                <a href="<?php bloginfo('template_url') ?>/privacy-policy/">Политика конфиденциальности</a>
            </div>
        </div>
    </div>
</footer>

<?php wp_footer() ?>

</body>

</html>