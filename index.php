<?php
define('SHOP', true);
session_start();
header("Content-Type:text/html;charset=UTF-8");
require_once 'config.php';
function __autoload($c) {
	if(file_exists("controller/".$c.".php")) {
		require_once 'controller/'.$c.'.php';
	} elseif(file_exists("model/".$c.".php")) {
		require_once 'model/'.$c.'.php';
	}
}
$functions = new functions();
$model = new model();
if(isset($_POST['auth'])) {
	$model->authorization();
	if(isset($_SESSION['auth']['user'])) {
		// Если пользователь авторизовался
		echo "<p>Добро пожаловать,<br><span>{$_SESSION['auth']['user']}</span></p>";
		echo '<a href="?view=logout">Выход</a>';
		die;
	} else {
		echo $_SESSION['auth']['error'];
		unset($_SESSION['auth']);
		die;
	}
	// $functions->redirect();
}
if(isset($_GET['view'])) {
	if($_GET['view'] == 'logout') {
		$functions->logout();
		$functions->redirect();
	}
}
$class = isset($_GET['view']) ? trim(strip_tags($_GET['view'])) : 'main';
if(class_exists($class)) {
	$obj = new $class;
	$obj->get_body($class);
}
?>