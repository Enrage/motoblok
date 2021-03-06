<?php defined('SHOP') or die('Access Denied');
$pos = $this->pos();
$sort = $this->sort();
$bread = $this->bread_crumbs()?>
<!-- Content -->
<div id="content_grid">
	<div id="container_grid">
		<section id="products_grid">

			<div class="kroshka">
			<?php if(count($bread) > 1): // Если подкатегория ?>
				<a href="<?=PATH?>">Главная</a> >> <a href="?view=cat&amp;category=<?=$bread[0]['brand_id']?>"><?=$bread[0]['brand_name']?></a> >> <span><?=$bread[1]['brand_name']?></span>
			<?php elseif(count($bread) == 1): // Если не дочерняя категория ?>
				<a href="<?=PATH?>">Главная</a> >> <span><?=$bread[0]['brand_name']?></span>
			<?php endif; ?>
			</div> <!-- .kroshka -->
			<!-- Вид и сортировка -->
			<div class="view-sort">
				Вид:
				<a href="#" class="grid_list" id="grid"><img src="<?=TEMPLATE?>img/view-table.gif" width="16" title="табличный вид" alt="табличный вид"></a>
				<a href="#" class="grid_list" id="list"><img src="<?=TEMPLATE?>img/view-line.gif" width="16" title="линейный вид" alt="линейный вид"></a>

				&nbsp;&nbsp;
				Сортировать по:&nbsp;
				<a href="#" id="param_order" class="sort-top"><?=$sort['order']?></a>
				<div class="sort-wrap">
				<?php foreach($sort['order_p'] as $key => $value): ?>
					<?php if($value[0] == $sort['order']) continue; ?>
					<a href="?view=cat&amp;category=<?=$pos['category']?>&amp;order=<?=$key?>&amp;page=<?=$pos['page']?>" class="sort-bot"><?=$value[0]?></a>
				<?php endforeach; ?>
				</div>
			</div>

			<?php if(!empty($content) && isset($_GET['category'])): // Если получены товары категории ?>
			<?php foreach($content as $product): ?>
			<?php if(!isset($_COOKIE['display']) OR $_COOKIE['display'] == 'grid'): // Если вид сетка ?>
			<section class="product_grid">
				<article>
					<h2><a href="?view=product&amp;goods_id=<?=$product['goods_id']?>"><?=$product['name']?></a></h2>
					<a href="?view=product&amp;goods_id=<?=$product['goods_id']?>" class="product_img"><img src="<?=PRODUCT?><?=$product['img']?>" alt="<?=$product['name']?>"></a>
					<p class="price"><span class="id_<?=$product['goods_id']?>"><?=$product['price']?></span> руб.</p>
					<div class="img_new"> <!-- Иконка новинка -->
						<?php if($product['news']) { ?>
						<img src="<?=TEMPLATE?>img/new.png" alt="новинка" width="50">
						<?php } ?>
					</div>
					<a class="addtocart" id="<?=$product['goods_id']?>" href="?view=addtocart&amp;goods_id=<?=$product['goods_id']?>">В корзину</a>
				</article>
			</section> <!-- .product_grid -->
			<?php else: // Если линейный вид ?>
			<section class="product_line">
				<article>
					<a href="?view=product&amp;goods_id=<?=$product['goods_id']?>" class="product_img_line"><img src="<?=PRODUCT?><?=$product['img']?>" width="80" alt="<?=$product['name']?>"></a>
					<h2><a href="?view=product&amp;goods_id=<?=$product['goods_id']?>"><?=$product['name']?></a></h2>
					<div class="description"><?=$product['anons']?></div>
					<p class="price"><span class="id_<?=$product['goods_id']?>"><?=$product['price']?></span> руб.</p>
					<div> <!-- Иконки -->
						<?php if($product['news']) { ?>
						<img src="<?=TEMPLATE?>img/new.png" alt="новинка" width="40">
						<?php } ?>
					</div>
					<a href="?view=product&amp;goods_id=<?=$product['goods_id']?>" class="more">Подробнее</a>
					<a class="addtocart" id="<?=$product['goods_id']?>" href="?view=addtocart&amp;goods_id=<?=$product['goods_id']?>">В корзину</a>
				</article>
			</section>
			<?php endif; // Переключатель видов ?>
			<?php endforeach; // products ?>
			<div class="clr"></div>
			<div class="pagination">
			<?php if($pos['pages_count'] > 1) $this->f->pagination($pos['page'], $pos['pages_count']); ?>
			</div>
			<?php else: ?>
			<article class="no_product">
				<p>Здесь товаров пока нет.</p>
			</article>
			<?php endif; // products ?>
		</section> <!-- #products_grid -->
	</div> <!-- #container_grid -->
</div> <!-- #content_grid -->