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

	// Постраничная навигация
	public function pagination($page, $pages_count) {
		if($_SERVER['QUERY_STRING']) {
			$uri = '';
			foreach($_GET as $key => $value) {
				// Формируем строку параметров без номера страницы
				if($key != 'page') $uri .= "{$key}={$value}&amp;";
			}
		}
		// Формирование ссылок
		$back = '';
		$forward = '';
		$startpage = '';
		$endpage = '';
		$page2left = '';
		$page1left = '';
		$page2right = '';
		$page1right = '';
		if($page > 1) $back = "<a class='nav_link' href='?{$uri}page=".($page-1)."'>&lt;</a>";
		if($page < $pages_count) $forward = "<a class='nav_link' href='?{$uri}page=".($page+1)."'>&gt;</a>";
		if($page > 3) $startpage = "<a class='nav_link' href='?{$uri}page=1'><<</a>";
		if($page < ($pages_count - 2)) $endpage = "<a class='nav_link' href='?{$uri}page={$pages_count}'>>></a>";
		if($page - 2 > 0) $page2left = "<a class='nav_link' href='?{$uri}page=".($page-2)."'>".($page-2)."</a>";
		if($page - 1 > 0) $page1left = "<a class='nav_link' href='?{$uri}page=".($page-1)."'>".($page-1)."</a>";
		if($page + 2 <= $pages_count) $page2right = "<a class='nav_link' href='?{$uri}page=".($page+2)."'>".($page+2)."</a>";
		if($page + 1 <= $pages_count) $page1right = "<a class='nav_link' href='?{$uri}page=".($page+1)."'>".($page+1)."</a>";
		// Формируем вывод навигации
		print $startpage.$back.$page2left.$page1left.'<span class="nav_active">'.$page.'</span>'.$page1right.$page2right.$forward.$endpage;
	}
}