<?php defined('SHOP') or die('Access Denied');
$cat = $this->cat();
$session_product = $this->session_add_product()?>
<div id="content">
	<div id="container">
		<h2>Добавление товара</h2>
		<?php
		if(isset($_SESSION['add_product']['res'])) {
			print $_SESSION['add_product']['res'];
			unset($_SESSION['add_product']['res']);
		}?>
		<form action="" method="post" enctype="multipart/form-data">
			<table class="edit_data">
				<tr>
					<td>Название товара:</td>
					<td><input type="text" name="name" value="<?=$session_product['name']?>"></td>
				</tr>
				<tr>
					<td>Цена товара:</td>
					<td><input type="text" name="price" value="<?=$session_product['price']?>"></td>
				</tr>
				<tr>
					<td>Родительская категория:</td>
					<td>
						<select name="category" class="select_inf">
							<?php foreach($cat as $key_parent => $item): ?>
							<?php if(count($item) > 1): // Если родительская категория ?>
							<option disabled="">&nbsp;&nbsp;<?=$item[0]?></option>
								<?php foreach($item['sub'] as $key => $sub): // Цикл дочерних категорий ?>
								<option value="<?=$key?>" <?php if($key == $content) echo 'selected'; ?>>&nbsp;&nbsp;&nbsp; - &nbsp;<?=$sub?></option>
								<?php endforeach; ?>
							<?php elseif($item[0]): // Если самостоятельная категория ?>
							<option value="<?=$key_parent?>" <?php if($key_parent == $content) echo 'selected'; ?>>&nbsp;&nbsp;<?=$item[0]?></option>
							<?php endif; // count($item) ?>
								<?php print $key_parent; ?>
							<?php endforeach; ?>
						</select>
					</td>
				</tr>
				<tr>
					<td>Ключевые слова (keywords):</td>
					<td><input type="text" name="keywords" value="<?=$session_product['keywords']?>"></td>
				</tr>
				<tr>
					<td>Описание (description):</td>
					<td><input type="text" name="description" value="<?=$session_product['description']?>"></td>
				</tr>
				<tr>
					<td>Картинка товара:</td>
					<td><input type="file" name="baseimg"></td>
				</tr>
				<tr>
					<td>Краткое описание:</td>
					<td></td>
				</tr>
				<tr>
					<td colspan="2">
						<textarea name="anons" class="anons_text"><?=$session_product['anons']?></textarea>
					</td>
				</tr>
				<tr class="full_text">
					<td>Подробное описание:</td>
					<td></td>
				</tr>
				<tr>
					<td colspan="2">
						<textarea name="content" class="full_text"><?=$session_product['content']?></textarea>
					</td>
				</tr>
				<tr>
					<td>Картинки галереи:</td>
					<td></td>
				</tr>
				<tr>
					<td id="btnimg">
						<div><input type="file" name="galleryimg[]"></div>
					</td>
				</tr>
				<tr>
					<td>
						<input type="button" value="Добавить поле" id="add">
						<input type="button" value="Удалить поле" id="del">
					</td>
				</tr>
				<tr>
					<td class="eyestoper_check">Отметить как:</td>
					<td><input type="checkbox" value="1" name="news" id="news"> <label for="news">Новинка</label> <br>
					<input type="checkbox" value="1" name="hits" id="hits"> <label for="hits">Лидер продаж</label> <br>
					<input type="checkbox" value="1" name="sale" id="sale"> <label for="sale">Акция</label> <br></td>
				</tr>
				<tr>
					<td>Показывать:</td>
					<td>
						<input type="radio" name="visible" value="1" checked="" id="visible"><label for="visible">Да<br></label>
						<input type="radio" name="visible" value="0" id="no_visible"><label for="no_visible">Нет</label>
					</td>
				</tr>
			</table>
			<input type="submit" name="submit" value="Добавить">
		</form>
		<?php unset($_SESSION['add_product'])?>
	</div>
</div>