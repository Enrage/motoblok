<?php
defined('SHOP') or die('Access Denied');
class functions {
	// Распечатка массива
	public function print_arr($x) {
		echo '<pre>';
		print_r($x);
		echo '</pre>';
	}

	// Фильтрация входящих данных
	public function clr($a) {
		if(get_magic_quotes_gpc()) $a = stripslashes($a);
		$a = trim(strip_tags($a));
		return $a;
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

	// Добавление в корзину
	public function addtocart($goods_id, $total_items = 1) {
		if(isset($_SESSION['cart'][$goods_id])) {
			if(isset($_GET['col'])) {
				$total_items = abs((int)$_GET['col']);
			}
			// Если в массиве cart уже есть добавляемый товар
			$_SESSION['cart'][$goods_id]['qty'] += $total_items;
			return $_SESSION['cart'];
		} else {
			// Если товар кладется в корзину впервые
			$_SESSION['cart'][$goods_id]['qty'] = $total_items;
			return $_SESSION['cart'];
		}
	}
	public function total_quantity() {
		$_SESSION['total_quantity'] = 0;
		foreach($_SESSION['cart'] as $key => $value) {
			if(isset($value['price'])) {
				// Если получена цена товара из БД - суммируем кол-во
				$_SESSION['total_quantity'] += $value['qty'];
			} else {
				// Удаляем такой id из сессии (корзина)
				unset($_SESSION['cart'][$key]);
			}
		}
	}

	// Удаление из корзины
	public function delete_from_cart($id) {
		if(isset($_SESSION['cart'])) {
			if(array_key_exists($id, $_SESSION['cart'])) {
				$_SESSION['total_quantity'] -= $_SESSION['cart'][$id]['qty'];
				$_SESSION['total_sum'] -= $_SESSION['cart'][$id]['qty'] * $_SESSION['cart'][$id]['price'];
				unset($_SESSION['cart'][$id]);
			}
			if(($_SESSION['total_quantity'] == 0) or ($_SESSION['total_sum'] == 0)) {
				header("Location: ".PATH);
				die();
			}
		}
	}

	// Редирект
	public function redirect() {
		$redirect = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : PATH;
		header("Location: {$redirect}");
		die();
	}

	// Выход пользователя
	public function logout() {
		unset($_SESSION['auth']);
	}
}
?>