<?php defined('SHOP') or die('Access Denied')?>
<div id="content_informer">
	<div id="container">
		<section class="informer">
			<?php if(!empty($content)): ?>
			<h3><?=$content[0]['link_name']?></h3>
			<?=$content[0]['text']?>
			<?php else: ?>
			<p>Такой страницы нет!</p>
			<?php endif; ?>
		</section>
	</div> <!-- #container -->
</div> <!-- #content -->