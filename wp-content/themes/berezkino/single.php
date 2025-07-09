<?php
$parents = wp_get_post_categories(get_the_ID());
$closestParent = $parents[0];
$parentName = get_cat_name($closestParent);
$image_url = wp_get_attachment_url(carbon_get_the_post_meta('product_item_image'));
$product_variants = carbon_get_the_post_meta('product_item');
?>

<?php get_header() ?>

<main class="product">
    <div class="container">
        <?php if (function_exists('qt_custom_breadcrumbs')) qt_custom_breadcrumbs(); ?>

        <div class="product-item">
            <div class="product-item__content">
                <div class="product-item__header">
                    <p class="product-item__subtitle"><?= $parentName ?></p>

                    <h3 class="product-item__title"><?php the_title() ?></h3>

                    <?php if (carbon_get_the_post_meta('product_item_latin')): ?>
                        <p class="product-item__latin">
                            <?= carbon_get_the_post_meta('product_item_latin'); ?>
                        </p>
                    <?php endif; ?>
                </div>

                <div class="product-item__description">
                    <?= apply_filters('the_content', carbon_get_the_post_meta('product_item_desc')); ?>
                </div>

                <h4 class="product-item__variants-title">Доступные варианты:</h4>

                <form class="product-item__form form" action="" method="post">
                    <input id="itemType" type="hidden" name="<?= get_post()->post_name ?>">
                    <input id="itemUrl" type="hidden" name="itemUrl" value="<?php the_permalink() ?>">

                    <div class="form-group form-group--column">
                        <?php foreach ($product_variants as $key => $item): ?>
                            <div class="form-row">
                                <input class="form-row__checkbox" type="checkbox" name="plant" id="<?= $key ?>">
                                <div class="form-row__controls">
                                    <button
                                        class="form-group__btn form-group__btn--minus"
                                        type="button"
                                        onclick="this.nextElementSibling.stepDown(); this.nextElementSibling.onchange;">
                                        -
                                    </button>

                                    <input type="number" name="amount" id="<?= $key ?>" min="0" value="0" inputmode="numeric" />

                                    <button
                                        class="form-group__btn form-group__btn--minus"
                                        type="button"
                                        onclick="this.previousElementSibling.stepUp(); this.previousElementSibling.onchange;">
                                        +
                                    </button>
                                </div>
                                <label class="form-row__label" for="<?= $key ?>">
                                    <?php if ($item['product_item_age']): ?>
                                        <span><b>Возраст:</b> <?= $item['product_item_age'] ?>;</span>
                                    <?php endif; ?>

                                    <?php if ($item['product_item_height']): ?>
                                        <span><b>Высота:</b> <?= $item['product_item_height'] ?> см;</span>
                                    <?php endif; ?>

                                    <?php if ($item['product_item_size']): ?>
                                        <span><b>Объём:</b> <?= $item['product_item_size'] ?>;</span>
                                    <?php endif; ?>

                                    <?php if ($item['product_item_diameter']): ?>
                                        <span><b>Диаметр кома:</b> <?= $item['product_item_diameter'] ?> м;</span>
                                    <?php endif; ?>

                                    <?php if ($item['product_item_vaccination']): ?>
                                        <span><b>Прививка:</b> <?= $item['product_item_vaccination'] ?>;</span>
                                    <?php endif; ?>

                                    <?php if ($item['product_item_price']): ?>
                                        <span><b>Цена:</b> <?= $item['product_item_price'] ?> р/шт;</span>
                                    <?php endif; ?>
                                </label>
                                <input class="form-row__item-price" type="hidden" name="<?= $item['product_item_price'] ?>">
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <button id="addToOrder" class="product-item__button button button--fill" type="button">Добавить в заказ</button>
                </form>
            </div>

            <div class="product-item__image">
                <img src="<?= $image_url ?>" alt="Фото саженца" />
            </div>
        </div>
    </div>
</main>

<section class="legend">
    <div class="container">
        <details>
            <summary>Справка</summary>
            <ul>
                <li><span>RW</span> - растение с комом земли, ком упакован в мешковину и сетку;</li>
                <li><span>C10</span> - растение в горшке объёмом 10 л</li>
                <li><span>C7,5</span> - растение в горшке объёмом 7,5 л</li>
                <li><span>C5</span> - растение в горшке объёмом 5 л</li>
                <li><span>C3</span> - растение в горшке объёмом 3 л</li>
                <li><span>C2</span> - растение в горшке объёмом 2 л</li>
                <li>Возраст саженцев указан в количестве лет</li>
            </ul>

        </details>
    </div>
</section>

<section class="useful-links">
    <div class="container">
        <div class="useful-links__list">
            <a href="<?php bloginfo('url') ?>/price" class="useful-links__link">
                <svg class="svg-icon">
                    <use xlink:href="<?php bloginfo('template_url') ?>/assets/images/sprite.svg#icon-receipt"></use>
                </svg>
                <div class="useful-links__content">
                    <p>Посмотреть цены</p>
                    <span>Перейти</span>
                </div>
            </a>
            <a href="<?php bloginfo('url') ?>/delivery" class="useful-links__link">
                <svg class="svg-icon">
                    <use xlink:href="<?php bloginfo('template_url') ?>/assets/images/sprite.svg#icon-truck"></use>
                </svg>
                <div class="useful-links__content">
                    <p>Как заказать?</p>
                    <span>Перейти</span>
                </div>
            </a>

        </div>
    </div>
</section>

<section class="contacts">
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