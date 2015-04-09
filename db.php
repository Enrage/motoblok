<?php
defined('SHOP') or die('Access Denied');
require_once 'config.php';
class db {
	private $db;
	public static $mysqli = null;
	private function __construct() {
		$ob_mysqli = new mysqli(HOST, USER, PASS, DB);
		if(!$ob_mysqli->connect_error) {
			$this->db = $ob_mysqli;
		} else {
			die("No connect");
		}
	}
	public static function getObject() {
		if(self::$mysqli == null) {
			$obj = new db();
			self::$mysqli = $obj->db;
			self::$mysqli->query("SET NAMES 'UTF8'");
		}
		return self::$mysqli;
	}
}
?>