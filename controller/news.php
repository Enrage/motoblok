<?php
defined('SHOP') or die('Access Denied');
class news extends Core {
	public function get_content() {
		$eyestopper = $this->m->eyestopper('news');
		return $eyestopper;
	}
}
?>