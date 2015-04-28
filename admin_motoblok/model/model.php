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
				$row[] = array(
					'brand_id' => $brand_id,
					'brand_name' => $brand_name,
					'parent_id' => $parent_id,
					'keywords' => $keywords,
					'description' => $description);
				if(!$row[$i]['parent_id']) {
					$cat[$row[$i]['brand_id']][] = $row[$i]['brand_name'];
					// $cat[$row[$i][0]][] = $row[$i][3];
					// $cat[$row[$i][0]][] = $row[$i][4];
				} else {
					$cat[$row[$i]['parent_id']]['sub'][$brand_id] = $brand_name;
					// $cat[$row[$i][2]]['sub'][$brand_id][1] = $keywords;
					// $cat[$row[$i][2]]['sub'][$brand_id][2] = $description;
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

	// Получение данных отдельной категории
	public function get_brand($brand_id) {
		$query = "SELECT * FROM brands WHERE brand_id = ?";
		$stmt = $this->mysqli->prepare($query);
		$stmt->bind_param('i', $brand_id);
		$stmt->execute();
		$stmt->bind_result($brand_id, $brand_name, $parent_id, $keywords, $description);
		$brand = array();
		while($stmt->fetch()) {
			$brand[] = array(
				'brand_id' => $brand_id,
				'brand_name' => $brand_name,
				'parent_id' => $parent_id,
				'keywords' => $keywords,
				'description' => $description);
		}
		$stmt->close();
		return $brand;
	}

	// Добавление категорий
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
					$_SESSION['answer'] = "<div class='success'>Категория добавлена!</div>";
					return true;
				} else {
					$_SESSION['add_brand']['res'] = "<div class='error'>Ошибка при добавлении категории!</div>";
					$_SESSION['add_brand']['brand_name'] = $brand_name;
					$_SESSION['add_brand']['keywords'] = $keywords;
					$_SESSION['add_brand']['description'] = $description;
					return false;
				}
			}
		}
		$stmt->close();
	}

	// Редактирование категорий
	public function edit_brand($brand_id) {
		$brand_name = trim($_POST['brand_name']);
		$parent_id = (int)$_POST['parent_id'];
		$keywords = trim($_POST['keywords']);
		$description = trim($_POST['description']);
		$this_brand = trim($_POST['this_brand']);
		if(empty($brand_name)) {
			$_SESSION['edit_brand']['res'] = "<div class='error'>Должно быть название категории!</div>";
			$_SESSION['edit_brand']['keywords'] = $keywords;
			$_SESSION['edit_brand']['description'] = $description;
			return false;
		} else {
			$query = "SELECT brand_id FROM brands WHERE brand_name = ? AND parent_id = ?";
			$stmt = $this->mysqli->prepare($query);
			$stmt->bind_param('si', $brand_name, $parent_id);
			$stmt->execute();
			$stmt->store_result();
			if($stmt->num_rows > 0 && $brand_name != $this_brand) {
				$_SESSION['edit_brand']['res'] = "<div class='error'>Категория с таким названием уже есть!</div>";
				$_SESSION['edit_brand']['brand_name'] = $brand_name;
				$_SESSION['edit_brand']['keywords'] = $keywords;
				$_SESSION['edit_brand']['description'] = $description;

				return false;
			} else {
				$query = "UPDATE brands SET brand_name = ?, parent_id = ?, keywords = ?, description = ? WHERE brand_id = ?";
				$stmt = $this->mysqli->prepare($query);
				$stmt->bind_param('sissi', $brand_name, $parent_id, $keywords, $description, $brand_id);
				$stmt->execute();
				if($stmt->affected_rows > 0) {
					$_SESSION['answer'] = "<div class='success'>Категория обновлена!</div>";
					return true;
				} else {
					$_SESSION['edit_brand']['res'] = "<div class='error'>Ошибка редактирования категории или Вы ничего не меняли</div>";
					$_SESSION['edit_brand']['brand_name'] = $brand_name;
					$_SESSION['edit_brand']['keywords'] = $keywords;
					$_SESSION['edit_brand']['description'] = $description;
					return false;
				}
			}
		}
		$stmt->close();
	}

	public function del_brand($brand_id) {
		$query = "SELECT COUNT(*) FROM brands WHERE parent_id = ?";
		$stmt = $this->mysqli->prepare($query);
		$stmt->bind_param('i', $brand_id);
		$stmt->execute();
		$stmt->bind_result($count);
		while($stmt->fetch()) {
			$row[] = array(
				'count' => $count);
		}
		if($row[0]['count'] > 0) {
			$_SESSION['answer'] = "<div class='error'>Категория имеет подкатегории. Удалите сначала их или переместите в другие категории!</div>";
		} else {
			$query = "DELETE FROM goods WHERE goods_brandid = ?";
			$stmt = $this->mysqli->prepare($query);
			$stmt->bind_param('i', $brand_id);
			$stmt->execute();
			$query = "DELETE FROM brands WHERE brand_id = ?";
			$stmt = $this->mysqli->prepare($query);
			$stmt->bind_param('i', $brand_id);
			$stmt->execute();
			$_SESSION['answer'] = "<div class='success'>Категория удалена!</div>";
		}
		$stmt->close();
	}

	// Получение кол-ва товаров для навигации
	public function count_rows($category) {
		$query = "SELECT COUNT(goods_id) as count_rows FROM goods WHERE goods_brandid = ?
		UNION
		SELECT COUNT(goods_id) as count_rows FROM goods WHERE goods_brandid IN
		(SELECT brand_id FROM brands WHERE parent_id = ?)";
		$stmt = $this->mysqli->prepare($query);
		$stmt->bind_param('ii', $category, $category);
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
	public function products($category, $start_pos, $perpage) {
		$query = "SELECT goods_id, name, img, anons, price, hits, news, sale, date FROM goods WHERE goods_brandid = ?
		UNION
		SELECT goods_id, name, img, anons, price, hits, news, sale, date FROM goods WHERE goods_brandid IN
		(SELECT brand_id FROM brands WHERE parent_id = ?) LIMIT $start_pos, $perpage";
		try {
			if(!$stmt = $this->mysqli->prepare($query)) throw new Exception("Error Prepare products");
			$stmt->bind_param('ii', $category, $category);
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

	// Получение названий для хлебных крошек
	public function brand_name($category) {
		$query = "SELECT brand_id, brand_name FROM brands WHERE brand_id = (SELECT parent_id FROM brands WHERE brand_id = ?)
		UNION
		SELECT brand_id, brand_name FROM brands WHERE brand_id = ?";
		try {
			if(!$stmt = $this->mysqli->prepare($query)) throw new Exception("Error Prepare products");
			$stmt->bind_param('ii', $category, $category);
			$stmt->execute();
			$stmt->bind_result($brand_id, $brand_name);
			$brandname = array();
			while($stmt->fetch()) {
				$brandname[] = array(
					'brand_id' => $brand_id,
					'brand_name' => $brand_name);
			}
			$stmt->close();
		}
		catch(Exception $e) {
			print 'Ошибка: '. $e->getMessage();
			die();
		}
		return $brandname;
	}

	// Добавление товара
	public function add_product() {
		$name = trim($_POST['name']);
		$goods_brandid = (int)$_POST['category'];
		$keywords = trim($_POST['keywords']);
		$description = trim($_POST['description']);
		$anons = trim($_POST['anons']);
		$content = trim($_POST['content']);
		$visible = (int)$_POST['visible'];
		$hits = isset($_POST['hits']) ? (int)$_POST['hits']: '0';
		$news = isset($_POST['news']) ? (int)$_POST['news']: '0';
		$sale = isset($_POST['sale']) ? (int)$_POST['sale']: '0';
		$price = round(floatval(preg_replace('#,#', '.', $_POST['price'])), 2);
		$date = date("Y-m-d");

		if(empty($name)) {
			$_SESSION['add_product']['res'] = "<div class='error'>У товара должно быть название!</div>";
			$_SESSION['add_product']['price'] = $price;
			$_SESSION['add_product']['keywords'] = $keywords;
			$_SESSION['add_product']['description'] = $description;
			$_SESSION['add_product']['anons'] = $anons;
			$_SESSION['add_product']['content'] = $content;
			return false;
		} else {
			$query = "INSERT INTO goods (name, keywords, description, goods_brandid, anons, content, visible, hits, news, sale, price, date) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
			if(!$stmt = $this->mysqli->prepare($query)) die('ошибка');
			$stmt->bind_param('sssissssssss', $name, $keywords, $description, $goods_brandid, $anons, $content, $visible, $hits, $news, $sale, $price, $date);
			$stmt->execute();
			if($stmt->affected_rows > 0) {
				$id = $stmt->insert_id; // ID сохраненного товара
				$types = array('image/gif', "image/png", 'image/jpeg', 'image/pjpeg', 'image/x-png');

				if(isset($_FILES['baseimg']['name'])) {
					$baseimgExt = strtolower(preg_replace('#.+\.([a-z]+)$#i', '$1', $_FILES['baseimg']['name'])); // Расширение картинки
					$baseimgName = "{$id}.{$baseimgExt}"; // Новое имя картинки
					$baseimgTmpName = $_FILES['baseimg']['tmp_name']; // Временное имя файла
					$baseimgSize = $_FILES['baseimg']['size']; // Вес файла
					$baseimgType = $_FILES['baseimg']['type']; // Тип файла
					$baseimgError = $_FILES['baseimg']['error']; // 0 - ok, иначе - ошибка
					$error = '';

					if(!in_array($baseimgType, $types)) $error .= 'Допустимые расширения - .gif, .png, .jpg <br>';
					if($baseimgSize > SIZE) $error .= 'Максимальный размер файла - 3 Мб!';
					if($baseimgError) $error .= 'Ошибка при загрузке файла! Возможно файл слишком большой';
					if(!empty($error)) $_SESSION['answer'] = "<div class='error'>Ошибка при загрузке картинки товара! <br> {$error}</div>";

					// Если нет ошибок
					if(empty($error)) {
						if(@move_uploaded_file($baseimgTmpName, "../userfiles/product_img/tmp/$baseimgName")) {
							$this->func->resize("../userfiles/product_img/tmp/$baseimgName", "../userfiles/product_img/baseimg/$baseimgName", 980, 630, $baseimgExt);
							@unlink("".PRODUCT_TMP.$baseimgName."");
							$query = "UPDATE goods SET img = ? WHERE goods_id = ?";
							$stmt = $this->mysqli->prepare($query);
							$stmt->bind_param('si', $baseimgName, $id);
							$stmt->execute();
						} else {
							$_SESSION['answer'] .= "<div class='error'>Не удалось переместить загруженную картинку. Проверьте права на папки в каталоге ".PRODUCT_TMP."!</div>";
						}
					}
				}

				if(isset($_FILES['galleryimg']['name'][0])) {
					for($i = 0; $i < count($_FILES['galleryimg']['name']); $i++) {
						$error = '';
						if($_FILES['galleryimg']['name'][$i]) {
							$galleryimgExt = strtolower(preg_replace('#.+\.([a-z]+)$#i', '$1', $_FILES['galleryimg']['name'][$i])); // Расширение картинки
							$galleryimgName = "{$id}_{$i}.{$galleryimgExt}"; // Новое имя картинки
							$galleryimgTmpName = $_FILES['galleryimg']['tmp_name'][$i]; // Временное имя файла
							$galleryimgSize = $_FILES['galleryimg']['size'][$i]; // Вес файла
							$galleryimgType = $_FILES['galleryimg']['type'][$i]; // Тип файла
							$galleryimgError = $_FILES['galleryimg']['error'][$i]; // 0 - ok, иначе - ошибка
							if(!in_array($galleryimgType, $types)) {
								$error .= 'Допустимые расширения - .gif, .png, .jpg <br>';
								$_SESSION['answer'] .= "<div class='error'>Ошибка при загрузке картинки {$_FILES['galleryimg']['name'][$i]} <br> {$error}</div>";
								continue;
							}
							if($galleryimgSize > SIZE) {
								$error .= 'Максимальный размер файла - 3 Мб.';
								$_SESSION['answer'] .= "<div class='error'>Ошибка при загрузке картинки {$_FILES['galleryimg']['name'][$i]} <br> {$error}</div>";
								continue;
							}
							if($galleryimgError) {
								$error .= 'Ошибка при загрузке файла! Возможно файл слишком большой';
								$_SESSION['answer'] .= "<div class='error'>Ошибка при загрузке картинки {$_FILES['galleryimg']['name'][$i]} <br> {$error}</div>";
								continue;
							}
							if(empty($error)) {
								if(@move_uploaded_file($galleryimgTmpName, "../userfiles/product_img/photos/$galleryimgName")) {
									$this->func->resize("../userfiles/product_img/photos/$galleryimgName", "../userfiles/product_img/thumbs/$galleryimgName", 980, 630, $galleryimgExt);
									if(!isset($galleryfiles)) {
										$galleryfiles = $galleryimgName;
									} else {
										$galleryfiles .= "|{$galleryimgName}";
									}
								} else {
									$_SESSION['answer'] .= "<div class='error'>Не удалось переместить загруженную картинку. Проверьте права на папки в каталоге ".PRODUCT_PHOTOS."!</div>";
								}
							}
						}
					}
					if(isset($galleryfiles)) {
						$query = "UPDATE goods SET img_slide = ? WHERE goods_id = ?";
						$stmt = $this->mysqli->prepare($query);
						$stmt->bind_param('si', $galleryfiles, $id);
						$stmt->execute();
					}
				}

				$_SESSION['answer'] .= "<div class='success'>Товар успешно добавлен!</div>";
				return true;
			} else {
				$_SESSION['add_product']['res'] = "<div class='error'>Ошибка при добавлении товара!</div>";
				$_SESSION['add_product']['name'] = $name;
				$_SESSION['add_product']['price'] = $price;
				$_SESSION['add_product']['keywords'] = $keywords;
				$_SESSION['add_product']['description'] = $description;
				$_SESSION['add_product']['anons'] = $anons;
				$_SESSION['add_product']['content'] = $content;
				return false;
			}
		}
	}

	// Получение данных товара
	public function get_product($goods_id) {
		$query = "SELECT * FROM goods WHERE goods_id = ?";
		$stmt = $this->mysqli->prepare($query);
		$stmt->bind_param('i', $goods_id);
		$stmt->execute();
		$stmt->bind_result($goods_id, $name, $keywords, $description, $img, $goods_brandid, $anons, $content, $visible, $hits, $news, $sale, $price, $date, $img_slide);
		$brand = array();
		while($stmt->fetch()) {
			$brand[] = array(
				'goods_id' => $goods_id,
				'name' => $name,
				'keywords' => $keywords,
				'description' => $description,
				'img' => $img,
				'goods_brandid' => $goods_brandid,
				'anons' => $anons,
				'content' => $content,
				'visible' => $visible,
				'hits' => $hits,
				'news' => $news,
				'sale' => $sale,
				'price' => $price,
				'date' => $date,
				'img_slide' => $img_slide);
		}
		$stmt->close();
		return $brand;
	}
}