<?php defined('SHOP') or die('Access Denied');
$meta_words = new meta();
$meta = $meta_words->get_content();

	//case 'cat':
	//	foreach($cat as $key => $item) {
	//		if(count($item) > 1) {
	//			$title = $item[0]; }
			 /*else {
				foreach($item['sub'] as $key => $sub) {
					$title = $sub;
				}
			}*/
	//	}
		// for($i = 1; $i <= count($brands) ; $i++) {
		// 	$title = $brands[$i][0]['brand_name'];
		// }
	//break;
// 		default:
// 			# code...
// 			break;
// }
?>
<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<meta name="keywords" content="<?=$meta['keywords']?>">
	<meta name="description" content="<?=$meta['description']?>">
	<meta name="rights" content="Интернет-магазин &quot;Все мотоблоки&quot;">
	<link rel="stylesheet" type="text/css" href="<?=TEMPLATE?>css/style.css">
	<script src="<?=TEMPLATE?>js/jquery-1.11.1.js" type="text/javascript"></script>
	<script src="<?=TEMPLATE?>js/jquery-2.1.1.js" type="text/javascript"></script>
	<!--[if IE]>
	<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	<!--[if IE 6]>
	<script defer type="text/javascript" src="<?=TEMPLATE?>js/pngfix.js" mce_src="js/pngfix.js"></script>
	<script src="<?=TEMPLATE?>js/script_ie6.js" type="text/javascript"></script>
	<link rel="stylesheet" href="<?=TEMPLATE?>css/ie6.css">
	<![endif]-->
	<!--[if IE 7]>
	<link rel="stylesheet" href="<?=TEMPLATE?>css/ie7.css">
	<script src="<?=TEMPLATE?>js/script_ie7.js" type="text/javascript"></script>
	<![endif]-->
	<!--[if IE 8]>
	<link rel="stylesheet" href="<?=TEMPLATE?>css/ie8.css">
	<script src="<?=TEMPLATE?>js/script_ie8.js" type="text/javascript"></script>
	<![endif]-->
	<script type="text/javascript" src="<?=TEMPLATE?>js/jquery.cookie.js"></script>
	<script type="text/javascript" src="<?=TEMPLATE?>js/script.js"></script>
	<script type="text/javascript" src="<?=TEMPLATE?>js/fancybox/jquery.fancybox.pack.js"></script>
	<script type="text/javascript" src="<?=TEMPLATE?>js/mobilyslider.js" ></script>
	<script type="text/javascript" src="<?=TEMPLATE?>js/init.js"></script>
	<link rel="stylesheet" type="text/css" href="<?=TEMPLATE?>js/fancybox/jquery.fancybox.css" media="screen">
	<script type="text/javascript">var query = '<?=$_SERVER['QUERY_STRING']?>';</script>
	<title><?=$meta['title']?></title>
</head>
<body>
<div id="wrapper">
<div class="top_line"></div>
	<header>
		<!-- Search -->
		<div class="search">
			<form action="" method="get">
				<input type="hidden" name="view" value="search">
				<input type="text" name="search" id="input_search">
				<input type="submit" name="" value="" id="search">
			</form>
		</div> <!-- .search -->

		<div class="logo">
			<!-- <a href="#"><img src="img/logo_main.png" width="270" alt="logo"></a> -->
			<a href="<?=PATH?>"><img src="<?=TEMPLATE?>img/logotip2.jpg" width="350" alt="logo"></a>
		</div> <!-- .logo -->

		<!-- Contacts -->
		<section class="time_contact">
			<p class="contact">Телефон:<br>
			<span>8(495)928-32-11</span></p>
			<p class="work_time">Время работы:<br>
			<span>с 8:00 до 22:00</span><br>
			<span>(Пн - Вс)</span></p>
		</section> <!-- .time_contact -->