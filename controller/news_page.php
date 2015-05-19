<?php
defined('SHOP') or die('Access Denied');
class news_page extends Core {
	public function get_content() {
		if(isset($_GET['news_id'])) $news_id = abs((int)$_GET['news_id']);
		$news_text = $this->m->get_news_text($news_id);
		return $news_text;
	}
}
?>