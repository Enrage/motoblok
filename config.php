<?php
defined('SHOP') or die('Access Denied');
// Домен
define('PATH', 'http://signorgiardino.ru/');
// define('PATH', 'http://localhost/motoblok/');
// Функции
define('FUNC', 'model/functions.php');
// Модель
define('MODEL', 'model/model.php');
// Вид
define('VIEW', 'views/');
// Активный шаблон
define('TEMPLATE', 'views/motoblok/');
// Папка с картинками контента
define('PRODUCT', PATH.'userfiles/product_img/baseimg/');
// Папка с временными файлами
define('PRODUCT_TMP', PATH.'userfiles/product_img/tmp/');
// Папка с картинками для галереи
define('PRODUCT_PHOTOS', PATH.'userfiles/product_img/photos/');
// Папка с картинками миниатюрами
define('PRODUCT_THUMBS', PATH.'userfiles/product_img/thumbs/');
// Максимально допустимый вес загружаемых картинок - 3 мб
define('SIZE', '3145728');
// Сервер БД
define('HOST', 'localhost');
// Пользователь
define('USER', 'cl120050_user');
// define('USER', 'motoblok_user');
// Пароль
define('PASS', '12qWjiD0');
// define('PASS', 'ovlwD31');
// БД
define('DB', 'cl120050_motoblok');
// define('DB', 'motoblok');
// Название магазина - title
define('TITLE', 'Интернет-магазин Всемотоблоки');
// Email администратора
define('ADMIN_EMAIL', 'remover88@mail.ru');
// Кол-во товаров на странице
define('PERPAGE', 6);
// Кол-во товаров на странице в админке
define('ADM_PERPAGE', 12);
// Кол-во новостей на странице в архиве
define('PERPAGE_NEWS', 2);
// Папка шаблонов административной части
define('ADMIN_TPL', 'views/');
// Домашняя папка
define('HOME', $_SERVER['DOCUMENT_ROOT'].'/motoblok');
?>