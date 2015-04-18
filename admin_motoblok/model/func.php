<?php
defined('SHOP') or die('Access Denied');
class func {
	// Распечатка массива
	public function print_arr($x) {
		echo '<pre>';
		print_r($x);
		echo '</pre>';
	}

	// Редирект
	public function redirect($http = false) {
		if($http) $redirect = $http;
		else $redirect = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : PATH;
		header("Location: {$redirect}");
		die();
	}
}