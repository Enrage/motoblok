<?php defined('SHOP') or die('Access Denied');
$goods = $this->get_content();
$bread = $this->bread()?>
<div id="content_product">
	<div id="container_product">
		<?php if(isset($goods)): ?>
		<section id="product">
			<div class="kroshka">
				<?php if(count($bread) > 1): // Если подкатегория ?>
				<a href="<?=PATH?>">Главная</a> >> <a href="?view=cat&amp;category=<?=$bread[0]['brand_id']?>"><?=$bread[0]['brand_name']?></a> >> <a href="?view=cat&amp;category=<?=$bread[1]['brand_id']?>"><?=$bread[1]['brand_name']?></a> >> <span><?=$goods[0]['name']?></span>
				<?php elseif(count($bread) == 1): // Если не дочерняя категория ?>
				<a href="<?=PATH?>">Главная</a> >> <a href="?view=cat&amp;category=<?=$bread[0]['brand_id']?>"><?=$bread[0]['brand_name']?></a> >> <span><?=$goods[0]['name']?></span>
				<?php endif; ?>
			</div> <!-- .kroshka -->

			<div class="detail_img">
				<a href="<?=PRODUCT?><?=$goods[0]['img']?>" rel="group"><img src="<?=PRODUCT?><?=$goods[0]['img']?>" width="255" alt="<?=$goods[0]['name']?>" class="detail_img_large"></a>
				<?php if(!empty($goods[0]['img_slide'])): // Если есть картинки галереи ?>
				<div class="detail_img_small">
					<?php foreach($goods['img_slide'] as $item): ?>
					<a rel="group" href="<?=PRODUCT?><?=$item?>"><img src="<?=PRODUCT?><?=$item?>" width="60" alt="<?=$goods[0]['name']?>"></a>
					<?php endforeach; ?>
				</div> <!-- .detail_img_small -->
				<?php endif; ?>
			</div> <!-- .detail_img -->
			<h2><?=$goods[0]['name']?></h2>
			<table class="detail_info">
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
			</table> <!-- .detail_info -->
			<div class="detail_price">
				<p class="price"><span class="id_<?=$goods[0]['goods_id']?>"><?=$goods[0]['price']?></span> руб.<a href="?view=addtocart&amp;goods_id=<?=$goods[0]['goods_id']?>" class="addtocart" id="<?=$goods[0]['goods_id']?>">Купить</a></p>
			</div>
			<div id="add_desc">
				<ul id="tabs">
					<li id="one_tab" class="selected_tab"><a href="#one" onclick="One(); return false;">Описание</a></li>
					<li id="two_tab" class="tab"><a href="#two" onclick="Two(); return false;">Мы рекомендуем</a></li>
					<li id="three_tab" class="tab"><a href="#three" onclick="Three(); return false;">Гарантия и сервис</a></li>
					<li id="four_tab" class="tab"><a href="#four" onclick="Four(); return false;">Совместимость</a></li>
				</ul>
				<div id="content_tabs">
					<div id="one">
						Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
						tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
						quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
						Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
						tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
						quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
						consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
						cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
						proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
					</div>
					<div id="two" style="display: none;">
						<p>mod
							tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
							quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo</p>
							<p>m ad minim veniam,
							quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
							consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
							cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
							proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
					</div>
					<div id="three" style="display: none;">
						<p> ea commodo</p>
					</div>
					<div id="four" style="display: none;">
						<p>dolor sit amet, consectetur
							quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo</p>
							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
							tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
							quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
							consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
							cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
							proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
							tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
							quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
							consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
							cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
							proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
					</div>
				</div> <!-- #content_tabs -->
			</div> <!-- .add_desc -->
		</section> <!-- #product -->
		<?php else: // Если такого товара нет ?>
			<div class="error">Такого товара нет!</div>
		<?php endif; ?>
	</div> <!-- #container_product -->
</div> <!-- #content_product -->