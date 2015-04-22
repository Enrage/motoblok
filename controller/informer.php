<?php
defined('SHOP') or die('Access Denied');
class informer extends Core {
	public function get_content() {
		if(isset($_GET['informer_id'])) $informer_id = abs((int)$_GET['informer_id']);
		$informer = $this->m->get_text_informer($informer_id);
		return $informer;
	}
}
?>