<?php
defined('SHOP') or die('Access Denied');
class search extends Core {
	public function get_content() {
		$search = $this->m->search();
		return $search;
	}
	protected function pos() {
		$result_search = $this->m->search();
		$perpage = PERPAGE;
		if(isset($_GET['page'])) {
			$page = (int)$_GET['page'];
			if($page < 1) $page = 1;
		} else $page = 1;
		$count_rows = count($result_search);
		$pages_count = ceil($count_rows / $perpage);
		if(empty($pages_count)) $pages_count = 1;
		if($page > $pages_count) $page = $pages_count;
		$start_pos = ($page - 1) * $perpage;
		$end_pos = $start_pos + $perpage;
		if($end_pos > $count_rows) $end_pos = $count_rows;
		$result['start_pos'] = $start_pos;
		$result['end_pos'] = $end_pos;
		$result['page'] = $page;
		$result['pages_count'] = $pages_count;
		return $result;
	}
}
?>