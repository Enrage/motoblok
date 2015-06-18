<?php defined('SHOP') or die('Access Denied');
$pos = $this->pos();?>
<div id="content">
	<div id="container">
		<h3>Заказы <span class="small">(необработанные заказы подсвечены)</span></h3>
		<?php
		if(isset($_SESSION['answer'])) {
			print $_SESSION['answer'];
			unset($_SESSION['answer']);
		}?>
		<?php if(isset($content)): ?>
		<table class="tabl" cellspacing="1" bgcolor="#999">
			<tr>
				<th class="number">№ заказа</th>
				<th class="str_name">Покупатель</th>
				<th class="str_sort">Дата</th>
				<th class="str_action">Просмотр</th>
			</tr>
			<?php foreach($content as $item): ?>
			<tr <?php if($item['status'] == 0) echo 'class="highlight"'; ?>>
				<td><?=$item['order_id']?></td>
				<td class="name_page"><?=$item['name']?></td>
				<td><?=$item['date']?></td>
				<td><a href="?view=show_order&amp;order_id=<?=$item['order_id']?>" class="edit">Просмотреть</a></td>
			</tr>
			<?php endforeach; ?>
		</table>

		<div class="pagination">
		<?php if($pos['pages_count'] > 1) $this->f->pagination($pos['page'], $pos['pages_count']); ?>
		</div>
		<?php else: ?>
			<div class="error">Нет необработанных заказов</div>
		<?php endif; ?>
	</div> <!-- #container -->
</div> <!-- #content -->