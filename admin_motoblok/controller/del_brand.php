<?php
defined('SHOP') or die('Access Denied');
class del_brand extends Core_Admin {
	public function get_content() {
		if(isset($_GET['brand_id'])) $brand_id = (int)$_GET['brand_id'];
		$this->m->del_brand($brand_id);
		$this->f->redirect();
	}
}