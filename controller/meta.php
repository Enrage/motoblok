<?php
defined('SHOP') or die('Access Denied');
class meta extends Core {
	private $title;
	private $keywords;
	private $description;
	public function get_content() {
		$meta = $this->meta_words();
		return $meta;
	}
	private function meta_words() {
		$this->title = 'Интернет-магазин Vsemotobloki';
		$this->keywords = 'Мотоблоки, культиваторы, газонокосилки';
		$this->description = 'Описание мотоблоки, интернет-магазин vsemotobloki.ru';
		if(isset($_GET['view'])) $view = $_GET['view'];
		if(!isset($_GET['view'])) $view = 'main';
		switch ($view) {
			case 'product':
				$goods_id = abs((int)$_GET['goods_id']);
				$goods = $this->m->get_goods($goods_id);
				$title = $goods[0]['name'];
				$keywords = $goods[0]['keywords'];
				$description = $goods[0]['description'];
			break;
			case 'informer':
				$link = abs((int)$_GET['informer_id']) - 1;
				$links = $this->m->informer_links();
				$title = $links[$link]['link_name'];
				$keywords = $links[$link]['keywords'];
				$description = $links[$link]['description'];
			break;
			case 'news':
				$title = "Новинки vsemotobloki.ru";
				$keywords = "Новинки мотоблоки интернет-магазин";
				$description = "Новинки нашего интернет-магазина";
			break;
			case 'main':
				$title = "Главная страница vsemotobloki.ru";
				$keywords = "Главная мотоблоки интернет-магазин";
				$description = "Главная нашего интернет-магазина";
			break;
			case 'cat':
				if(isset($_GET['category']) && !empty($_GET['category'])) {
					$cat = abs((int)$_GET['category']) - 1;
					$meta_cat = $this->m->meta_cat();
					if($cat < count($meta_cat)) {
						$title = $meta_cat[$cat]['brand_name'];
						$keywords = $meta_cat[$cat]['keywords'];
						$description = $meta_cat[$cat]['description'];
					} else {
						$title = $this->title;
						$keywords = $this->keywords;
						$description = $this->description;
					}
				} else {
					$title = $this->title;
					$keywords = $this->keywords;
					$description = $this->description;
				}
			break;
			case 'search':
				$title = 'Поиск Все мотоблоки';
				$keywords = 'Все мотоблоки, интернет-магазин, культиватор';
				$description = 'Мета-описание vsemotobloki.ru';
			break;
			default:
				$title = 'Интернет-магазин Vsemotobloki';
				$keywords = 'Мотоблоки, культиваторы, газонокосилки';
				$description = 'Описание мотоблоки, интернет-магазин vsemotobloki.ru';
			break;
		}
		$meta['title'] = $title;
		$meta['keywords'] = $keywords;
		$meta['description'] = $description;
		return $meta;
	}
}
?>