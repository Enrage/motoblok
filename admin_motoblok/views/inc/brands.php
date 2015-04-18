<?php defined('SHOP') or die('Access Denied');
//$this->f->print_arr($content)?>
<div id="content">
	<div id="container">
		<h3>Список категорий товаров</h3>
		<p class="add"><a href="?view=add_brand">Добавить категорию</a></p>
		<?php
		if(isset($_SESSION['add_brand']['res'])) {
			print $_SESSION['add_brand']['res'];
			unset($_SESSION['add_brand']['res']);
		}?>
		<table class="tabl" cellspacing="1">
			<tr>
				<th class="number">№</th>
				<th class="str_name">Название каегории товара</th>
				<th class="str_action">Действие</th>
			</tr>
			<?php $i = 1; ?>
			<?php if(!empty($content)): ?>
			<?php foreach($content as $key => $value): ?>
			<tr>
				<td><?=$i?></td>
				<td class="name_page"><?=$value[0]?></td>
				<td><a href="?view=edit_brand&amp;brand_id=<?=$key?>" class="edit">изменить</a>&nbsp; | &nbsp;<a href="?view=delete_brand&amp;brand_id=<?=$key?>" class="del">удалить</a></td>
			</tr>
			<?php $i++; ?>
			<?php endforeach; ?>
			<?php endif; ?>
		</table>
	</div>
</div>