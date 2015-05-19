<?php defined('SHOP') or die('Access Denied')?>
<div id="content_informer">
	<div id="container">
		<section class="informer">
			<?php if(!empty($content)): ?>
			<h3><?=$content[0]['title']?></h3>
			<p class="news_date"><?=$content[0]['date']?></p>
			<?=$content[0]['text']?>
			<?php else: ?>
			<p>Такой страницы нет!</p>
			<?php endif; ?>
		</section>
	</div> <!-- #container -->
</div> <!-- #content -->