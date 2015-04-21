<?php
defined('SHOP') or die('Access Denied');
class cat extends Core {
	public function get_content() {
		if(isset($_GET['category'])) {
			$category = abs((int)$_GET['category']);
			$pos = $this->pos();
			$sort = $this->sort();
			$perpage = PERPAGE;
			$res = $this->m->products($category, $sort['order_db'], $pos['start_pos'], $perpage);
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
			$perpage = PERPAGE;
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
	public function sort() {
		// Ключи - то, что передаем GET параметром
		// Значения - то, что показываем пользователю и часть SQL-запроса, который передем в модель
		$order_p = array(
			'pricea' => array('от дешевых к дорогим', 'price ASC'),
			'priced' => array('от дорогих к дешевым', 'price DESC'),
			'datea' => array('по дате добавления - к последним', 'date ASC'),
			'dated' => array('по дате добавления - с последних', 'date DESC'),
			'namea' => array('от А до Я', 'name ASC'),
			'named' => array('от Я до А', 'name DESC')
		);
		if(isset($_GET['order'])) {
			$order_get = $this->f->clr($_GET['order']); // Получаем возможный параметр сортировки
			if(array_key_exists($order_get, $order_p)) {
				$order = $order_p[$order_get][0];
				$order_db = $order_p[$order_get][1];
			}
		} else {
			// По умолчанию сортировка по первому элементу массива order_p
			$order = $order_p['namea'][0];
			$order_db = $order_p['namea'][1];
		}
		$sort['order'] = $order;
		$sort['order_db'] = $order_db;
		$sort['order_p'] = $order_p;
		return $sort;
	}
}
?>