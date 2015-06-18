<?php
defined('SHOP') or die('Access Denied');
class orders extends Core_Admin {
	private $perpage;
	public function get_content() {
		$this->perpage = PERPAGE_ORDERS;
		$pos = $this->pos();
		$start_pos = $pos['start_pos'];
		if(isset($_GET['status']) && $_GET['status'] == 0) {
			$status = " WHERE orders.status = '0'";
		} else $status = null;
		$orders = $this->m->orders($status, $start_pos, $this->perpage);
		$this->order_confirm();
		$this->order_delete();
		return $orders;
	}

	protected function order_confirm() {
		if(isset($_GET['confirm'])) {
			$order_id = (int)$_GET['confirm'];
			if($this->m->confirm_order($order_id)) {
				$_SESSION['answer'] = "<div class='success'>Статус заказа №{$order_id} успешно подтвержден</div>";
			} else {
				$_SESSION['answer'] = "<div class='error'>Статус заказа №{$order_id} не удалось изменить. Возможно заказа с таким номером нет или он уже подтвержден.</div>";
			}
			$this->f->redirect('?view=orders&status=0');
		}
	}

	protected function order_delete() {
		if(isset($_GET['del_order'])) {
			$order_id = (int)$_GET['del_order'];
			if($this->m->del_order($order_id)) {
				$_SESSION['answer'] = "<div class='success'>Заказ №{$order_id} удален</div>";
			} else {
				$_SESSION['answer'] = "<div class='error'>Ошибка! Возможно этот заказ уже был удален.</div>";
			}
			$this->f->redirect('?view=orders');
		}
	}

	protected function pos() {
		if(isset($_GET['page'])) {
			$page = abs((int)$_GET['page']);
			if($page < 1) $page = 1;
		} else $page = 1;
		if(isset($_GET['status']) && $_GET['status'] == 0) {
			$status = " WHERE orders.status = '0'";
		} else $status = null;
		$count_rows = $this->m->count_orders($status);
		$pages_count = ceil($count_rows / $this->perpage);
		if(empty($pages_count)) $pages_count = 1;
		if($page > $pages_count) $page = $pages_count;
		$start_pos = ($page - 1) * $this->perpage;
		$result['start_pos'] = $start_pos;
		$result['page'] = $page;
		$result['pages_count'] = $pages_count;
		return $result;
	}
}
?>