<?php
/*
Template Name: Оформление заказа
*/
?>

<?php get_header() ?>

<main class="order">
    <div class="container">
        <div class="order__header page-header">
            <h2 class="order__header-title page-header__title">Ваш заказ</h2>
        </div>

        <form class="order__form form" action="" method="">
            <div id="orderItems" class="order__form-wrapper">
                <?php
                // Вывод саженцев из шаблона 
                ?>
            </div>

            <div class="order__submit">
                <p>Итого:</p>
                <div class="order__submit-wrapper">
                    <p class="order__submit-items"></p>
                    <p class="order__submit-summ"></p>
                </div>
                <button id="orderButton" class="order__button button button--fill" type="button" onclick="sendOrder.showModal()" disabled>Перейти к оформлению</button>
            </div>
        </form>

        <div class="order__footer">
            <p class="order__footer-text">
                <span>*</span> Информация о саженцах, добавленных в корзину, сохраняется только в том браузере и на том устройстве, на котором Вы начали формировать заказ.
            </p>
            <p class="order__footer-text">
                <span>*</span> Если Вы не отправили заявку сразу, то можете вернуться и продолжить формировать заказ позже.
            </p>
            <p class="order__footer-text">
                <span>*</span> Информация о заказе в корзине хранится в течении 7 дней.
            </p>
        </div>
    </div>
</main>

<dialog id="confirmDeleteItem" class="dialog" aria-label="Подтвердить удаление товара" aria-labelledby="deleteConfirmationHeader">
    <div id="deleteConfirmationHeader" class="dialog__header">
        <h2 class="dialog__title">Удаление товара</h2>
        <form class="dialog__close" method="dialog">
            <button class="dialog__close-btn" type="submit">
                <svg class="dialog__close-icon icon">
                    <use xlink:href="<?php bloginfo('template_url') ?>/assets/images/sprite.svg#icon-close"></use>
                </svg>
            </button>
        </form>
    </div>

    <p class="dialog__content">Удалить выбранный товар?</p>

    <form class="dialog__controls" method="dialog">
        <button id="confirmDeleteFromModal" type="submit" value="deleteThisItem" class="dialog__button button button--red">Удалить</button>
        <button id="cancelDeleteFromModal" type="submit" class="dialog__button button button--outline">Оставить</button>
    </form>
</dialog>

<dialog id="sendOrder" class="dialog dialog--order" aria-label="Отправить заявку" aria-labelledby="sendOrderConfirmationHeader">
    <div id="sendOrderConfirmationHeader" class="dialog__header">
        <h2 class="dialog__title">Оформление</h2>
        <form class="dialog__close" method="dialog">
            <button class="dialog__close-btn" type="submit">
                <svg class="dialog__close-icon icon">
                    <use xlink:href="<?php bloginfo('template_url') ?>/assets/images/sprite.svg#icon-close"></use>
                </svg>
            </button>
        </form>
    </div>

    <p class="dialog__note">Оставьте заявку и мы свяжемся с Вами в ближайшее время</p>

    <form action="" method="post" id="orderRequest" class="form form--column">
        <div class="form-group">
            <div class="form-row">
                <label for="phone" class="form__label">
                    Контактный телефон:
                </label>
                <input type="tel" name="phone" id="phone" autofocus required>
            </div>

            <div class="form-row">
                <label for="name" class="form__label">
                    Имя:
                </label>
                <input type="text" name="name" id="name" minlength="2" required>
            </div>
        </div>

        <div class="form-group form-group--column">
            <label for="email" class="form__label">
                Email:
            </label>
            <input type="email" name="email" id="email" required>
        </div>

        <div class="form-group form-group--column">
            <label for="comment" class="form__label">
                Комментарий к заказу:
            </label>
            <textarea name="comment" id="comment"></textarea>
        </div>

        <hr class="form-divider">

        <div class="form-group form-group--column">
            <p class="form__label">Итого:</p>
            <div class="form__total">
                <p id="formTotalItems" class="form__total-value"></p>
                <input type="hidden" name="totalItemsAmount" id="totalItemsAmount" value="" readonly>
                <p id="formTotalSumm" class="form__total-value"></p>
                <input type="hidden" name="totalItemsSumm" id="totalItemsSumm" value="" readonly>
            </div>
        </div>

        <div class="form-row">
            <input type="checkbox" name="policy" id="policy" class="form-row__checkbox" required>
            <label for="policy" class="form-row__label">
                Согласен с
                <a href="<?= get_privacy_policy_url(); ?>" target="_blank">
                    политикой кон&shy;фи&shy;ден&shy;циаль&shy;ности</a>
                и даю согласие на обработку персональных данных
            </label>
        </div>

        <input type="hidden" name="checkField" class="checkField">

        <input type="hidden" name="orderContent" id="orderContent" value="" readonly>

        <button type="submit" class="form__button button button--fill" id="sendOrderButton">Оформить</button>
    </form>
</dialog>

<dialog id="successMessage" class="dialog" aria-label="Заявка успешно отправлена" aria-labelledby="successMessageHeader">
    <div id="successMessageHeader" class="dialog__header">
        <h2 class="dialog__title">Оформление</h2>
        <form class="dialog__close" method="dialog">
            <button class="dialog__close-btn" type="submit">
                <svg class="dialog__close-icon icon">
                    <use xlink:href="<?php bloginfo('template_url') ?>/assets/images/sprite.svg#icon-close"></use>
                </svg>
            </button>
        </form>
    </div>

    <h3>Спасибо!</h3>

    <p class="dialog__content">
        Заказ успешно доставлен до менеджера. <br>
        Для Вашего удобства, мы отправили копию заказа Вам на электронную почту.
    </p>

    <form class="dialog__controls" method="dialog">
        <button type="submit" class="dialog__button button button--fill">Завершить</button>
    </form>
</dialog>

<dialog id="errorMessage" class="dialog" aria-label="Ошибка при отправке" aria-labelledby="errorMessageHeader">
    <div id="errorMessageHeader" class="dialog__header">
        <h2 class="dialog__title">Оформление</h2>
        <form class="dialog__close" method="dialog">
            <button class="dialog__close-btn" type="submit">
                <svg class="dialog__close-icon icon">
                    <use xlink:href="<?php bloginfo('template_url') ?>/assets/images/sprite.svg#icon-close"></use>
                </svg>
            </button>
        </form>
    </div>

    <p class="dialog__content">При отправке заявки произошла непредвиденная ошибка. <br> Попробуйте повторить отправку через пару минут или свяжитесь с нами с помощью контактов, указанных внизу сайта.</p>

    <form class="dialog__controls" method="dialog">
        <button type="submit" class="dialog__button button button--red">Повторить отправку</button>
    </form>
</dialog>



<?php get_footer() ?>