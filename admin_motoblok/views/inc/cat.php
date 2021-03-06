<?php defined('SHOP') or die('Access Denied');
$pos = $this->pos();
$bread = $this->bread_crumbs()?>
<div id="content">
	<div id="container">
		<div class="kroshka">
		<?php if(count($bread) > 1): // Если подкатегория ?>
			<a href="<?=PATH?>admin_motoblok/">Главная</a> >> <a href="?view=cat&amp;category=<?=$bread[0]['brand_id']?>"><?=$bread[0]['brand_name']?></a> >> <span><?=$bread[1]['brand_name']?></span>
		<?php elseif(count($bread) == 1): // Если не дочерняя категория ?>
			<a href="<?=PATH?>admin_motoblok/">Главная</a> >> <span><?=$bread[0]['brand_name']?></span>
		<?php endif; ?>
		</div> <!-- .kroshka -->

		<h3>Список товаров</h3>
		<?php
			if(isset($_SESSION['answer'])) {
				print $_SESSION['answer'];
				unset($_SESSION['answer']);
		}?>
		<?php if(count($bread) > 1): ?>
		<a class="add" href="?view=add_product&amp;brand_id=<?=$bread[1]['brand_id']?>">Добавить товар</a>
		<?php else: ?>
		<a class="add" href="?view=add_product&amp;brand_id=<?=$bread[0]['brand_id']?>">Добавить товар</a>
		<?php endif; ?>
		<?php if(isset($content)): ?>
		<?php
		$col = 4; // Кол-во ячеек в строке
		$row = ceil(count($content) / $col); // Кол-во рядов
		$start = 0;
		?>
		<table class="edit_product" cellspacing="1" bgcolor="#666">
		<?php for($i = 0; $i < $row; $i++): // Цикл вывода рядов ?>
			<tr>
			<?php for($j = 0; $j < $col; $j++): // Цикл вывода ячеек ?>
				<td>
					<?php if(isset($content[$start])): // Если есть товар ?>
					<h4><a href="?view=edit_product&amp;goods_id=<?=$content[$start]['goods_id']?>"><?=$content[$start]['name']?></a></h4>
					<p><a href="?view=edit_product&amp;goods_id=<?=$content[$start]['goods_id']?>"><img src="<?=PRODUCT.$content[$start]['img']?>" alt="<?=$content[$start]['name']?>"></a></p>
					<p class="cat_price">цена: <span><?=$content[$start]['price']?></span> руб.</p>
					<div><a href="?del_product&amp;goods_id=<?=$content[$start]['goods_id']?>" class="del"><img src="<?=ADMIN_TPL?>img/delete.jpg" alt="Удалить товар" width="15">Удалить</a></div>
					<?php else: // Если нет товара ?>
					&nbsp;
				</td>
					<?php endif; ?>
				<?php $start++; ?>
			<?php endfor; ?>
			</tr>
		<?php endfor; ?>
		</table>
		<?php else: // Если нет товаров ?>
			Здесь товаров нет!
		<?php endif; ?>
		<div class="clr"></div>
		<div class="pagination">
		<?php if($pos['pages_count'] > 1) $this->f->pagination($pos['page'], $pos['pages_count']); ?>
		</div>
	</div>
</div>