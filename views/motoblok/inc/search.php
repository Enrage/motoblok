<?php defined('SHOP') or die('Access Denied');
$pos = $this->pos()?>
<!-- Content -->
<div id="content_grid">
	<div id="container_grid">
		<section id="products_grid">
			<h3>Результаты поиска</h3>
			<?php if(isset($content['notfound'])): // Если ничего не найдено ?>
			<?php print $content['notfound'];?>
			<?php else: ?>
			<section class="product_grid">
				<?php for($i = $pos['start_pos']; $i < $pos['end_pos']; $i++): ?>
				<article>
					<h2><a href="?view=product&amp;goods_id=<?=$content[$i]['goods_id']?>"><?=$content[$i]['name']?></a></h2>
					<a href="?view=product&amp;goods_id=<?=$content[$i]['goods_id']?>" class="product_img"><img src="<?=PRODUCT?><?=$content[$i]['img']?>" width="140" alt="<?=$content[$i]['name']?>"></a>
					<p class="price"><span class="id_<?=$content[$i]['goods_id']?>"><?=$content[$i]['price']?></span> руб.</p>
					<div> <!-- Иконка новинка -->
						<?php if($content[$i]['news']) { ?>
						<img src="<?=TEMPLATE?>img/new.png" alt="новинка" width="60">
						<?php } ?>
					</div>
					<a href="?view=addtocart&amp;goods_id=<?=$content[$i]['goods_id']?>" class="addtocart" id="<?=$content[$i]['goods_id']?>">В корзину</a>
				</article>
				<?php endfor; ?>
			</section> <!-- .product_grid -->
			<div class="clr"></div>
			<div class="pagination">
			<?php if($pos['pages_count'] > 1) $this->f->pagination($pos['page'], $pos['pages_count']); ?>
			</div>
			<?php endif; ?>
		</section> <!-- #products_grid -->
	</div> <!-- #container_grid -->
</div> <!-- #content_grid -->