<?php defined('SHOP') or die('Access Denied')?>
<div id="content">
	<div id="container">
		<p class="add"><a href="?view=add_page">Добавить</a></p>
		<?php
		if(isset($_SESSION['answer'])) {
			print $_SESSION['answer'];
			unset($_SESSION['answer']);
		}?>
		<table class="tabl" cellspacing="1">
			<tr>
				<th class="number">№</th>
				<th class="str_name">Название страницы</th>
				<th class="str_sort">Сортировка</th>
				<th class="str_action">Действие</th>
			</tr>
			<?php $i = 1; ?>
			<?php if(!empty($content)): ?>
			<?php foreach($content as $item): ?>
			<tr>
				<td><?=$i?></td>
				<td class="name_page"><?=$item['title']?></td>
				<td><?=$item['position']?></td>
				<td><a href="?view=update_page&amp;page_id=<?=$item['page_id']?>" class="edit">изменить</a>&nbsp; | &nbsp;<a href="#" class="del">удалить</a></td>
			</tr>
			<?php $i++; ?>
			<?php endforeach; ?>
			<?php endif; ?>
		</table>
	</div>
</div>