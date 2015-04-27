<?php
defined('SHOP') or die('Access Denied');
class archive_news extends Core {
	public function get_content() {
		$all_news = $this->m->get_all_news();
		return $all_news;
	}
}
?>