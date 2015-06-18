<?php
defined('SHOP') or die('Access Denied');
class show_order extends Core_Admin {
	public function get_content() {
		if(isset($_GET['order_id'])) $order_id = (int)$_GET['order_id'];
		$show_order = $this->m->show_order($order_id);
		return $show_order;
	}
	protected function state() {
		$order = $this->get_content();
		if($order[0]['status']) {
			$state = 'обработан';
		} else {
			$state = 'не обработан';
		}
		return $state;
	}
}
?>