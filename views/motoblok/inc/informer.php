<?php defined('SHOP') or die('Access Denied');
$text_informer = $this->get_content()?>
<div id="content_informer">
	<div id="container">
		<section class="informer">
			<?php if(!empty($text_informer)): ?>
			<h3><?=$text_informer[0]['link_name']?></h3>
			<?=$text_informer[0]['text']?>
			<?php else: ?>
			<p>Такой страницы нет!</p>
			<?php endif; ?>
		</section>
	</div> <!-- #container -->
</div> <!-- #content -->