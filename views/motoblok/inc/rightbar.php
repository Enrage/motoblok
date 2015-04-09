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
		<p><span>27.03.2015</span><br>
		<a href="#">Распродажа мотоблоков</a></p>
		<p><span>30.03.2015</span><br>
		<a href="#">В продаже появились новые газонокосилки</a></p>
		<p><span>02.04.2015</span><br>
		<a href="#">У нас появилась группа вконтакте</a></p>
		<a href="#" class="archive_news">Архив новостей</a>
	</div> <!-- .news -->
</aside> <!-- #rightbar -->