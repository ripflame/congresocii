<?php
include_once "notorm/NotORM.php";

$dsn = "mysql:dbname=congreso;host=localhost;charset=utf8";
$pdo = new PDO($dsn, "congreso", "congreso", array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8', PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
$db = new NotORM($pdo);
?>
