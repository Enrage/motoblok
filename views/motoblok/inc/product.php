<?php defined('SHOP') or die('Access Denied');
$bread = $this->bread()?>
<div id="content_product">
	<div id="container_product">
		<?php if(isset($content)): ?>
		<section id="product">
			<div class="kroshka">
				<?php if(count($bread) > 1): // Если подкатегория ?>
				<a href="<?=PATH?>">Главная</a> >> <a href="?view=cat&amp;category=<?=$bread[0]['brand_id']?>"><?=$bread[0]['brand_name']?></a> >> <a href="?view=cat&amp;category=<?=$bread[1]['brand_id']?>"><?=$bread[1]['brand_name']?></a> >> <span><?=$content[0]['name']?></span>
				<?php elseif(count($bread) == 1): // Если не дочерняя категория ?>
				<a href="<?=PATH?>">Главная</a> >> <a href="?view=cat&amp;category=<?=$bread[0]['brand_id']?>"><?=$bread[0]['brand_name']?></a> >> <span><?=$content[0]['name']?></span>
				<?php endif; ?>
			</div> <!-- .kroshka -->

			<div class="detail_img">
				<a href="<?=PRODUCT.$content[0]['img']?>" rel="group"><img src="<?=PRODUCT.$content[0]['img']?>" width="255" alt="<?=$content[0]['name']?>" class="detail_img_large"></a>
				<?php if(!empty($content[0]['img_slide'])): // Если есть картинки галереи ?>
				<div class="detail_img_small">
					<?php foreach($content['img_slide'] as $item): ?>
					<div class="small_img">
						<a rel="group" title="<?=$content[0]['name']?>" href="<?=PRODUCT_PHOTOS.$item?>"><img src="<?=PRODUCT_THUMBS.$item?>" width="60" alt="<?=$content[0]['name']?>"></a>
					</div>
					<?php endforeach; ?>
				</div> <!-- .detail_img_small -->
				<?php endif; ?>
			</div> <!-- .detail_img -->
			<h2><?=$content[0]['name']?></h2>
			<!-- <table class="detail_info">
				<tr>
					<td>Двигатель:</td>
					<td>Honda GX200 (Япония)</td>
				</tr>
				<tr>
					<td>Тип двигателя:</td>
					<td>четырехтактный одноцилиндровый</td>
				</tr>
				<tr>
					<td>Рабочий объем, куб.см:</td>
					<td>196</td>
				</tr>
				<tr>
					<td>Макс. мощность, л.с:</td>
					<td>6.5</td>
				</tr>
				<tr>
					<td>Тип топлива:</td>
					<td>АИ-92</td>
				</tr>
				<tr>
					<td>Емкость топливного бака, л:</td>
					<td>3.6</td>
				</tr>
				<tr>
					<td>Сцепление:</td>
					<td>Ременное</td>
				</tr>
				<tr>
					<td>Редуктор:</td>
					<td>Шестеренчатый</td>
				</tr>
				<tr>
					<td>Количество передач:</td>
					<td>2+1</td>
				</tr>
				<tr>
					<td>Ширина культивации (базовая), мм:</td>
					<td>730</td>
				</tr>
				<tr>
					<td>Глубина культивации, мм:</td>
					<td>до 300</td>
				</tr>
				<tr>
					<td>В комплекте:</td>
					<td>4 фрезы, удлинители грунтозацепов, опорные колеса, сошник</td>
				</tr>
				<tr>
					<td>Габаритные размеры в рабочем состоянии, мм:</td>
					<td>1550 х 730 х 1300</td>
				</tr>
				<tr>
					<td>Сухая масса, кг:</td>
					<td>67</td>
				</tr>
				<tr>
					<td>Производитель:</td>
					<td>Мобил К, г. Гагарин</td>
				</tr>
				<tr>
					<td>Гарантия:</td>
					<td>1 год от производителя + расширенная</td>
				</tr>
			</table> --> <!-- .detail_info -->
			<div class="detail_info">
				<?=$content[0]['content']?>
			</div>
			<div class="detail_price">
				<p class="price"><span class="id_<?=$content[0]['goods_id']?>"><?=$content[0]['price']?></span> руб.</p>
			</div>
			<a href="?view=addtocart&amp;goods_id=<?=$content[0]['goods_id']?>" class="addtocart cart_product" id="<?=$content[0]['goods_id']?>">Купить</a>
			<div class="clr"></div>
			<div id="add_desc">
				<ul id="tabs">
					<li id="one_tab" class="selected_tab"><a href="#one" onclick="One(); return false;">Описание</a></li>
					<li id="two_tab" class="tab"><a href="#two" onclick="Two(); return false;">Мы рекомендуем</a></li>
					<li id="three_tab" class="tab"><a href="#three" onclick="Three(); return false;">Гарантия и сервис</a></li>
					<li id="four_tab" class="tab"><a href="#four" onclick="Four(); return false;">Совместимость</a></li>
				</ul>
				<div id="content_tabs">
					<div id="one">
						<p>Подробное описание товара.</p>
					</div>
					<div id="two" style="display: none;">
						<p>Рекомендуемые товары.</p>
					</div>
					<div id="three" style="display: none;">
						<p>Здесть будет текст гарантия и сервис.</p>
					</div>
					<div id="four" style="display: none;">
						<p>Текст совместимость.</p>
					</div>
				</div> <!-- #content_tabs -->
			</div> <!-- .add_desc -->
		</section> <!-- #product -->
		<?php else: // Если такого товара нет ?>
			<div class="error">Такого товара нет!</div>
		<?php endif; ?>
	</div> <!-- #container_product -->
</div> <!-- #content_product -->