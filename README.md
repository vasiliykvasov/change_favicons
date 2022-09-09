
# О скрипте change_favicons.php

change_favicons.php — php-скрипт для решения проблемы меняющихся фавиконок на нескольких сайтах под управлением одной лицензии 1С-Битрикс, работающих на шаблоне DW Deluxe.

# Как работать со скриптом

Перед началом работы нужно загрузить новые фавиконки на сервер. Лучше загрузить их в папки /upload/favicon/название-сайта.

Для работы скрипта нужно скачать файл `change_favicons.php`, и отредактировать его — настроить параметры: заполнить список сайтов и пути фавиконок.

Настройки осуществляются в массиве `$favicons`. Его элементами должны быть массивы с ключами old_favicon и new_favicon.

Значение `old_favicon` — путь к старому фавикону от корня сервера, который нужно заменить.

Значение `old_favicon` — путь к новому фавикону от корня сервера, который будет заменять старый.

Например:

```
$favicons = [
    "site1" => [
		"old_favicon" => "/home/bitrix/ext_www/site1/favicon.ico", // Старый фавикон
		"new_favicon" => "/home/bitrix/www/upload/favicon/site1/favicon.ico" // Новый фавикон
    ],
    "site2" => [
		"old_favicon" => "/home/bitrix/ext_www/site2/favicon.ico", // Старый фавикон
		"new_favicon" => "/home/bitrix/www/upload/favicon/site2/favicon.ico" // Новый фавикон
    ],
];
```

После того, как параметры настроены, скрипт нужно скопировать скрипт и запустить на сервере. Лучше всего это делать через командную PHP-строку 1С-Битрикс:
https://адрес-сайта.рф/bitrix/admin/php_command_line.php

После запуска скрипт выведет результаты своей работы, если был передан параметр true.

# Как работает скрипт

Скрипт change_favicons.php работает следующим образом.

1. Проверяет, существует ли новый фавикон.
2. Если новый фавикон существует, проверяет, существует ли старый фавикон.
3. Если старый фавикон существует, удаляет его.
4. Проверяет, существует ли старый фавикон. 
5. Если старый фавикон удален, копирует новый фавикон.

Облегченный скрипт change_favicons_min.php работает без дополнительных проверок и логирования.

1. Проверяет, существует ли новый фавикон.
2. Если новый фавикон существует, копирует его.


# Добавление в init.php

Если копирование происходит без проблем, можно добавить облегченный скрипт change_favicons_min.php в init.php для того, чтобы постоянно запускать скрипт одной функцией или добавить его в агенты.

Подробнее про init.php: https://dev.1c-bitrix.ru/learning/course/index.php?COURSE_ID=43&LESSON_ID=2916
Подробнее про агенты: https://dev.1c-bitrix.ru/learning/course/?COURSE_ID=43&CHAPTER_ID=03436&LESSON_PATH=3913.3516.3436

Чтобы добавить скрипт в init.php, нужно сделать следующее.

1. Загрузить настроенный файл `change_favicons_min.php` в папку `/bitrix/php_interface/include/` или `/local/php_interface/include/`, в зависимости от того, где находится файл init.php.
2. Дописать в `init.php` подключение файла.

Обратите внимание, что в отличие от папки bitrix папка local не связана символическими ссылками в рамках многосайтовости, поэтому лучше добавлять скрипт в init.php лучше в папку local сайта, который находится в папке www, а не ext_www.

Если init.php находится в папке local:

```
if (file_exists($_SERVER["DOCUMENT_ROOT"]."/local/php_interface/include/change_favicons_min.php"))
    require_once($_SERVER["DOCUMENT_ROOT"]."/local/php_interface/include/change_favicons_min.php");
```

Если init.php находится в папке bitrix:
```
if (file_exists($_SERVER["DOCUMENT_ROOT"]."/bitrix/php_interface/include/change_favicons_min.php"))
    require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/php_interface/include/change_favicons_min.php");
```

Теперь скрипт можно запустить вызовом функции без логов:
`change_favicons();`



# Лицензия
Этот проект лицензируется в соответствии с лицензией Beerware.
