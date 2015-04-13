<?php
defined('SHOP') or die('Access Denied');
class main extends Core {
	public function get_content() {
		$eyestopper = $this->m->eyestopper('hits');
		return $eyestopper;
	}
}
?>