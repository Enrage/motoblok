<?php
define('SHOP', true);
session_start();
class enter {
	public $mysqli;
	public function __construct() {
		$this->mysqli = db::getObject();
	}
}
include_once '../../db.php';
include_once '../../config.php';
if(isset($_SESSION['auth']['admin'])) {
	if($_SESSION['auth']['admin']) {
		header("Location: admin_motoblok/");
		exit();
	}
}
$link = new enter();
if($_POST) {
	try {
		$login_motoblok = trim($_POST['login_motoblok']);
		$pass_motoblok = trim($_POST['pass_motoblok']);
		$query = "SELECT name, login, pass FROM customers WHERE login = ? AND adminer = 1 LIMIT 1";
		if(!$stmt = $link->mysqli->prepare($query)) throw new Exception("Error Prepare Login");
		else {
			$stmt->bind_param('s', $login_motoblok);
			$stmt->execute();
			$stmt->bind_result($name, $login, $pass);
			$rows = array();
			while($stmt->fetch()) {
				$rows[] = array($name, $login, $pass);
			}
			$stmt->close();
			if($pass == md5($pass_motoblok)) {
				$_SESSION['auth']['admin'] = htmlspecialchars($login);
				$_SESSION['auth']['name'] = $name;
				header("Location: ../");
				exit();
			} else {
				$_SESSION['res'] = '<div class="error">Логин или пароль не совпадает!</div>';
				header("Location: {$_SERVER['PHP_SELF']}");
				exit();
			}
			$stmt->close();
		}
	} catch(Exception $e) {
		print 'Ошибка: '.$e->getMessage();
	}
}?>
<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="utf-8">
	<title>Вход в админ-панель мотоблоков</title>
	<link rel="stylesheet" href="../views/css/style.css">
</head>
<body class="body">
<div class="main">
	<div class="form_login">
	<h2>Administration Panel Motoblok</h2>
	<p><?php
		if(isset($_SESSION['res'])) {
			echo $_SESSION['res'];
			unset($_SESSION['res']);}?></p>
		<form action="" method="post" autocomplete="off" id="login">
			<p><input type="text" name="login_motoblok" placeholder="Username"></p>
			<p><input type="password" name="pass_motoblok" placeholder="Password"></p>
			<p><input id="subm" type="submit" value="Login"></p>
		</form>
	</div>
</div>
</body>
</html>