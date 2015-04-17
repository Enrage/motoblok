<?php
defined('SHOP') or die('Access Denied');
class brands extends Core_Admin {
	public function get_content() {
		$cat = $this->m->catalog();
		return $cat;
	}
}
?>