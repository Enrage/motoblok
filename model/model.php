<?php
defined('SHOP') or die('Access Denied');
require_once 'db.php';
class model {
	public $func;
	public $mysqli;
	public function __construct() {
		$this->mysqli = db::getObject();
		$this->func = new functions();
	}

	// Массив категорий
	public function catalog() {
		$query = "SELECT * FROM brands ORDER BY brand_id";
		try {
			if(!$stmt = $this->mysqli->prepare($query)) throw new Exception("Error Prepare catalog");
			$stmt->execute();
			$stmt->bind_result($brand_id, $brand_name, $parent_id);
			$row = array();
			$i = 0;
			while($stmt->fetch()) {
				$row[] = array($brand_id, $brand_name, $parent_id);
				if(!$row[$i][2]) {
					$cat[$row[$i][0]][] = $row[$i][1];
				} else {
					$cat[$row[$i][2]]['sub'][$brand_id] = $brand_name;
				}
				$i++;
			}
			$stmt->close();
		}
		catch(Exception $e) {
			print 'Ошибка: '. $e->getMessage();
			die();
		}
		return $cat;
	}

	// Вывод информеров
	public function informers() {
		$query = "SELECT * FROM links INNER JOIN informers ON links.parent_informer = informers.informer_id ORDER BY informer_position, link_position";
		try {
			if(!$stmt = $this->mysqli->prepare($query)) throw new Exception("Error Prepare informers");
			$stmt->execute();
			$stmt->bind_result($link_id, $link_name, $parent_informer, $link_position, $keywords, $description, $text, $informer_id, $informer_name, $informer_position);
			$informers = array();
			$row = array();
			$name = "";
			$i = 0;
			while($stmt->fetch()) {
				$row[] = array($link_id, $link_name, $parent_informer, $link_position, $keywords, $description, $text, $informer_id, $informer_name, $informer_position);
				if($row[$i][8] != $name) { // Если такого информера нет
					$informers[$row[$i][7]][] = $row[$i][8]; // Добавляем информер в массив
					$name = $row[$i][8];
				}
				$informers[$row[$i][2]]['sub'][$link_id] = $link_name; // Заносим страницы в информер
				$i++;
			}
			$stmt->close();
		}
		catch(Exception $e) {
			print 'Ошибка: '. $e->getMessage();
			die();
		}
		return $informers;
	}

	// Получение текста информера
	public function get_text_informer($informer_id) {
		$query = "SELECT link_id, link_name, text, informers.informer_id, informers.informer_name FROM links LEFT JOIN informers ON informers.informer_id = links.parent_informer WHERE link_id = ?";
		$stmt = $this->mysqli->prepare($query);
		$stmt->bind_param('i', $informer_id);
		$stmt->execute();
		$stmt->bind_result($link_id, $link_name, $text, $informer_id, $informer_name);
		$text_informer = array();
		while($stmt->fetch()) {
			$text_informer[] = array(
				'link_id' => $link_id,
				'link_name' => $link_name,
				'text' => $text,
				'informer_id' => $informer_id,
				'informer_name' => $informer_name);
		}
		$stmt->close();
		return $text_informer;
	}

	// Новинки, лидеры, распродажа
	public function eyestopper($eyestopper) {
		$visible = '1';
		$eye = '1';
		if(isset($_GET['view']) && $_GET['view'] != 'main') $limit = 15;
		else $limit = 6;
		$query = "SELECT goods_id, name, img, price FROM goods WHERE visible = ? AND $eyestopper = ? LIMIT $limit";
		try {
			if(!$stmt = $this->mysqli->prepare($query)) throw new Exception("Error Prepare eyestopper");
			$stmt->bind_param('ss', $visible, $eye);
			$stmt->execute();
			$stmt->bind_result($goods_id, $name, $img, $price);
			$eyestoppers = array();
			while($stmt->fetch()) {
				$eyestoppers[] = array(
					'goods_id' => $goods_id,
					'name' => $name,
					'img' => $img,
					'price' => $price);
			}
			$stmt->close();
		}
		catch(Exception $e) {
			print 'Ошибка: '. $e->getMessage();
			die();
		}
		return $eyestoppers;
	}

	// Получение кол-ва товаров для навигации
	public function count_rows($category) {
		$visible = '1';
		$query = "SELECT COUNT(goods_id) as count_rows FROM goods WHERE goods_brandid = ? AND visible = ?
		UNION
		SELECT COUNT(goods_id) as count_rows FROM goods WHERE goods_brandid IN
		(SELECT brand_id FROM brands WHERE parent_id = ?) AND visible = ?";
		$stmt = $this->mysqli->prepare($query);
		$stmt->bind_param('isis', $category, $visible, $category, $visible);
		$stmt->execute();
		$stmt->bind_result($count_rows);
		$row = array();
		while($stmt->fetch()) {
			$row[] = array(
				'count_rows' => $count_rows);
		}
		if(isset($row[1]['count_rows'])) {
			$count_rows = $row[0]['count_rows'] + $row[1]['count_rows'];
		} else $count_rows = $row[0]['count_rows'];
		$stmt->close();
		return $count_rows;
	}

	// Получение массива товаров в категории
	public function products($category, $order_db, $start_pos, $perpage) {
		$visible = '1';
		$query = "SELECT goods_id, name, img, anons, price, hits, news, sale, date FROM goods WHERE goods_brandid = ? AND visible = ?
		UNION
		SELECT goods_id, name, img, anons, price, hits, news, sale, date FROM goods WHERE goods_brandid IN
		(SELECT brand_id FROM brands WHERE parent_id = ?) AND visible = ? ORDER BY $order_db LIMIT $start_pos, $perpage";
		try {
			if(!$stmt = $this->mysqli->prepare($query)) throw new Exception("Error Prepare products");
			$stmt->bind_param('isis', $category, $visible, $category, $visible);
			$stmt->execute();
			$stmt->bind_result($goods_id, $name, $img, $anons, $price, $hits, $news, $sale, $date);
			$products = array();
			while($stmt->fetch()) {
				$products[] = array(
					'goods_id' => $goods_id,
					'name' => $name,
					'img' => $img,
					'anons' => $anons,
					'price' => $price,
					'hits' => $hits,
					'news' => $news,
					'sale' => $sale,
					'date' => $date);
			}
			$stmt->close();
		}
		catch(Exception $e) {
			print 'Ошибка: '. $e->getMessage();
			die();
		}
		return $products;
	}

	// Сумма заказов в корзине + атрибуты товара
	public function total_sum($goods) {
		$total_sum = 0;
		$str_goods = implode(',', array_keys($goods));
		$query = "SELECT goods_id, name, price, img FROM goods WHERE goods_id IN ($str_goods)";
		try {
			if(!$stmt = $this->mysqli->prepare($query)) throw new Exception("Error Prepare total_sum");
			$stmt->execute();
			$stmt->bind_result($goods_id, $name, $price, $img);
			$row = array();
			while($stmt->fetch()) {
				$row[] = array($goods_id, $name, $price, $img);
				$_SESSION['cart'][$goods_id]['name'] = $name;
				$_SESSION['cart'][$goods_id]['price'] = $price;
				$_SESSION['cart'][$goods_id]['img'] = $img;
				$total_sum += $_SESSION['cart'][$goods_id]['qty'] * $price;
			}
			$stmt->close();
		}
		catch(Exception $e) {
			print 'Ошибка: '. $e->getMessage();
			die();
		}
		return $total_sum;
	}

	// Регистрация
	public function registration() {
		$error = ""; // Флаг проверки пустых полей
		$login = trim($_POST['login']);
		$pass = trim($_POST['pass']);
		$name = trim($_POST['name']);
		$email = trim($_POST['email']);
		$phone = trim($_POST['phone']);
		$address = trim($_POST['address']);
		if(empty($login)) $error .= '<li>Не указан логин</li>';
		if(empty($pass)) $error .= '<li>Не указан пароль</li>';
		if(empty($name)) $error .= '<li>Не указано Ф.И.О.</li>';
		if(empty($email)) $error .= '<li>Не указан Email</li>';
		if(empty($phone)) $error .= '<li>Не указан телефон</li>';
		if(empty($address)) $error .= '<li>Не указан адрес</li>';
		if(empty($error)) {
			// Если все поля заполнены
			$query = "SELECT customer_id FROM customers WHERE login = ? LIMIT 1";
			try {
				if(!$stmt = $this->mysqli->prepare($query)) throw new Exception("Error Prepare registration select");
				$stmt->bind_param('s', $login);
				$stmt->execute();
				$stmt->store_result();
				if($stmt->num_rows > 0) {
					$_SESSION['reg']['res'] = "<div class='error'>Пользователь с таким логином уже существует!</div>";
					$_SESSION['reg']['name'] = $name;
					$_SESSION['reg']['email'] = $email;
					$_SESSION['reg']['phone'] = $phone;
					$_SESSION['reg']['address'] = $address;
				} else {
					$login = $this->func->clr($_POST['login']);
					$name = $this->func->clr($_POST['name']);
					$email = $this->func->clr($_POST['email']);
					$phone = $this->func->clr($_POST['phone']);
					$address = $this->func->clr($_POST['address']);
					$pass = md5($pass);
					$query = "INSERT INTO customers (name, email, phone, address, login, pass) VALUES (?, ?, ?, ?, ?, ?)";
					if(!$stmt = $this->mysqli->prepare($query)) throw new Exception("Error prepare registration insert");
					$stmt->bind_param('ssssss', $name, $email, $phone, $address, $login, $pass);
					$stmt->execute();
					if($stmt->affected_rows > 0) {
						$_SESSION['reg']['res'] = "<div class='success'>Регистрация прошла успешно!</div>";
						$_SESSION['auth']['user'] = $_POST['name'];
						$_SESSION['auth']['customer_id'] = $stmt->insert_id;
						$_SESSION['auth']['email'] = $email;
					} else {
						$_SESSION['reg']['res'] = "<div class='error'>Ошибка!</div>";
						$_SESSION['reg']['login'] = $login;
						$_SESSION['reg']['name'] = $name;
						$_SESSION['reg']['email'] = $email;
						$_SESSION['reg']['phone'] = $phone;
						$_SESSION['reg']['address'] = $address;
					}
					$stmt->close();
				}
			} catch(Exception $e) {
				print 'Ошибка: '.$e->getMessage();
				die();
			}
		} else {
			// Если не заполнены обязательные поля
			$_SESSION['reg']['res'] = "<div class='error'>Не заполнены обязательные поля: <ul> $error </ul></div>";
			$_SESSION['reg']['login'] = $login;
			$_SESSION['reg']['name'] = $name;
			$_SESSION['reg']['email'] = $email;
			$_SESSION['reg']['phone'] = $phone;
			$_SESSION['reg']['address'] = $address;
		}
	}

	// Авторизация
	public function authorization() {
		$login = trim($_POST['login']);
		$pass = trim($_POST['pass']);
		if(empty($login) OR empty($pass)) {
			$_SESSION['auth']['error'] = "<div class='error'>Поля логин/пароль должны быть заполнены!</div>";
		} else {
			$pass = md5($pass);
			$query = "SELECT customer_id, name, email FROM customers WHERE login = ? AND pass = ? LIMIT 1";
			try {
				if(!$stmt = $this->mysqli->prepare($query)) throw new Exception("Error Prepare authorization");
				$stmt->bind_param('ss', $login, $pass);
				$stmt->execute();
				$stmt->bind_result($customer_id, $name, $email);
				$stmt->store_result();
				if($stmt->num_rows == 1) {
					$row = array();
					while($stmt->fetch()) {
						$row[] = array(
							'customer_id' => $customer_id,
							'name' => $name,
							'email' => $email);
					}
					$_SESSION['auth']['customer_id'] = $customer_id;
					$_SESSION['auth']['user'] = $name;
					$_SESSION['auth']['email'] = $email;
				} else {
					$_SESSION['auth']['error'] = "<div class='error'>Логин или пароль введены неверно!</div>";
				}
				$stmt->close();
			}
			catch(Exception $e) {
				print 'Ошибка: '. $e->getMessage();
				die();
			}
		}
	}
}
?>