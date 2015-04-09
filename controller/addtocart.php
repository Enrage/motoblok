<?php
defined('SHOP') or die('Access Denied');
class addtocart extends Core {
	public function get_content() {
		if(isset($_GET['goods_id'])) $goods_id = abs((int)$_GET['goods_id']);
		$this->f->addtocart($goods_id);
		$_SESSION['total_sum'] = $this->m->total_sum($_SESSION['cart']);
		// Кол-во товара в корзине + защита от ввода несуществующего id товара
		$this->f->total_quantity();
	}
}
?>