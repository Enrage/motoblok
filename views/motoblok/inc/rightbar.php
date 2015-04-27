<?php defined('SHOP') or die('Access Denied');
$news_page = $this->m->get_title_news();?>
<!-- Rightbar -->
<aside id="rightbar">
	<div class="user_login">
	<?php if(isset($_SESSION['auth']['user'])): ?>
		<p>Добро пожаловать,<br><span><?=$_SESSION['auth']['user']?></span></p>
		<a href="?view=logout">Выйти</a>
	<?php else: ?>
		<style>
			.user_login {
				display: none;
			}
		</style>
	<?php endif; ?>
	</div>
	<!-- Корзина -->
	<div class="cart">
		<a href="?view=cart"><img src="<?=TEMPLATE?>img/cart_img.png" width="24" alt="Корзина">Моя корзина</a>
		<?php if(isset($_SESSION['cart']) && count($_SESSION['cart']) > 0): ?>
		<p class="col">Товаров: <span id="bought"><?=$_SESSION['total_quantity']?></span></p>
		<p class="sum">На сумму: <span id="sum"><?=$_SESSION['total_sum']?></span> руб.</p>
		<a href="?view=cart" class="oformit">Оформить</a>
		<?php else: ?>
		<p class="empty_cart">Корзина пуста</p>
		<p class="col">Товаров: <span id="bought"></span></p>
		<p class="sum">На сумму: <span id="sum"></span> руб.</p>
		<a href="?view=cart" class="oformit">Оформить</a>
		<?php endif; ?>
	</div> <!-- .cart -->

	<!-- News -->
	<div class="news">
		<h3>Новости</h3>
		<?php if(!empty($news_page)): ?>
			<?php foreach($news_page as $item): ?>
			<p><span><?=$item['date']?></span><br>
			<a href="?view=news_page&amp;news_id=<?=$item['news_id']?>"><?=$item['title']?></a></p>
			<?php endforeach; ?>
			<a href="?view=archive_news" class="archive_news">Архив новостей</a>
		<?php else: ?>
			<p>Новостей пока нет.</p>
		<?php endif; ?>
	</div> <!-- .news -->
</aside> <!-- #rightbar -->