<?php
defined('SHOP') or die('Access Denied');
class edit_product extends Core_Admin {
	public function get_content() {
		if(isset($_GET['goods_id'])) $goods_id = (int)$_GET['goods_id'];
		$get_product = $this->m->get_product($goods_id);
		return $get_product;
	}

	protected function cat() {
		$cat = new brands();
		$res = $cat->get_content();
		return $res;
	}

	protected function baseimg() {
		$get_product = $this->get_content();
		if($get_product[0]['img'] != 'no_image.jpg') {
			$baseimg = '<img src="'.PRODUCT.$get_product[0]['img'].'" class="del_img" width="150" alt="'.$get_product[0]['name'].'">';
		} else {
			$baseimg = '<input type="file" name="baseimg">';
		}
		return $baseimg;
	}

	protected function imgslide() {
		$get_product = $this->get_content();
		$imgslide = '';
		if(isset($get_product[0]['img_slide'])) {
			$images = explode('|', $get_product[0]['img_slide']);
			foreach($images as $img) {
				$imgslide .= "<img src='".PRODUCT_THUMBS."{$img}' class='delimg' alt='{$img}' width='80'>";
			}
		}
		return $imgslide;
	}
}
?>