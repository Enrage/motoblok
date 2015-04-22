<?php
defined('SHOP') or die('Access Denied');
class add_brand extends Core_Admin {
	public function get_content() {
		if($_POST) {
			if($this->m->add_brand()) $this->f->redirect('?view=brands');
			else $this->f->redirect();
		}
		$categories = new brands();
		$res = $categories->get_content();
		return $res;
	}

	protected function session_brands() {
		$brand_name = isset($_SESSION['add_brand']['brand_name']) ? htmlspecialchars($_SESSION['add_brand']['position']) : NULL;
		$keywords = isset($_SESSION['add_brand']['keywords']) ? htmlspecialchars($_SESSION['add_brand']['keywords']) : NULL;
		$description = isset($_SESSION['add_brand']['description']) ? htmlspecialchars($_SESSION['add_brand']['description']) : NULL;
		$brands['brand_name'] = $brand_name;
		$brands['keywords'] = $keywords;
		$brands['description'] = $description;
		return $brands;
	}
}
?>