document.addEventListener("DOMContentLoaded", function () {
  Splide.defaults = {
    type: "loop",
    padding: { left: 10, right: 10 },
  };
  if (document.getElementById("reviewsSlider")) {
    var reviewsSlider = new Splide("#reviewsSlider", {
      pagination: false,
      perPage: 3,
      gap: "24px",
      breakpoints: {
        1250: {
          perPage: 2,
        },
        876: {
          perPage: 1,
        },
      },
    });
    reviewsSlider.mount();
  }

  if (document.getElementById("articlesSlider")) {
    var articlesSlider = new Splide("#articlesSlider", {
      pagination: false,
      perPage: 4,
      gap: "16px",
      breakpoints: {
        1690: {
          perPage: 3,
        },
        1250: {
          perPage: 2,
        },
        735: {
          perPage: 1,
        },
      },
    });
    articlesSlider.mount();
  }
});

const addToCartToast = Toastify({
  text: "Добавлено в корзину",
  duration: 3000,
  close: true,
  gravity: "bottom",
  position: "left",
  stopOnFocus: true,
  style: {
    padding: "15px 30px",
    "padding-right": "20px",
    display: "flex",
    "column-gap": "5px",
    "flex-direction": "row-reverse",
    "justify-content": "center",
    "border-radius": "12px",
    background: "#197606",
    "font-size": "18px",
    "font-weight": 600,
  },
});

const addToCartToastWarning = Toastify({
  text: "Укажите количество саженцев",
  duration: 3000,
  close: true,
  gravity: "bottom",
  position: "left",
  stopOnFocus: true,
  style: {
    padding: "15px 30px",
    "padding-right": "20px",
    display: "flex",
    "column-gap": "5px",
    "flex-direction": "row-reverse",
    "justify-content": "center",
    "border-radius": "12px",
    background: "#FF9966",
    "font-size": "18px",
    "font-weight": 600,
  },
});

const section = document.querySelector("section");
const body = document.querySelector("body");
const burger = document.getElementById("burgerBtn");
const mobileMenu = document.getElementById("mobileMenu");

burger.addEventListener("click", function () {
  mobileMenu.classList.toggle("open");
  burger.classList.toggle("animate");
  body.classList.toggle("overflow-hidden");
});

if (document.getElementById("addToOrder")) {
  const itemName =
    document.querySelector(".product-item__subtitle").textContent + " " + document.querySelector(".product-item__title").textContent;
  const type = document.getElementById("itemType").name;
  const imgUrl = document.querySelector(".product-item__image").getElementsByTagName("img")[0].src;
  const itemUrl = document.getElementById("itemUrl").value;

  const items = document.querySelectorAll(".form-row__checkbox");
  const addToOrder = document.getElementById("addToOrder");

  addToOrder.addEventListener("click", function () {
    let amountWarning = false;
    const order = [];

    items.forEach((item) => {
      if (item.checked) {
        const itemId = item.id;
        const parent = item.parentElement;
        const orderData = parent.getElementsByTagName("label")[0].innerText;
        const itemAmount = item.nextElementSibling.getElementsByTagName("input")[0].value;
        const pricePerItem = parent.getElementsByClassName("form-row__item-price")[0].name;

        if (itemAmount < 1) {
          amountWarning = true;
        } else {
          order.push({
            name: itemName,
            data: orderData,
            amount: itemAmount,
            imgUrl: imgUrl,
            itemUrl: itemUrl,
            pricePerItem: pricePerItem,
            key: "order_" + type + "_" + itemId,
            timestamp: Date.now(),
          });
        }
      }
    });

    if (amountWarning) {
      addToCartToastWarning.showToast();
      return;
    }
    order.forEach((item) => {
      localStorage.setItem(item.key, JSON.stringify([item]));
    });

    updateCartBadge();
    addToCartToast.showToast();
  });

  // восстанавливаем данные если пользователь перезагрузил страницу
  items.forEach((item) => {
    const itemId = item.id;
    let localStorageData = localStorage.getItem("order_" + type + "_" + itemId);
    if (localStorageData) {
      item.checked = true;
      localStorageData = JSON.parse(localStorageData);
      item.nextElementSibling.getElementsByTagName("input")[0].value = localStorageData[0].amount;
    }
  });
}

// вывод саженцев, добавленных в корзину, на страницу корзины
jQuery(document).ready(function ($) {
  $.ajax({
    url: ajax.url,
    method: "POST",
    data: {
      action: "get_cart_items",
      localStorage: JSON.stringify(getLocalStorageItems()),
    },
    success: function (response) {
      if (response.success) {
        $("#orderItems").html(response.data.html);
      }
    },
  });
});

// взаимодействие с количеством саженцев, удаление из корзины
let currentItemForDelete = null;

if (document.querySelector("main.order")) {
  jQuery(document).ajaxComplete(function () {
    const items = document.querySelectorAll(".order__form-wrapper > div");
    const deleteModal = document.getElementById("confirmDeleteItem");
    const confirmDeleteFromModal = document.getElementById("confirmDeleteFromModal");
    const cancelDeleteFromModal = document.getElementById("cancelDeleteFromModal");
    const cancelDeleteCrossBtn = document.querySelector(".dialog__close-btn");

    confirmDeleteFromModal.onclick = function () {
      if (currentItemForDelete) {
        let localStorageKey = currentItemForDelete.querySelector("input[name=itemKey]").value;
        deleteItem(localStorageKey);
        updateCartBadge();
        deleteModal.close();
        currentItemForDelete = null;
      }
    };

    cancelDeleteFromModal.onclick = function () {
      if (currentItemForDelete) {
        let localStorageKey = currentItemForDelete.querySelector("input[name=itemKey]").value;
        currentItemForDelete.querySelector("input[name=amount]").value = 1;
        saveChangesToLocalstorage(localStorageKey, currentItemForDelete);
        refreshOrderItems();
        updateCartBadge();
        deleteModal.close();
        currentItemForDelete = null;
      }
    };

    cancelDeleteCrossBtn.onclick = function () {
      if (currentItemForDelete) {
        let localStorageKey = currentItemForDelete.querySelector("input[name=itemKey]").value;
        currentItemForDelete.querySelector("input[name=amount]").value = 1;
        saveChangesToLocalstorage(localStorageKey, currentItemForDelete);
        refreshOrderItems();
        updateCartBadge();
        deleteModal.close();
        currentItemForDelete = null;
      }
    };

    jQuery(document)
      .off("click", "#deleteItem")
      .on("click", "#deleteItem", function (e) {
        e.preventDefault();
        const deleteModal = document.getElementById("confirmDeleteItem");
        deleteModal.showModal();

        const deleteFromModal = document.getElementById("confirmDeleteFromModal");
        deleteFromModal.onclick = function () {
          let localStorageKey = e.currentTarget.querySelector("input").value;
          deleteItem(localStorageKey);
          updateCartBadge();
          deleteModal.close();
        };
      });

    items.forEach((item) => {
      let valueBtns = item.querySelectorAll(".form-group__btn");
      let amount = item.querySelector("input[name=amount]");
      let amountValue = item.querySelector("input[name=amount]").value;
      let pricePerItem = item.querySelector("input[name=pricePerItem]").value;
      let totalPricePerItem = calcPricePerItem(amountValue, pricePerItem);
      item.querySelector("#pricePerItem").innerHTML = totalPricePerItem + "&nbsp;₽";

      amount.addEventListener("input", function () {
        amountValue = item.querySelector("input[name=amount]").value;
        let localStorageKey = item.querySelector("input[name=itemKey]").value;
        item.querySelector("#pricePerItem").innerHTML = calcPricePerItem(amountValue, pricePerItem) + "&nbsp;₽";
        countItems();
        countTotalSum();
        saveChangesToLocalstorage(localStorageKey, item);
        updateCartBadge();
      });

      valueBtns.forEach((button) => {
        button.addEventListener("click", function () {
          amountValue = item.querySelector("input[name=amount]").value;
          let localStorageKey = item.querySelector("input[name=itemKey]").value;
          item.querySelector("#pricePerItem").innerHTML = calcPricePerItem(amountValue, pricePerItem) + "&nbsp;₽";

          if (amountValue == 0) {
            currentItemForDelete = item;
            deleteModal.showModal();
            return;
          }

          countItems();
          countTotalSum();
          saveChangesToLocalstorage(localStorageKey, item);
          updateCartBadge();
        });
      });
    });

    countItems();
    countTotalSum();
    updateCartBadge();
  });

  // показываем модальное окно для отправки заявки
  const orderButton = document.getElementById("orderButton");
  orderButton.addEventListener("click", function () {
    jQuery("input[name=phone]").mask(phoneMaskBehavior, spOptions);

    fillTotalDataToForm();
    fillOrderItemsHiddenField();
  });
}

const CART_LIFETIME = 7 * 24 * 60 * 60 * 1000; // 7 дней в миллисекундах

const CartStorage = {
  getAll() {
    const result = [];
    const now = Date.now();
    for (let i = 0; i < localStorage.length; i++) {
      const key = localStorage.key(i);
      if (key && key.startsWith("order_")) {
        const value = localStorage.getItem(key);
        if (value) {
          try {
            const items = JSON.parse(value);
            // Проверка срока жизни
            if (items[0] && items[0].timestamp && now - items[0].timestamp > CART_LIFETIME) {
              localStorage.removeItem(key);
              continue;
            }
            items.forEach((item) => result.push(item));
          } catch (e) {
            // ignore broken data
          }
        }
      }
    }
    return result;
  },

  get(key) {
    const value = localStorage.getItem(key);
    if (!value) return null;
    try {
      const items = JSON.parse(value);
      const now = Date.now();
      if (items[0] && items[0].timestamp && now - items[0].timestamp > CART_LIFETIME) {
        localStorage.removeItem(key);
        return null;
      }
      return items;
    } catch (e) {
      return null;
    }
  },

  set(key, item) {
    localStorage.setItem(key, JSON.stringify([item]));
  },

  remove(key) {
    localStorage.removeItem(key);
  },

  removeAll() {
    const keysToRemove = [];
    for (let i = 0; i < localStorage.length; i++) {
      const key = localStorage.key(i);
      if (key && key.startsWith("order_")) {
        keysToRemove.push(key);
      }
    }
    keysToRemove.forEach((key) => localStorage.removeItem(key));
  },
};

const phoneMaskBehavior = function (val) {
    return val.replace(/\D/g, "").startsWith("8") ? "0 (000) 000-00-00" : "(000) 000-00-00";
  },
  spOptions = {
    onKeyPress: function (val, e, field, options) {
      field.mask(phoneMaskBehavior.apply({}, arguments), options);
    },
  };

function getLocalStorageItems() {
  return CartStorage.getAll();
}

function saveChangesToLocalstorage(key, item) {
  const orderItem = {
    name: item.querySelector(".form-row__content-title").textContent,
    data: item.querySelector(".form-row__content-desc").textContent,
    amount: item.querySelector("input[name=amount]").value,
    imgUrl: item.querySelector("img").src,
    itemUrl: item.querySelector(".form-row__content-title").getAttribute("href"),
    pricePerItem: item.querySelector("input[name=pricePerItem]").value,
    key: key,
    timestamp: Date.now(),
  };
  CartStorage.set(key, orderItem);
}

function deleteItem(key) {
  CartStorage.remove(key);
  let data = CartStorage.getAll();
  jQuery(document).ready(function ($) {
    $.ajax({
      url: ajax.url,
      method: "POST",
      data: {
        action: "get_cart_items",
        localStorage: JSON.stringify(data),
      },
      success: function (response) {
        if (response.success) {
          $("#orderItems").html(response.data.html);
        }
      },
    });
  });
}

function refreshOrderItems() {
  const data = CartStorage.getAll();
  jQuery(document).ready(function ($) {
    $.ajax({
      url: ajax.url,
      method: "POST",
      data: {
        action: "get_cart_items",
        localStorage: JSON.stringify(data),
      },
      success: function (response) {
        if (response.success) {
          $("#orderItems").html(response.data.html);
        }
      },
    });
  });
}

function calcPricePerItem(amount, price) {
  let nums = price.match(/\d+/g);
  let results = nums ? nums.map((n) => parseInt(n, 10)) : [];

  if (results.length > 1) {
    return results[0] * amount + "-" + results[1] * amount;
  }
  return results[0] * amount;
}

function countItems() {
  const items = document.querySelectorAll("input[name=amount]");
  const totalItemsSum = document.querySelector(".order__submit-items");
  if (!totalItemsSum) return;
  const sum = Array.from(items).reduce((acc, item) => acc + parseInt(item.value || 0), 0);
  totalItemsSum.innerHTML = sum + " товаров";
}

function countTotalSum() {
  const itemSumfields = document.querySelectorAll("#pricePerItem");
  const totalPriceField = document.querySelector(".order__submit-summ");
  if (!totalPriceField) return;
  let finalPrice = [0, 0];

  itemSumfields.forEach((item) => {
    let nums = item.textContent.match(/\d+/g);
    let results = nums ? nums.map((n) => parseInt(n, 10)) : [0];

    if (results.length > 1) {
      finalPrice[0] += results[0];
      finalPrice[1] += results[1];
    } else {
      finalPrice[0] += results[0];
      finalPrice[1] += results[0];
    }
  });

  totalPriceField.innerHTML = finalPrice[0] === finalPrice[1] ? finalPrice[0] + " ₽" : finalPrice[0] + " - " + finalPrice[1] + " ₽";
}

function updateCartBadge() {
  const cart = document.querySelector(".header-main__cart");
  const storageItems = CartStorage.getAll();
  if (storageItems.length > 0) {
    cart.style.display = "flex";
    const cartBadge = document.querySelector(".header-main__cart-amount");
    let totalAmount = storageItems.reduce((acc, item) => acc + parseInt(item.amount), 0);
    cartBadge.innerHTML = totalAmount;
  } else {
    cart.style.display = "none";
  }
}

function fillTotalDataToForm() {
  const totalItemsSum = document.querySelector(".order__submit-items").innerHTML;
  const totalPriceField = document.querySelector(".order__submit-summ").innerHTML;
  const formTotalItems = document.getElementById("formTotalItems");
  const formTotalSumm = document.getElementById("formTotalSumm");
  const totalItemsInput = document.getElementById("totalItemsAmount");
  const totalSummInput = document.getElementById("totalItemsSumm");

  formTotalItems.innerHTML = totalItemsSum;
  totalItemsInput.value = totalItemsSum;
  formTotalSumm.innerHTML = totalPriceField;
  totalSummInput.value = totalPriceField;
}

function fillOrderItemsHiddenField() {
  const items = CartStorage.getAll().map((item) => ({
    name: item.name,
    data: item.data,
    amount: item.amount,
  }));
  document.getElementById("orderContent").value = JSON.stringify(items);
}

updateCartBadge();

jQuery("#orderRequest").on("submit", function (e) {
  e.preventDefault();

  fillTotalDataToForm();
  fillOrderItemsHiddenField();

  var checkField = document.querySelector(".checkField");
  const sendOrderModal = document.getElementById("sendOrder");
  const successMessageModal = document.getElementById("successMessage");
  const errorMessageModal = document.getElementById("errorMessage");
  var form = jQuery(this);
  var $that = jQuery(this);
  var formData = new FormData($that[0]);
  formData.append("action", "send_order_to_telegram");

  if (checkField.value != "") return false;
  if (!form.valid()) return false;

  jQuery.ajax({
    url: ajax.url,
    method: "POST",
    data: formData,
    processData: false,
    contentType: false,
    success: function (response) {
      if (response.success) {
        sendOrderModal.close();
        successMessageModal.showModal();
        CartStorage.removeAll();
        updateCartBadge();
        refreshOrderItems();
        console.log(response);
      } else {
        errorMessageModal.showModal();
        console.log(response);
      }
    },
    error: function (jqXHR, textStatus, errorThrown) {
      errorMessageModal.showModal();
      console.log(jqXHR, textStatus, errorThrown);
    },
  });
});

// Валидация форм
jQuery("form").each(function () {
  jQuery(this).validate({
    rules: {
      name: {
        required: true,
        minlength: 2,
      },

      phone: {
        required: true,
        minlength: 15,
      },

      policy: {
        required: true,
      },
    },

    messages: {
      name: {
        required: "Нам нужно Ваше имя и (или) фамилия, чтобы знать как к Вам обращаться",
        minlength: "Имя должно быть не менее 2 символов",
      },

      phone: {
        required: "Укажите Ваш номер телефона",
        minlength: jQuery.validator.format("Формат 8 (999) 999-99-99 или (999) 999-99-99"),
      },

      policy: {
        required: "Это поле является обязательным",
      },
    },
  });
});
