<?php defined('SHOP') or die('Access Denied')?>
<div id="content">
	<div id="container">
		<h3>Список категорий товаров</h3>
		<p class="add"><a href="?view=add_brand">Добавить категорию</a></p>
		<?php
		if(isset($_SESSION['answer'])) {
			print $_SESSION['answer'];
			unset($_SESSION['answer']);
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
				<td class="name_page">
					<a href="?view=edit_brand&amp;brand_id=<?=$key?>"><?=$value[0]?></a><br>
					<ul>
						<?php if(isset($value['sub'])): ?>
						<?php foreach($value['sub'] as $res => $item): ?>
						<li class="subcat">- <a href="?view=edit_brand&amp;brand_id=<?=$res?>"><?=$item?></a></li>
						<?php endforeach; ?>
						<?php endif; ?>
					</ul>
				</td>
				<td><a href="?view=edit_brand&amp;brand_id=<?=$key?>" class="edit">изменить</a>&nbsp; | &nbsp;<a href="?view=del_brand&amp;brand_id=<?=$key?>" class="del">удалить</a></td>
			</tr>
			<?php $i++; ?>
			<?php endforeach; ?>
			<?php endif; ?>
		</table>
	</div>
</div>