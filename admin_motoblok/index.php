<?php
define('SHOP', true);
session_start();
header("Content-Type:text/html;charset=UTF-8");
include_once '../config.php';
include_once 'model/model.php';
function __autoload($c) {
	if(file_exists("controller/".$c.".php")) {
		require_once 'controller/'.$c.'.php';
	} elseif(file_exists("model/".$c.".php")) {
		require_once 'model/'.$c.'.php';
	}
}
if(isset($_GET['view'])) {
	$class = trim(strip_tags($_GET['view']));
} else $class = 'edit_pages';
if(class_exists($class)) {
	$obj = new $class;
	$obj->get_body($class);
} else die;
?>