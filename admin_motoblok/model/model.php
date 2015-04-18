<?php
defined('SHOP') or die('Access Denied');
require_once '../db.php';
class model {
	public $func;
	public $mysqli;
	public function __construct() {
		$this->mysqli = db::getObject();
		$this->func = new func();
	}

	// Каталог - получение массива
	public function catalog() {
		$query = "SELECT * FROM brands ORDER BY brand_id, parent_id, brand_name";
		try {
			if(!$stmt = $this->mysqli->prepare($query)) throw new Exception("Error Prepare catalog");
			$stmt->execute();
			$stmt->bind_result($brand_id, $brand_name, $parent_id, $keywords, $description);
			$row = array();
			$i = 0;
			while($stmt->fetch()) {
				$row[] = array($brand_id, $brand_name, $parent_id, $keywords, $description);
				if(!$row[$i][2]) {
					$cat[$row[$i][0]][] = $row[$i][1];
					$cat[$row[$i][0]][] = $row[$i][3];
					$cat[$row[$i][0]][] = $row[$i][4];
				} else {
					$cat[$row[$i][2]]['sub'][$brand_id][0] = $brand_name;
					$cat[$row[$i][2]]['sub'][$brand_id][1] = $keywords;
					$cat[$row[$i][2]]['sub'][$brand_id][2] = $description;
					// $brand_name[0] = $keywords;
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

	// Страницы
	public function edit_pages() {
		$query = "SELECT page_id, title, position FROM pages ORDER BY position";
		$stmt = $this->mysqli->prepare($query);
		$stmt->execute();
		$stmt->bind_result($page_id, $title, $position);
		$pages = array();
		while($stmt->fetch()) {
			$pages[] = array(
				'page_id' => $page_id,
				'title' => $title,
				'position' => $position);
		}
		$stmt->close();
		return $pages;
	}

	// Отдельная страница
	public function get_page($page_id) {
		$query = "SELECT * FROM pages WHERE page_id = ?";
		$stmt = $this->mysqli->prepare($query);
		$stmt->bind_param('i', $page_id);
		$stmt->execute();
		$stmt->bind_result($page_id, $title, $keywords, $description, $position, $text);
		$page = array();
		while($stmt->fetch()) {
			$page[] = array(
				'page_id' => $page_id,
				'title' => $title,
				'keywords' => $keywords,
				'description' => $description,
				'position' => $position,
				'text' => $text);
		}
		$stmt->close();
		return $page;
	}

	// Редактирование страницы
	public function update_page($page_id) {
		$title = trim($_POST['title']);
		$position = (int)$_POST['position'];
		$keywords = trim($_POST['keywords']);
		$description = trim($_POST['description']);
		$text = trim($_POST['text']);
		if(empty($title)) {
			$_SESSION['edit_page']['res'] = "<div class='error'>Должно быть название страницы</div>";
			return false;
		} else {
			$title = $this->func->clr($title);
			$keywords = $this->func->clr($keywords);
			$description = $this->func->clr($description);
			$text = $this->func->clr($text);
			$query = "UPDATE pages SET title = ?, position = ?, keywords = ?, description = ?, text = ? WHERE page_id = ?";
			$stmt = $this->mysqli->prepare($query);
			$stmt->bind_param('sisssi', $title, $position, $keywords, $description, $text, $page_id);
			$stmt->execute();
			if($stmt->affected_rows > 0) {
				$_SESSION['answer'] = "<div class='success'>Страница обновлена!</div>";
				return true;
			} else {
				$_SESSION['edit_page']['res'] = "<div class='error'>Ошибка или Вы ничего не меняли</div>";
				return false;
			}
			$stmt->close();
		}
	}

	public function add_brand() {
		$brand_name = trim($_POST['brand_name']);
		$parent_id = (int)$_POST['parent_id'];
		$keywords = trim($_POST['keywords']);
		$description = trim($_POST['description']);
		if(empty($brand_name)) {
			$_SESSION['add_brand']['res'] = "<div class='error'>Должно быть название категории!</div>";
			$_SESSION['add_brand']['keywords'] = $keywords;
			$_SESSION['add_brand']['description'] = $description;
			return false;
		} else {
			$query = "SELECT brand_id FROM brands WHERE brand_name = ? AND parent_id = ?";
			$stmt = $this->mysqli->prepare($query);
			$stmt->bind_param('si', $brand_name, $parent_id);
			$stmt->execute();
			$stmt->store_result();
			if($stmt->num_rows > 0) {
					$_SESSION['add_brand']['res'] = "<div class='error'>Категория с таким названием уже есть!</div>";
					$_SESSION['add_brand']['brand_name'] = $brand_name;
					$_SESSION['add_brand']['keywords'] = $keywords;
					$_SESSION['add_brand']['description'] = $description;
					return false;
			} else {
				$query = "INSERT INTO brands (brand_name, parent_id) VALUES (?, ?)";
				$stmt = $this->mysqli->prepare($query);
				$stmt->bind_param('si', $brand_name, $parent_id);
				$stmt->execute();
				if($stmt->affected_rows > 0) {
					$_SESSION['add_brand']['res'] = "<div class='success'>Категория добавлена!</div>";
					return true;
				} else {
					$_SESSION['add_brand']['res'] = "<div class='error'>Ошибка при добавлении категории!</div>";
					$_SESSION['add_brand']['brand_name'] = $brand_name;
					$_SESSION['add_brand']['keywords'] = $keywords;
					$_SESSION['add_brand']['description'] = $description;
					return false;
				}
			}
			$stmt->close();
			return $page;
		}
	}
}