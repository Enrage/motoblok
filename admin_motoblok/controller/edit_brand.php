<?php
defined('SHOP') or die('Access Denied');
class edit_brand extends Core_Admin {
	public function get_content() {
		if(isset($_GET['brand_id'])) $brand_id = (int)$_GET['brand_id'];
		if($_POST) {
			$edit = $this->m->edit_brand($brand_id);
			if($edit) {
				$this->f->redirect('?view=brands');
			} else $this->f->redirect();
		}
		$brand = $this->m->get_brand($brand_id);
		return $brand;
	}

	protected function cat() {
		$cat = $this->m->catalog();
		return $cat;
	}
}
?>