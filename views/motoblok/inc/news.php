<?php defined('SHOP') or die('Access Denied');
$eyestoppers = $this->get_content()?>
<!-- Content -->
<div id="content_grid">
	<div id="container_grid">
		<section id="products_grid">
			<section class="product_grid">
				<h3>Новинки</h3>
				<?php if(isset($eyestoppers)): ?>
				<?php foreach($eyestoppers as $item): ?>
				<article>
					<h2><a href="?view=product&amp;goods_id=<?=$item['goods_id']?>"><?=$item['name']?></a></h2>
					<a href="?view=product&amp;goods_id=<?=$item['goods_id']?>" class="product_img"><img src="<?=PRODUCT?><?=$item['img']?>" width="140" alt="<?=$item['name']?>"></a>
					<p class="price"><span class="id_<?=$item['goods_id']?>"><?=$item['price']?></span> руб.</p>
					<a href="?view=addtocart&amp;goods_id=<?=$item['goods_id']?>" class="addtocart" id="<?=$item['goods_id']?>">В корзину</a>
				</article>
				<?php endforeach; ?>
				<?php else: ?>
					<p>Здесь товаров пока нет!</p>
				<?php endif; ?>
			</section> <!-- .product_grid -->
		</section> <!-- #products_grid -->
	</div> <!-- #container_grid -->
</div> <!-- #content_grid -->