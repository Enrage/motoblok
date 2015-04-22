<?php
defined('SHOP') or die('Access Denied');
class cat extends Core_Admin {
	public function get_content() {
		if(isset($_GET['category'])) {
			$category = abs((int)$_GET['category']);
			$perpage = ADM_PERPAGE;
			$pos = $this->pos();
			$res = $this->m->products($category, $pos['start_pos'], $perpage);
		} else $res = "<div class='error'>Нет такой категории!</div>";
		return $res;
	}

	protected function bread_crumbs() {
		if(isset($_GET['category'])) {
			$category = abs((int)$_GET['category']);
			$brand_name = $this->m->brand_name($category);
		} else $brand_name = null;
		return $brand_name;
	}

	protected function pos() {
		if(isset($_GET['category'])) {
			$category = abs((int)$_GET['category']);
			$perpage = ADM_PERPAGE;
			if(isset($_GET['page'])) {
				$page = abs((int)$_GET['page']);
				if($page < 1) $page = 1;
			} else $page = 1;
			$count_rows = $this->m->count_rows($category);
			$pages_count = ceil($count_rows / $perpage);
			if(empty($pages_count)) $pages_count = 1;
			if($page > $pages_count) $page = $pages_count;
			$start_pos = ($page - 1) * $perpage;
			$result['category'] = $category;
			$result['start_pos'] = $start_pos;
			$result['page'] = $page;
			$result['pages_count'] = $pages_count;
		} else {
			$result['pages_count'] = 1;
		}
		return $result;
	}
}
?>