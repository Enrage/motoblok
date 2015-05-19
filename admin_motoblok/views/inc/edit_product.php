<?php defined('SHOP') or die('Access Denied');
$cat = $this->cat();
$baseimg = $this->baseimg();
$imgslide = $this->imgslide();
$contents = $this->get_product_data();
// if(isset($_POST['id'])) {
//  	$this->m->upload_file();
// }
?>
<div id="content">
	<div id="container">
		<h2>Добавление товара</h2>
		<?php
		if(isset($_SESSION['edit_product']['res'])) {
			print $_SESSION['edit_product']['res'];
			unset($_SESSION['edit_product']['res']);
		}?>
		<div id="goods_id" style="display:none;"><?=$contents[0]['goods_id']?></div>
		<form action="" method="post" enctype="multipart/form-data">
			<table class="edit_data">
				<tr>
					<td>Название товара:</td>
					<td><input type="text" name="name" value="<?=htmlspecialchars($contents[0]['name'])?>"></td>
				</tr>
				<tr>
					<td>Цена товара:</td>
					<td><input type="text" name="price" value="<?=$contents[0]['price']?>"></td>
				</tr>
				<tr>
					<td>Родительская категория:</td>
					<td>
						<select name="category" class="select_inf">
							<?php foreach($cat as $key_parent => $item): ?>
							<?php if(count($item) > 1): // Если родительская категория ?>
							<option disabled="">&nbsp;&nbsp;<?=$item[0]?></option>
								<?php foreach($item['sub'] as $key => $sub): // Цикл дочерних категорий ?>
								<option value="<?=$key?>" <?php if($key == $contents[0]['goods_brandid']) echo 'selected'; ?>>&nbsp;&nbsp;&nbsp; - &nbsp;<?=$sub?></option>
								<?php endforeach; ?>
							<?php elseif($item[0]): // Если самостоятельная категория ?>
							<option value="<?=$key_parent?>" <?php if($key_parent == $contents[0]['goods_brandid']) echo 'selected'; ?>>&nbsp;&nbsp;<?=$item[0]?></option>
							<?php endif; // count($item) ?>
								<?php print $key_parent; ?>
							<?php endforeach; ?>
						</select>
					</td>
				</tr>
				<tr>
					<td>Ключевые слова (keywords):</td>
					<td><input type="text" name="keywords" value="<?=htmlspecialchars($contents[0]['keywords'])?>"></td>
				</tr>
				<tr>
					<td>Описание (description):</td>
					<td><input type="text" name="description" value="<?=htmlspecialchars($contents[0]['description'])?>"></td>
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
						<textarea name="anons" class="anons_text"><?=$contents[0]['anons']?></textarea>
					</td>
				</tr>
				<tr class="full_text">
					<td>Подробное описание:</td>
					<td></td>
				</tr>
				<tr>
					<td colspan="2">
						<textarea name="content" class="full_text"><?=$contents[0]['content']?></textarea>
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
						<?php $this->f->print_arr($_FILES); ?>
						<!-- <input type="file" name="file"> -->
					</td>
					<td>
						<div id="filesUpload"></div>
					</td>
				</tr>
				<tr>
					<td class="eyestoper_check">Отметить как:</td>
					<td><input type="checkbox" value="1" <?php if($contents[0]['news']) echo 'checked=""'; ?> name="news" id="news"> <label for="news">Новинка</label> <br>
					<input type="checkbox" value="1" <?php if($contents[0]['hits']) echo 'checked=""'; ?> name="hits" id="hits"> <label for="hits">Лидер продаж</label> <br>
					<input type="checkbox" value="1" <?php if($contents[0]['sale']) echo 'checked=""'; ?> name="sale" id="sale"> <label for="sale">Акция</label> <br></td>
				</tr>
				<tr>
					<td>Показывать:</td>
					<td>
						<input type="radio" name="visible" value="1" <?php if($contents[0]['visible']) echo 'checked=""' ?> id="visible"><label for="visible">Да<br></label>
						<input type="radio" name="visible" value="0" <?php if(!$contents[0]['visible']) echo 'checked=""' ?> id="no_visible"><label for="no_visible">Нет</label>
					</td>
				</tr>
			</table>
			<input type="submit" name="submit" value="Добавить">
		</form>
		<?php unset($_SESSION['edit_product'])?>
	</div> <!-- #container -->
</div> <!-- #content -->
<script type="text/javascript">
$(document).ready(function() {
	var button = $('#butUpload'), interval; // Кнопка загрузки + интервал
	var path = '<?=PRODUCT_THUMBS?>'; // Путь к папке превью
	var id = $('#goods_id').text(); // ID товара
	new AjaxUpload(button, {
		action: 'index.php?view=edit_product&goods_id=' + id + '&upload=1',
		name: 'userfile',
		onSubmit: function(file, ext) {
			if(!(ext && /^(jpg|png|jpeg|gif|tiff)$/i.test(ext))) {
				alert('Запрещенный тип файла');
				return false;
			}
			button.text('Загрузка');
			this.disable();
			interval = window.setInterval(function() {
				var text = button.text();
				if(text.length < 11) {
					button.text(text + '.');
				} else {
					button.text('Загрузка');
				}
			}, 300);
		},
		onComplete: function(file, response) {
			button.text('Загрузить еще?');
			window.clearInterval(interval);
			this.enable();
			var res = JSON.parse(response);
			if(res.answer == 'OK') {
				console.log(res.answer);
			} else {
				alert(res.answer);
			}
		}
	});
});
</script>