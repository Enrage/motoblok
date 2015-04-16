<?php defined('SHOP') or die('Access Denied');
$dostavka = $this->get_content();
$session_order = $this->session_order()?>
<!-- Content -->
<div id="content_grid">
	<div id="container_grid">
		<section id="products_grid">
			<h3>Ваша корзина</h3>
			<?php if(isset($_SESSION['order']['res'])) {
				echo $_SESSION['order']['res']; } ?>
			<?php if(!empty($_SESSION['cart'])): // Проверка корзины ?>
			<form action="" method="post">
				<div id="cart">
					<table cellpadding="0" cellspacing="0" border="0">
						<tr>
							<th class="z_top">Наименование</th>
							<th class="z_top">Изображение</th>
							<th class="z_top">Цена</th>
							<th class="z_top_kol">Кол-во</th>
							<th class="z_top">Удалить</th>
						</tr>
						<?php foreach($_SESSION['cart'] as $key => $item): ?>
						<tr>
							<td class="z_name"><a href="?view=product&amp;goods_id=<?=$key?>"><?=$item['name']?></a></td>
							<td class="z_img"><a href="?view=product&amp;goods_id=<?=$key?>"><img src="<?=PRODUCT?><?=$item['img']?>" width="120" alt="<?=$item['name']?>"></a></td>
							<td class="z_price"><span><?=$item['price']?></span> руб</td>
							<td class="z_kol"><input type="text" name="" value="<?=$item['qty']?>" id="id-<?=$key?>" class="kolvo"></td>
							<td class="z_del"><a href="?view=cart&amp;delete=<?=$key?>"><img src="<?=TEMPLATE?>img/del_from_cart.png" width="15" alt="Удалить из корзины"></a></td>
						</tr>
						<?php endforeach; ?>
						<tr>
							<td colspan="5" class="continue_shopping"><a href="#">Продолжить покупки</a><p>Общая сумма заказа: <span><?=$_SESSION['total_sum']?> руб.</span></p></td>
						</tr>
					</table>
				</div> <!-- #cart -->
				<div class="sposob_dostavki">
					<h3>Способы доставки:</h3>
					<?php foreach($dostavka as $item): ?>
					<p><input type="radio" name="dostavka" value="<?=$item['dostavka_id']?>" id="id<?=$item['dostavka_id']?>"><label for="id<?=$item['dostavka_id']?>"><?=$item['name']?></label></p>
					<?php endforeach; ?>
				</div>
				<div class="info_dostavka">
					<h3>Информация для доставки:</h3>
					<?php if(!isset($_SESSION['auth']['user'])): // Если пользователь не авторизован ?>
					<table class="zakaz-data" border="0" cellspacing="0" cellpadding="0">
						<tr class="notauth">
							<td class="zakaz-txt">ФИО:</td>
							<td class="zakaz-inpt"><input type="text" name="name" value="<?=$session_order['name']?>"></td>
							<td class="zakaz-prim">Пример: Иванов Сергей Александрович</td>
						</tr>
						<tr class="notauth">
							<td class="zakaz-txt">E-Mail:</td>
							<td class="zakaz-inpt"><input type="text" name="email" value="<?=$session_order['email']?>"></td>
							<td class="zakaz-prim">Пример: test@mail.ru</td>
						</tr>
						<tr class="notauth">
							<td class="zakaz-txt">Телефон:</td>
							<td class="zakaz-inpt"><input type="text" name="phone" value="<?=$session_order['phone']?>"></td>
							<td class="zakaz-prim">Пример: 8 937 999 99 99</td>
						</tr>
						<tr class="notauth">
							<td class="zakaz-txt">Адрес доставки:</td>
							<td class="zakaz-inpt"><input type="text" name="address" value="<?=$session_order['address']?>"></td>
							<td class="zakaz-prim">Пример: г. Москва, пр. Мира, ул. Петра Великого д.19, кв 51.</td>
						</tr>
						<tr>
							<td class="zakaz-txt-prim">Примечание:</td>
							<td class="zakaz-txtarea"><textarea name="prim"><?=$session_order['prim']?></textarea></td>
							<td class="zakaz-prim">Пример: Позвоните пожалуйста после 10 вечера, до этого времени я на работе.</td>
						</tr>
					</table>
					<?php else: ?>
					<table class="zakaz-data" border="0" cellspacing="0" cellpadding="0">
						<tr>
							<td class="zakaz-txt-prim">Примечание:</td>
							<td class="zakaz-txtarea"><textarea name="prim"><?=$session_order['prim']?></textarea></td>
							<td class="zakaz-prim">Пример: Позвоните пожалуйста после 10 вечера, до этого времени я на работе.</td>
						</tr>
					</table>
					<?php endif; // Проверка авторизации ?>
				</div>
				<input class="zakaz" type="submit" name="order" value="Заказать">
			</form>
			<?php else: ?>
			<p class="empty_cart">Корзина пуста</p>
			<?php endif; ?>
			<?php unset($_SESSION['order'])?>
		</section> <!-- #products_grid -->
	</div> <!-- #container_grid -->
</div> <!-- #content_grid -->