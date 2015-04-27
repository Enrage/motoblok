<?php defined('SHOP') or die('Access Denied')?>
<div id="content_informer">
	<div id="container">
		<section class="informer">
		<?php if(!empty($content)): ?>
			<h2>Архив новостей</h2>
			<?php $i = 0; ?>
			<?php foreach($content as $item): ?>
			<h3><a href="?view=news_page&amp;news_id=<?=$item['news_id']?>"><?=$content[$i]['title']?></a></h3>
			<p class="news_date"><?=$item['date']?></p>
			<?=$content[$i]['anons']?>
			<p class="podrobnee"><a href="?view=news_page&amp;news_id=<?=$item['news_id']?>">Подробнее ...</a></p>
			<div class="hr"></div>
			<?php $i++; ?>
			<?php endforeach; ?>
		<?php else: ?>
			<p>Новостей пока нет!</p>
		<?php endif; ?>
		</section>
	</div> <!-- #container -->
</div> <!-- #content -->