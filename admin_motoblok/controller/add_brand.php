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
}
?>