<?php
defined('SHOP') or die('Access Denied');
class add_product extends Core_Admin {
	public function get_content() {
		if(isset($_GET['brand_id'])) $brand_id = (int)$_GET['brand_id'];
		else $brand_id = null;
		if($_POST) {
			if($this->m->add_product()) $this->f->redirect("?view=cat&category=$brand_id");
			else $this->f->redirect();
		}
		return $brand_id;
	}

	protected function cat() {
		$cat = new brands();
		$res = $cat->get_content();
		return $res;
	}

	protected function session_add_product() {
		$name = isset($_SESSION['add_product']['name']) ? htmlspecialchars($_SESSION['add_product']['name']) : NULL;
		$price = isset($_SESSION['add_product']['price']) ? htmlspecialchars($_SESSION['add_product']['price']) : NULL;
		$keywords = isset($_SESSION['add_product']['keywords']) ? htmlspecialchars($_SESSION['add_product']['keywords']) : NULL;
		$description = isset($_SESSION['add_product']['description']) ? htmlspecialchars($_SESSION['add_product']['description']) : NULL;
		$anons = isset($_SESSION['add_product']['anons']) ? htmlspecialchars($_SESSION['add_product']['anons']) : NULL;
		$content = isset($_SESSION['add_product']['content']) ? htmlspecialchars($_SESSION['add_product']['content']) : NULL;
		$product['name'] = $name;
		$product['price'] = $price;
		$product['keywords'] = $keywords;
		$product['description'] = $description;
		$product['anons'] = $anons;
		$product['content'] = $content;
		return $product;
	}
}
?>