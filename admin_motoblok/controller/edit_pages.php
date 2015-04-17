<?php
defined('SHOP') or die('Access Denied');
class edit_pages extends Core_Admin {
	public function get_content() {
		$pages = $this->m->edit_pages();
		return $pages;
	}
}
?>