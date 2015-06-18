<?php
defined('SHOP') or die('Access Denied');
class cart extends Core {
	public function get_content() {
		$this->f->print_arr($_SESSION);
		// Получение способов доставки
		$res = $this->m->get_dostavka();
		// Пересчет товаров в корзине
		if(isset($_GET['id'], $_GET['qty'])) {
			$goods_id = abs((int)$_GET['id']);
			$qty = abs((int)$_GET['qty']);
			$qty = $qty - $_SESSION['cart'][$goods_id]['qty'];
			$this->f->addtocart($goods_id, $qty);
			$_SESSION['total_sum'] = $this->m->total_sum($_SESSION['cart']); // Сумма заказа
			$this->f->total_quantity(); // Кол-во товаров в корзине
			$this->f->redirect();
		}
		// Удаление товара из корзины
		if(isset($_GET['delete'])) {
			$id = abs((int)$_GET['delete']);
			if($id) {
				$this->f->delete_from_cart($id);
			}
			$this->f->redirect();
		}
		if(isset($_POST['order'])) {
			$this->m->add_order();
			$this->f->redirect();
		}
		return $res;
	}
	protected function session_order() {
		$name = isset($_SESSION['order']['name']) ? htmlspecialchars($_SESSION['order']['name']) : NULL;
		$email = isset($_SESSION['order']['email']) ? htmlspecialchars($_SESSION['order']['email']) : NULL;
		$phone = isset($_SESSION['order']['phone']) ? htmlspecialchars($_SESSION['order']['phone']) : NULL;
		$address = isset($_SESSION['order']['address']) ? htmlspecialchars($_SESSION['order']['address']) : NULL;
		$prim = isset($_SESSION['order']['prim']) ? htmlspecialchars($_SESSION['order']['prim']) : NULL;
		$order['name'] = $name;
		$order['email'] = $email;
		$order['phone'] = $phone;
		$order['address'] = $address;
		$order['prim'] = $prim;
		return $order;
	}
}
?>