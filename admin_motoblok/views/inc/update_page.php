<?php defined('SHOP') or die('Access Denied');
$page = $this->update_page_text();?>
<div id="content">
	<div id="container">
		<h2>Редактирование страницы</h2>
		<?php
		if(isset($_SESSION['edit_page']['res'])) {
			print $_SESSION['edit_page']['res'];
			unset($_SESSION['edit_page']['res']);
		}?>
		<form action="" method="post">
			<table class="edit_data">
				<tr>
					<td>Название страницы:</td>
					<td><input type="text" name="title" value="<?=htmlspecialchars($page[0]['title'])?>"></td>
				</tr>
				<tr>
					<td>Позиция страницы:</td>
					<td><input type="text" name="position" value="<?=$page[0]['position']?>"></td>
				</tr>
				<tr>
					<td>Ключевые слова (keywords):</td>
					<td><input type="text" name="keywords" value="<?=htmlspecialchars($page[0]['keywords'])?>"></td>
				</tr>
				<tr>
					<td>Мета описание (description):</td>
					<td><input type="text" name="description" value="<?=htmlspecialchars($page[0]['description'])?>"></td>
				</tr>
				<tr>
					<td>Содержание страницы:</td>
					<td></td>
				</tr>
				<tr>
					<td colspan="2">
						<textarea name="text"><?=$page[0]['text']?></textarea>
					</td>
				</tr>
			</table>
			<input type="submit" name="submit" value="Сохранить">
		</form>
	</div>
</div>
</div>