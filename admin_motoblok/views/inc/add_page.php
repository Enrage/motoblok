<?php defined('SHOP') or die('Access Denied');
$pages = $this->session_pages();
$this->get_content()?>
<div id="content">
	<div id="container">
		<h2>Добавление страницы</h2>
		<?php
		if(isset($_SESSION['add_page']['res'])) {
			print $_SESSION['add_page']['res'];
			unset($_SESSION['add_page']['res']);
		}?>
		<form action="" method="post">
			<table class="edit_data">
				<tr>
					<td>Название страницы:</td>
					<td><input type="text" name="title"></td>
				</tr>
				<tr>
					<td>Позиция страницы:</td>
					<td><input type="text" name="position" value="<?=$pages[0]?>"></td>
				</tr>
				<tr>
					<td>Ключевые слова (keywords):</td>
					<td><input type="text" name="keywords" value="<?=$pages[1]?>"></td>
				</tr>
				<tr>
					<td>Мета описание (description):</td>
					<td><input type="text" name="description" value="<?=$pages[2]?>"></td>
				</tr>
				<tr>
					<td>Содержание страницы:</td>
					<td></td>
				</tr>
				<tr>
					<td colspan="2">
						<textarea name="text"><?=$pages[3]?></textarea>
					</td>
				</tr>
			</table>
			<input type="submit" name="submit" value="Сохранить">
		</form>
		<?php unset($_SESSION['add_page'])?>
	</div>
</div>
</div>