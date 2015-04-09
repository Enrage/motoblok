	<!-- Top Menu -->
	<nav class="top_menu">
		<ul>
			<li><a href="#">О магазине</a></li>
			<li><a href="#">Сервис</a></li>
			<li><a href="#">Доставка</a></li>
			<li><a href="#">Контакты</a></li>
			<?php if(!isset($_SESSION['auth']['user'])): ?>
			<li><a href="#" class="auth_login">Вход</a></li>
			<li><a href="?view=reg">Регистрация</a></li>
			<?php endif; ?>
			<li class="cart_i"><a href="?view=cart"><img class="cart_img" src="<?=TEMPLATE?>img/cart2.png" width="16" alt="Корзина"> В корзине</a><br><p>пока нет товаров</p></li>
		</ul>
		<div class="authform">
			<form method="post" action="">
				<label for="login">Логин: </label><br>
				<input type="text" name="login" id="login"><br>
				<label for="pass">Пароль: </label><br>
				<input type="password" name="pass" id="pass"><br>
				<input type="submit" name="auth" id="auth" value="Войти">
				<?php if(isset($_SESSION['auth']['error'])) {
					echo $_SESSION['auth']['error'];
					unset($_SESSION['auth']); } ?>
			</form>
		</div> <!-- .authform -->
	</nav> <!-- .top_menu -->
</header>