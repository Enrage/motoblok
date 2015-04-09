<?php
defined('SHOP') or die('Access Denied');
include_once 'config.php';
include_once MODEL;
include_once FUNC;
abstract class Core {
	protected $m;
	protected $f;
	public function __construct() {
		$this->m = new model();
		$this->f = new functions();
	}
	protected function get_header() {
		return true;
	}
	protected function get_leftbar() {
		return true;
	}
	protected function get_rightbar() {
		return true;
	}
	protected function get_footer() {
		return true;
	}
	public function get_body($inc) {
		$header = $this->get_header();
		$content = $this->get_content();
		$leftbar = $this->get_leftbar();
		include TEMPLATE.'inc/index.php';
		$rightbar = $this->get_rightbar();
		$footer = $this->get_footer();
	}
	abstract function get_content();
}
?>