<?php defined('SHOP') or die('Access Denied')?>
<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="utf-8">
	<title>Админка</title>
	<link rel="stylesheet" href="<?=ADMIN_TPL?>css/style.css">
	<script type="text/javascript" src="../<?=TEMPLATE?>js/jquery-1.11.1.js"></script>
  <script type="text/javascript" src="../<?=TEMPLATE?>js/jquery-ui.min.js"></script>
  <script type="text/javascript" src="<?=ADMIN_TPL?>js/scripts.js"></script>
  <script type="text/javascript" src="<?=ADMIN_TPL?>js/ckeditor/ckeditor.js"></script>
  <script type="text/javascript" src="<?=ADMIN_TPL?>js/ckeditor/adapters/jquery.js"></script>
  <script type="text/javascript" src="<?=ADMIN_TPL?>js/ajaxupload.js"></script>
</head>
<body>
<div id="wrapper">
	<header>
		<a href="<?=PATH?>admin_motoblok/" class="logo">Admin Panel</a>
		<div class="top_menu">
			<ul>
				<li><a href="">Добро пожаловать, <span><?=$_SESSION['auth']['name']?></span><img src="<?=PATH?>admin_motoblok/<?=ADMIN_TPL?>img/icon_user.png" width="12" alt="User"></a></li>
				<li><a href="<?=PATH?>" target="_blank">Перейти на сайт</a></li>
				<li><a href="?view=settings"><img src="<?=PATH?>admin_motoblok/<?=ADMIN_TPL?>img/icon_settings.png" width="11" alt="Settings">Настройки</a></li>
				<li><a href="?view=logout"><img src="<?=PATH?>admin_motoblok/<?=ADMIN_TPL?>img/icon_logout.png" width="11" alt="Logout">Выйти</a></li>
			</ul>
		</div>
	</header>