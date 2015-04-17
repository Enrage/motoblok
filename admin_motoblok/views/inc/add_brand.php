<?php defined('SHOP') or die('Access Denied');
//$brands = $this->session_brands();
$cat = $this->get_content()?>
<div id="content">
	<div id="container">
		<h2>Добавление страницы</h2>
		<?php
		if(isset($_SESSION['add_brand']['res'])) {
			print $_SESSION['add_brand']['res'];
			unset($_SESSION['add_brand']['res']);
		}?>
		<form action="" method="post">
			<table class="edit_data">
				<tr>
					<td>Название категории:</td>
					<td><input type="text" name="brand_name"></td>
				</tr>
				<tr>
					<td>Родительская категория</td>
					<td>
						<select name="parent_id" class="select_parent_id">
							<option value="0">Самостоятельная категория</option>
							<?php foreach($cat as $key => $value): ?>
							<option value="<?=$key?>"><?=$value[0]?></option>
							<?php endforeach; ?>
						</select>
					</td>
				</tr>
				<tr>
					<td>Ключевые слова (keywords):</td>
					<td><input type="text" name="keywords" value=""></td>
				</tr>
				<tr>
					<td>Мета описание (description):</td>
					<td><input type="text" name="description" value=""></td>
				</tr>
			</table>
			<input type="submit" name="submit" value="Добавить">
		</form>
		<?php unset($_SESSION['add_brand'])?>
	</div>
</div>