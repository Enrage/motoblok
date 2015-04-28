<?php defined('SHOP') or die('Access Denied');
$cat = $this->cat();
$baseimg = $this->baseimg();
$imgslide = $this->imgslide()?>
<div id="content">
	<div id="container">
		<h2>Добавление товара</h2>
		<?php
		if(isset($_SESSION['edit_product']['res'])) {
			print $_SESSION['edit_product']['res'];
			unset($_SESSION['edit_product']['res']);
		}?>
		<div id="goods_id" style="display:none;"><?=$content[0]['goods_id']?></div>
		<form action="" method="post" enctype="multipart/form-data">
			<table class="edit_data">
				<tr>
					<td>Название товара:</td>
					<td><input type="text" name="name" value="<?=htmlspecialchars($content[0]['name'])?>"></td>
				</tr>
				<tr>
					<td>Цена товара:</td>
					<td><input type="text" name="price" value="<?=$content[0]['price']?>"></td>
				</tr>
				<tr>
					<td>Родительская категория:</td>
					<td>
						<select name="category" class="select_inf">
							<?php foreach($cat as $key_parent => $item): ?>
							<?php if(count($item) > 1): // Если родительская категория ?>
							<option disabled="">&nbsp;&nbsp;<?=$item[0]?></option>
								<?php foreach($item['sub'] as $key => $sub): // Цикл дочерних категорий ?>
								<option value="<?=$key?>" <?php if($key == $content[0]['goods_brandid']) echo 'selected'; ?>>&nbsp;&nbsp;&nbsp; - &nbsp;<?=$sub?></option>
								<?php endforeach; ?>
							<?php elseif($item[0]): // Если самостоятельная категория ?>
							<option value="<?=$key_parent?>" <?php if($key_parent == $content[0]['goods_brandid']) echo 'selected'; ?>>&nbsp;&nbsp;<?=$item[0]?></option>
							<?php endif; // count($item) ?>
								<?php print $key_parent; ?>
							<?php endforeach; ?>
						</select>
					</td>
				</tr>
				<tr>
					<td>Ключевые слова (keywords):</td>
					<td><input type="text" name="keywords" value="<?=htmlspecialchars($content[0]['keywords'])?>"></td>
				</tr>
				<tr>
					<td>Мета описание (description):</td>
					<td><input type="text" name="description" value="<?=htmlspecialchars($content[0]['description'])?>"></td>
				</tr>
				<tr>
					<td>Картинка товара:<br>
					<span class="small">Для удаления картинки кликните по ней</span>
					</td>
					<td class="baseimg"><?=$baseimg?></td>
				</tr>
				<tr>
					<td>Краткое описание:</td>
					<td></td>
				</tr>
				<tr>
					<td colspan="2">
						<textarea name="anons" class="anons_text"><?=$content[0]['anons']?></textarea>
					</td>
				</tr>
				<tr class="full_text">
					<td>Подробное описание:</td>
					<td></td>
				</tr>
				<tr>
					<td colspan="2">
						<textarea name="content" class="full_text"><?=$content[0]['content']?></textarea>
					</td>
				</tr>
				<tr>
					<td width="210">Картинки галереи:<br>
					<span class="small">Для удаления картинки кликните по ней</span></td>
					<td class="slideimg"><?=$imgslide?></td>
				</tr>
				<tr>
					<td>
						<div id="butUpload">Выбрать файл</div>
					</td>
					<td>
						<div id="filesUpload"></div>
					</td>
				</tr>
				<tr>
					<td class="eyestoper_check">Отметить как:</td>
					<td><input type="checkbox" value="1" <?php if($content[0]['news']) echo 'checked=""' ?> name="news" id="news"> <label for="news">Новинка</label> <br>
					<input type="checkbox" value="1" <?php if($content[0]['hits']) echo 'checked=""' ?> name="hits" id="hits"> <label for="hits">Лидер продаж</label> <br>
					<input type="checkbox" value="1" <?php if($content[0]['sale']) echo 'checked=""' ?> name="sale" id="sale"> <label for="sale">Акция</label> <br></td>
				</tr>
				<tr>
					<td>Показывать:</td>
					<td>
						<input type="radio" name="visible" value="1" <?php if($content[0]['visible']) echo 'checked=""' ?> id="visible"><label for="visible">Да<br></label>
						<input type="radio" name="visible" value="0" <?php if(!$content[0]['visible']) echo 'checked=""' ?> id="no_visible"><label for="no_visible">Нет</label>
					</td>
				</tr>
			</table>
			<input type="submit" name="submit" value="Добавить">
		</form>
		<?php unset($_SESSION['edit_product'])?>
	</div> <!-- #container -->
</div> <!-- #content -->
<script type="text/javascript">
	var button = $('#butUpload'), interval; // Кнопка загрузки + интервал
	var path = '<?=PRODUCT_THUMBS?>'; // Пут к папке превью
	var id = $('#goods_id').text(); // ID товара
	new AjaxUpload(button, {

	});
</script>