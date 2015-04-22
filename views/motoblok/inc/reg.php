<?php defined('SHOP') or die('Access Denied');
$reg = $this->session_reg()?>
<!-- Content -->
<div id="content_grid">
	<div id="container_grid">
		<section id="products_grid">
			<form action="" method="post">
				<div class="reg">
					<h3>Регистрация:</h3>
					<table class="registration" border="0" cellspacing="0" cellpadding="0">
						<tr>
							<td>*Логин:</td>
							<td class="reg-inpt"><input type="text" name="login" value="<?=$reg['login']?>"></td>
						</tr>
						<tr>
							<td>*Пароль:</td>
							<td class="reg-inpt"><input type="password" name="pass"></td>
						</tr>
						<tr>
							<td>*ФИО:</td>
							<td class="reg-inpt"><input type="text" name="name" value="<?=$reg['name']?>"></td>
						</tr>
						<tr>
							<td>*E-Mail:</td>
							<td class="reg-inpt"><input type="text" name="email" value="<?=$reg['email']?>"></td>
						</tr>
						<tr>
							<td>*Телефон:</td>
							<td class="reg-inpt"><input type="text" name="phone" value="<?=$reg['phone']?>"></td>
						</tr>
						<tr>
							<td>*Адрес:</td>
							<td class="reg-inpt"><input type="text" name="address" value="<?=$reg['address']?>"></td>
						</tr>
					</table>
				</div> <!-- .reg -->
				<input class="reg_submit" type="submit" name="reg" value="Зарегистрироваться">
			</form>
			<?php if(isset($_SESSION['reg']['res'])) {
				echo $_SESSION['reg']['res'];
				unset($_SESSION['reg']); } ?>
		</section> <!-- #products_grid -->
	</div> <!-- #container_grid -->
</div> <!-- #content_grid