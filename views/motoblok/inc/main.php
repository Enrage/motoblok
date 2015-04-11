<?php defined('SHOP') or die('Access Denied');
$product = $this->get_content()?>
<div id="content">
	<div id="container">
		<section id="slider">
			<div class="slider slider3">
				<div class="sliderContent">
					<div class="item">
						<img src="<?=TEMPLATE?>slider/1.jpg" width="787" alt="">
					</div>
					<div class="item">
						<img src="<?=TEMPLATE?>slider/2.jpg" width="787" alt="">
					</div>
					<div class="item">
						<img src="<?=TEMPLATE?>slider/3.jpg" width="787" alt="">
					</div>
					<div class="item">
						<img src="<?=TEMPLATE?>slider/4.jpg" width="787" alt="">
					</div>
				</div>
			</div>
		</section>
		<section class="panel_offer">
			<article class="sales">
				<p class="name_sales">Хиты продаж</p>
				<p class="opis">Сделай правильную покупку</p>
				<img class="motoblok_pricep" src="<?=TEMPLATE?>img/motoblok_pricep.png" width="230" alt="Picture">
			</article>
			<article class="sales">
				<p class="name_sales">Спецпредложения</p>
				<p class="opis">Самое лучшее для себя</p>
				<img class="korzina" src="<?=TEMPLATE?>img/korzina.png" width="165" alt="Picture">
			</article>
			<article class="sales">
				<p class="name_sales">Благоустройство участка</p>
				<p class="opis">На зависть соседям</p>
				<img class="home" src="<?=TEMPLATE?>img/home.png" width="240" alt="Picture">
			</article>
		</section>
		<div id="products">
			<h4>Хиты продаж</h4>
			<section class="product">
				<?php if(isset($product)): ?>
				<?php foreach($product as $item): ?>
				<article>
					<h2><a href="?view=product&amp;goods_id=<?=$item['goods_id']?>"><?=$item['name']?></a></h2>
					<a href="?view=product&amp;goods_id=<?=$item['goods_id']?>" class="product_img"><img src="<?=PRODUCT?><?=$item['img']?>" width="130" alt="<?=$item['name']?>"></a>
					<p class="price"><span class="id_<?=$item['goods_id']?>"><?=$item['price']?></span> руб.</p>
					<a href="?view=addtocart&amp;goods_id=<?=$item['goods_id']?>" class="addtocart" id="<?=$item['goods_id']?>">В корзину</a>
				</article>
				<?php endforeach; ?>
				<?php endif; ?>
			</section> <!-- .product -->
		</div> <!-- #products -->
	</div> <!-- #container -->
</div> <!-- #content -->