<?php defined('SHOP') or die('Access Denied');
$cat = $this->m->catalog()?>
<!-- Menu Categories -->
<nav id="cat_top_menu">
	<ul>
	<?php foreach($cat as $key => $item): // Если это родительская категория ?>
		<?php if(count($item) > 1): ?>
		<li class="main_cat"><a href="?view=cat&amp;category=<?=$key?>"><?=$item[0]?></a>
			<ul>
				<?php foreach($item['sub'] as $key => $sub): ?>
				<li><a href="?view=cat&amp;category=<?=$key?>"><?=$sub?></a></li>
				<?php endforeach; ?>
			</ul>
		</li>
		<?php elseif($item[0]): // Если самостоятельная категория ?>
		<li class="main_cat"><a href="?view=cat&amp;category=<?=$key?>"><?=$item[0]?></a></li>
		<?php endif; ?>
	<?php endforeach; ?>
	</ul>
</nav> <!-- #cat_top_menu -->
<div id="main">