<?php
defined('SHOP') or die('Access Denied');
class edit_product extends Core_Admin {
	public function get_content() {
		if(isset($_GET['upload'])) {
			$id = (int)$_POST['id'];
			$this->f->upload_file($id);
		}

		if(isset($_GET['img'])) {
			$res = $this->m->del_img();
			exit($res);
		}

		$brand = $this->get_product_data();
		$brand_id = $brand[0]['goods_brandid'];
		if(isset($_GET['goods_id'])) $goods_id = (int)$_GET['goods_id'];
		if(isset($_POST)) {
			if($this->m->edit_product($goods_id)) $this->f->redirect("?view=cat&category=$brand_id");
		}
	}

	protected function get_product_data() {
		if(isset($_GET['goods_id'])) $goods_id = (int)$_GET['goods_id'];
		$get_product = $this->m->get_product($goods_id);
		return $get_product;
	}

	// Вывод категорий
	protected function cat() {
		$cat = new brands();
		$res = $cat->get_content();
		return $res;
	}

	// Редактирование базовой картинки
	protected function baseimg() {
		$get_product = $this->get_product_data();
		if($get_product[0]['img'] != 'no_image.jpg') {
			$baseimg = '<img src="'.PRODUCT.$get_product[0]['img'].'" class="del_img" rel="0" width="150" alt="'.$get_product[0]['img'].'">';
		} else {
			$baseimg = '<input type="file" name="baseimg">';
		}
		return $baseimg;
	}

	// Редактирование картинок галереи
	protected function imgslide() {
		$get_product = $this->get_product_data();
		$imgslide = '';
		if(isset($get_product[0]['img_slide'])) {
			$images = explode('|', $get_product[0]['img_slide']);
			foreach($images as $img) {
				$imgslide .= "<img src='".PRODUCT_THUMBS."{$img}' class='del_img' rel='1' alt='{$img}' width='80'>";
			}
		}
		return $imgslide;
	}
}
?>