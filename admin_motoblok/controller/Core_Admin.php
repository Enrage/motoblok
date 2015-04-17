<?php
defined('SHOP') or die("Access Denied");
include_once 'model/model.php';
include_once '../model/functions.php';
abstract class Core_Admin {
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
	protected function get_footer() {
		return true;
	}
	public function get_body($inc) {
		$header = $this->get_header();
		$leftbar = $this->get_leftbar();
		$content = $this->get_content();
		include ADMIN_TPL.'inc/index.php';
		$footer = $this->get_footer();
	}
	abstract function get_content();
}
?>