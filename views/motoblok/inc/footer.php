<?php defined('SHOP') or die('Access Denied');
$informers = $this->m->informers()?>
<footer>
	<?php foreach($informers as $informer): ?>
	<div class="about_us">
		<h3><?=$informer[0]?></h3>
		<ul>
		<?php foreach($informer['sub'] as $key => $sub): ?>
			<li><a href="?view=informer&amp;informer_id=<?=$key?>"><?=$sub?></a></li>
		<?php endforeach; ?>
		</ul>
	</div> <!-- .about_us -->
	<?php endforeach; ?>

	<div class="newsletter">
		<h3>Новости</h3>
		<form method="post" action="">
			<label><p>Подписаться на наши новости:</p><input type="text" name="newsletter" id="newsletter"></label><br>
			<input type="submit" value="Подписаться" id="news_submit">
		</form>
	</div> <!-- .newsletter -->
	<div class="clr"></div>
	<!-- Bottom Menu -->
	<section id="bottom_menu">
		<ul>
			<li><a href="#">Карта сайта</a></li>
			<li><a href="#">Поиск товаров</a></li>
			<li><a href="#">Расширенный поиск</a></li>
			<li><a href="#">Обратная связь</a></li>
		</ul>
	</section> <!-- #bottom_menu -->
	<div class="clr"></div>
	<div class="copy">&copy; 2015 vsemotobloki.ru</div>
</footer>