<?php defined('SHOP') or die('Access Denied');
$cat = $this->m->catalog()?>
<aside id="leftbar">
	<form action="" method="get" class="search">
		<input type="text" name="search">
		<input type="submit" value="">
	</form>
	<nav>
		<ul class="nav-left">
			<li><a href="?view=orders">Заказы</a></li>
			<li><a href="?view=brands">Каталог товаров</a></li>
			<li><a href="#" class="catalog_admin">Товары</a>
				<ul class="categories">
				<?php foreach($cat as $key => $item): // Если это родительская категория ?>
					<?php if(count($item) > 1): ?>
					<li class="header_li"><a href="#"> &nbsp;<?=$item[0]?></a></li>
					<ul class="podcategories">
						<li><a href="?view=cat&amp;category=<?=$key?>"> Все модели</a></li>
						<?php foreach($item['sub'] as $key => $sub): ?>
						<li><a href="?view=cat&amp;category=<?=$key?>"> <?=$sub?></a></li>
						<?php endforeach; ?>
					</ul>
					<?php elseif($item[0]): // Если самостоятельная категория ?>
					<li><a href="?view=cat&amp;category=<?=$key?>"><?=$item[0]?></a></li>
					<?php endif; ?>
				<?php endforeach; ?>
				</ul>
			</li>
			<li><a href="?view=informers">Информеры</a></li>
			<li><a href="?view=news">Новости</a></li>
			<li><a href="?view=users">Пользователи</a></li>
			<li><a href="?view=other">Разное</a></li>
		</ul>
	</nav>
</aside>