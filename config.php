<?php
defined('SHOP') or die('Access Denied');
// Домен
define('PATH', 'http://localhost/motoblok/');
// Функции
define('FUNC', 'model/functions.php');
// Модель
define('MODEL', 'model/model.php');
// Вид
define('VIEW', 'views/');
// Активный шаблон
define('TEMPLATE', 'views/motoblok/');
// Папка с картинками контента
define('PRODUCT', PATH.'userfiles/');
// Сервер БД
define('HOST', 'localhost');
// Пользователь
define('USER', 'motoblok_user');
// Пароль
define('PASS', 'ovlwD31');
// БД
define('DB', 'motoblok');
// Название магазина - title
define('TITLE', 'Интернет-магазин Всемотоблоки');
// Email администратора
define('ADMIN_EMAIL', 'remover88@mail.ru');
// Кол-во товаров на странице
define('PERPAGE', 6);
// Кол-во товаров на странице в админке
define('ADM_PERPAGE', 12);
// Папка шаблонов административной части
define('ADMIN_TPL', 'views/');
// Домашняя папка
define('HOME', $_SERVER['DOCUMENT_ROOT'].'/motoblok');
?>