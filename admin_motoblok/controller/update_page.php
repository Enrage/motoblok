<?php
defined('SHOP') or die('Access Denied');
class update_page extends Core_Admin {
	public function get_content() {
		if($_POST) {
			if(isset($_GET['page_id'])) $page_id = (int)$_GET['page_id'];
			$update = $this->m->update_page($page_id);
			if($update) {
				header("Location: {$_SERVER['PHP_SELF']}?view=edit_pages");
				die();
			}
		}
	}

	protected function update_page_text() {
		if(isset($_GET['page_id'])) $page_id = (int)$_GET['page_id'];
		$page = $this->m->get_page($page_id);
		return $page;
	}
}
?>