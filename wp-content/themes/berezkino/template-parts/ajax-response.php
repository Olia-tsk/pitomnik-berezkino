<?php if (count($order_items) == 0): ?>
    <p>Корзина пуста</p>
<?php else: ?>
    <?php foreach ($order_items as $item): ?>
        <div class="order__form-row form-row">
            <img src="<?= $item->imgUrl ?>" alt="фото саженца">
            <div class="form-row__content">
                <a class="form-row__content-title" href="<?= $item->itemUrl ?>"><?= $item->name ?></a>
                <div class="form-row__amount">
                    <button
                        class="form-group__btn form-group__btn--minus"
                        type="button"
                        onclick="this.nextElementSibling.stepDown(); this.nextElementSibling.onchange;">
                        -
                    </button>

                    <input type="number" name="amount" min="0" value="<?= $item->amount ?>" inputmode="numeric" />

                    <button
                        class="form-group__btn form-group__btn--minus"
                        type="button"
                        onclick="this.previousElementSibling.stepUp(); this.previousElementSibling.onchange;">
                        +
                    </button>
                </div>
                <p class="form-row__content-desc"><?= $item->data ?></p>
            </div>
            <div class="form-row__right">
                <button type="button" class="form-row__right-btn delete-this-item" onclick="confirmDeleteItem.showModal()">
                    <svg class="svg-icon">
                        <use xlink:href="<?php bloginfo('template_url') ?>/assets/images/sprite.svg#icon-trash"></use>
                    </svg>
                    <input type="hidden" name="itemKey" value="<?= $item->key ?>">
                </button>
                <p id="pricePerItem" class="form-row__right-total"></p>
            </div>
            <input type="hidden" name="pricePerItem" value="<?= $item->pricePerItem ?>">
        </div>
    <?php endforeach ?>
<?php endif; ?>