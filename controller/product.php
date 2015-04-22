<?php
defined('SHOP') or die('Access Denied');
class product extends Core {
	public function get_content() {
		if(isset($_GET['goods_id'])) {
			$goods_id = abs((int)$_GET['goods_id']);
			$goods = $this->m->get_goods($goods_id);
		} else $goods = null;
		return $goods;
	}
	protected function bread() {
		if(isset($_GET['goods_id'])) {
			$goods = $this->get_content();
			$brandname = $this->m->brand_name($goods[0]['goods_brandid']);
		} else $brandname = null;
		return $brandname;
	}
}
?>