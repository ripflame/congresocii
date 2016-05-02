<?php
include_once "notorm/NotORM.php";

$dsn = "mysql:dbname=congreso;host=localhost";
$pdo = new PDO($dsn, "congreso", "congreso", array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
$db = new NotORM($pdo);
?>
