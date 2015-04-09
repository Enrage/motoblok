<?php defined('SHOP') or die('Access Denied');
class reg extends Core {
	public function get_content() {
		if(isset($_POST['reg'])) {
			$this->m->registration();
			$this->f->redirect();
		}
	}
	protected function session_reg() {
		$login = isset($_SESSION['reg']['login']) ? htmlspecialchars($_SESSION['reg']['login']) : NULL;
		$name = isset($_SESSION['reg']['name']) ? htmlspecialchars($_SESSION['reg']['name']) : NULL;
		$email = isset($_SESSION['reg']['email']) ? htmlspecialchars($_SESSION['reg']['email']) : NULL;
		$phone = isset($_SESSION['reg']['phone']) ? htmlspecialchars($_SESSION['reg']['phone']) : NULL;
		$address = isset($_SESSION['reg']['address']) ? htmlspecialchars($_SESSION['reg']['address']) : NULL;
		$reg['login'] = $login;
		$reg['name'] = $name;
		$reg['email'] = $email;
		$reg['phone'] = $phone;
		$reg['address'] = $address;
		return $reg;
	}
}
?>