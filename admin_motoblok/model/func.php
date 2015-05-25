<?php
defined('SHOP') or die('Access Denied');
class func {
	public $mysqli;
	public function __construct() {
		$this->mysqli = db::getObject();
	}
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

	// Ресайз картинок
	public function resize($target, $dest, $wmax, $hmax, $ext) {
    /*
    $target - путь к оригинальному файлу
    $dest - путь сохранения обработанного файла
    $wmax - максимальная ширина
    $hmax - максимальная высота
    $ext - расширение файла */
    list($w_orig, $h_orig) = getimagesize($target);
    $ratio = $w_orig / $h_orig; // =1 - квадрат, <1 - альбомная, >1 - книжная
    if(($wmax / $hmax) > $ratio) {
      $wmax = $hmax * $ratio;
    } else {
      $hmax = $wmax / $ratio;
    }

    $img = "";
    // imagecreatefromjpeg | imagecreatefromgif | imagecreatefrompng
    switch($ext) {
      case("gif"):
        $img = imagecreatefromgif($target);
      break;
      case("png"):
        $img = imagecreatefrompng($target);
      break;
      default:
        $img = imagecreatefromjpeg($target);
    }
    $newImg = imagecreatetruecolor($wmax, $hmax); // создаем оболочку для новой картинки

    if($ext == "png") {
      imagesavealpha($newImg, true); // сохранение альфа канала
      $transPng = imagecolorallocatealpha($newImg, 0, 0, 0, 127); // добавляем прозрачность
      imagefill($newImg, 0, 0, $transPng); // заливка
    }

    imagecopyresampled($newImg, $img, 0, 0, 0, 0, $wmax, $hmax, $w_orig, $h_orig); // копируем и ресайзим изображение
    switch($ext) {
      case("gif"):
        imagegif($newImg, $dest);
      break;
      case("png"):
        imagepng($newImg, $dest);
      break;
      default:
        imagejpeg($newImg, $dest);
    }
	  imagedestroy($newImg);
	}

	public function upload_file($id) {
		$uploaddir = '../userfiles/product_img/photos/';
		$file = $_FILES['userfile']['name'];
		$ext = strtolower(preg_replace('#.+\.([a-z]+)$#i', '$1', $file));
		$types = array("image/gif", "image/png", "image/jpeg", "image/pjpeg", "image/x-png", "image/tiff");
		$res = array();
		if($_FILES['userfile']['size'] > SIZE or $_FILES['userfile']['size'] == 0) {
			$res = array('answer' => 'Ошибка! Максимальный вес файла - 3 Мб!');
			exit(json_encode($res));
		}

		if(!isset($file)) {
      $res = array("answer" => "Ошибка! Возможно, файл слишком большой.");
      exit(json_encode($res));
    }

    if(!in_array($_FILES['userfile']['type'], $types)) {
    	$res = array("answer" => "Допустимые расширения - .gif, .jpg, .png, .tiff");
			exit(json_encode($res));
    }
    $query = "SELECT img_slide FROM goods WHERE goods_id = ?";
    $stmt = $this->mysqli->prepare($query);
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $stmt->bind_result($img_slide);
    $row = array();
    while($stmt->fetch()) {
			$row[] = array(
				'img_slide' => $img_slide);
		}
		if($img_slide) {
			$images = explode('|', $img_slide);
			$lastimg = end($images);
			// Номер последней картинки
			$lastnum = preg_replace('#\d+_(\d+)\.\w+#', '$1', $lastimg);
			$lastnum += 1;
			$newimg = "{$id}_{$lastnum}.{$ext}"; // Имя новой картинки
			$images = "{$img_slide}|{$newimg}"; // Строка для записи в БД
		} else {
			$newimg = "{$id}_0.{$ext}"; // Имя новой картинки
			$images = $newimg;
		}

		$uploadfile = $uploaddir.$newimg;
		if(@move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
			$this->resize($uploadfile, "../userfiles/product_img/thumbs/$newimg", 100, 100, $ext);
			$query = "UPDATE goods SET img_slide = ? WHERE goods_id = ?";
			$stmt = $this->mysqli->prepare($query);
		  $stmt->bind_param('si', $images, $id);
		  $stmt->execute();
		}
		$stmt->close();
    $res = array('answer' => 'OK', 'file' => $newimg);
    exit(json_encode($res));
	}
}