# Тема WordPress для питомника растений "Берёзкино"

## Описание

Это кастомная тема WordPress для сайта питомника растений "Берёзкино".  
В репозитории содержится только тема, без ядра WordPress и пользовательских данных.

---

## Быстрый старт

### 1. Клонирование репозитория

```sh
git clone git@github.com:Olia-tsk/pitomnik-berezkino.git
```

### 2. Установка WordPress

1. [Скачайте последнюю версию WordPress](https://ru.wordpress.org/download/).
2. Распакуйте WordPress в нужную папку (например, `wp-berezkino`).
3. Скопируйте папку темы из этого репозитория в `wp-content/themes/`.

### 3. Настройка базы данных и wp-config.php

1. Создайте новую базу данных MySQL.
2. Заполните параметры подключения к базе данных в `wp-config.php`:

   ```php
   define('DB_NAME', 'ИМЯ_БД');
   define('DB_USER', 'ПОЛЬЗОВАТЕЛЬ_БД');
   define('DB_PASSWORD', 'ПАРОЛЬ_БД');
   define('DB_HOST', 'localhost');
   ```

3. Настройте переменные для интеграции с Telegram:

   В `wp-config.php` добавьте:

   ```php
   define('TELEGRAM_BOT_TOKEN', 'ВАШ_ТОКЕН_БОТА');
   define('TELEGRAM_CHAT_ID', 'ВАШ_CHAT_ID');
   ```

---

### 4. Установка и активация темы

1. В админке WordPress перейдите в "Внешний вид" → "Темы".
2. Активируйте тему "Берёзкино".

---

### 5. Необходимые плагины

Для корректной работы темы рекомендуется установить следующие плагины:

- [Cyr-To-Lat](https://ru.wordpress.org/plugins/cyr2lat/)
- [WP Mail SMTP](https://ru.wordpress.org/plugins/wp-mail-smtp/)
- [Permalink Manager Lite](https://ru.wordpress.org/plugins/permalink-manager/) (по желанию)
- [Carbon fields](https://docs.carbonfields.net/quickstart.html) (уже добавлен в тему и не требует установки через админ.панель)
- Reviews Admin Table (уже добавлен в тему, необходимо активировать через админ.панель)

Для корректной работы плагина Reviews Admin Table необходимо создать таблицу в базе данных, в которой установлен WordPress:

```
CREATE TABLE IF NOT EXISTS `wp_reviews` (
  `review_id` bigint(20) unsigned NOT NULL,
  `review_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `review_name` text NOT NULL,
  `review_text` text NOT NULL,
  `review_status` varchar(24) NOT NULL DEFAULT 'на модерации',
  `review_type` varchar(20) NOT NULL DEFAULT 'review',
  `review_approved` varchar(20) NOT NULL DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4;
```

---

### 6. Сборка стилей (если используется Sass)

Для компиляции Sass используйте [Live Sass Compiler](https://marketplace.visualstudio.com/items?itemName=glenn2223.live-sass) в VS Code или любой другой способ.
Исходные файлы стилей находятся в `wp-content/themes/berezkino/assets/sass/`.
