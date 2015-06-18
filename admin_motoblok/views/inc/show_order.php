<?php defined('SHOP') or die('Access Denied');
$order = $this->state();?>
<div id="content">
	<div id="container">
	<?php // $this->f->print_arr($content) ?>
		<?php if(isset($content[0])): ?>
		<h3>Заказ № <?=$content[0]['order']?> (<?=$order?>)</h3>

		<table class="tabl">
			<tr>
				<th>№</th>
				<th>Название товара</th>
				<th>Цена</th>
				<th>Количество</th>
			</tr>
			<?php $i = 1; $total_sum = 0; ?>
			<?php foreach($content as $item): ?>
			<tr>
				<td><?=$i?></td>
				<td class="name_page"><?=$item['name']?></td>
				<td><?=$item['price']?></td>
				<td><?=$item['quantity']?></td>
			</tr>
			<?php $i++; $total_sum += $item['price'] * $item['quantity']; ?>
			<?php endforeach; ?>
		</table> <!-- .tabl -->

		<h4>Общая цена заказа: <span style="color:#b00;"><?=$total_sum;?></span> руб.</h4>

		<h4>Дата заказа: <span style="color:#b00;"><?=$item['date'];?></span></h4>

		<h4>Способ доставки: <span style="color:#b00;"><?=$item['sposob'];?></span></h4>

		<h3>Данные покупателя:</h3>
		<table class="tabl">
			<tr>
				<th>ФИО</th>
				<th>Адрес</th>
				<th>Для связи</th>
				<th>Примечание</th>
			</tr>
			<tr>
				<td><?=$item['customer']?></td>
				<td><?=$item['address']?></td>
				<td class="email_page">E-mail: <a href="mailto:<?=$item['email']?>" class="edit"><?=$item['email']?></a><br>Телефон: <span><?=$item['phone']?></span></td>
				<td><?=$item['prim']?></td>
			</tr>
		</table>
		<br><br>
		<p>
			<?php if($content[0]['status'] == 0): ?>
			<a href="?view=orders&amp;confirm=<?=$content[0]['order']?>" class="edit">Подтвердить заказ</a>&nbsp; |
			<?php endif; ?>
			&nbsp; <a href="" class="del">Удалить заказ</a></p>
		<?php else: ?>
			<div class="error">Заказа с таким номером нет</div>
		<?php endif; ?>
	</div> <!-- #container -->
</div> <!-- #content -->