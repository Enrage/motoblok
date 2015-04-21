<?php defined('SHOP') or die('Access Denied');
$cat = $this->cat()?>
<div id="content">
	<div id="container">
		<h2>Редактирование страницы</h2>
		<?php
		if(isset($_SESSION['edit_brand']['res'])) {
			print $_SESSION['edit_brand']['res'];
			unset($_SESSION['edit_brand']['res']);
		}?>
		<form action="" method="post">
			<table class="edit_data">
				<tr>
					<td>Название страницы:</td>
					<td><input type="text" name="brand_name" value="<?=htmlspecialchars($content[0]['brand_name'])?>"></td>
				</tr>
				<script type="text/javascript">
					var brand = $(".edit_data input[name='brand_name']").val();
					document.write('<input type="hidden" name="this_brand" value="' + brand + '">');
				</script>
				<tr>
					<td>Родительская категория:</td>
					<?php if(!isset($cat[$content[0]['brand_id']]['sub'])): ?>
					<td>
						<select name="parent_id" class="select_parent_id">
							<option value="0">Самостоятельная категория</option>
							<?php foreach($cat as $key => $value): ?>
							<?php if($value[0] == $content[0]['brand_name']) continue; ?>
							<option value="<?=$key?>"><?=$value[0]?></option>
							<?php endforeach; ?>
						</select>
					</td>
					<?php else: ?>
						<td class="no_input"><p>Данная категория содержит подкатегории</p></td>
					<?php endif; ?>
				</tr>
				<tr>
					<td>Ключевые слова (keywords):</td>
					<td><input type="text" name="keywords" value="<?=htmlspecialchars($content[0]['keywords'])?>"></td>
				</tr>
				<tr>
					<td>Мета описание (description):</td>
					<td><input type="text" name="description" value="<?=htmlspecialchars($content[0]['description'])?>"></td>
				</tr>
			</table>
			<input type="submit" name="submit" value="Сохранить">
		</form>
	</div>
</div>
</div>