<?php
defined('SHOP') or die('Access Denied');
class archive_news extends Core {
	public function get_content() {
		$pos = $this->pos();
		$all_news = $this->m->get_all_news($pos['start_pos'], $pos['perpage']);
		return $all_news;
	}

	protected function pos() {
		$perpage = PERPAGE_NEWS;
		if(isset($_GET['page'])) {
				$page = abs((int)$_GET['page']);
				if($page < 1) $page = 1;
		} else $page = 1;
		$count_news = $this->m->count_news();
		$pages_count = ceil($count_news / $perpage);
		if(empty($pages_count)) $pages_count = 1;
		if($page > $pages_count) $page = $pages_count;
		$start_pos = ($page - 1) * $perpage;
		$res['start_pos'] = $start_pos;
		$res['page'] = $page;
		$res['pages_count'] = $pages_count;
		$res['perpage'] = $perpage;
		return $res;
	}
}
?>