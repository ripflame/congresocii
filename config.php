<?php
include_once "notorm/NotORM.php";

$dsn = "mysql:dbname=congreso;host=localhost";
$pdo = new PDO($dsn, "admin", "pinto66",array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
$db = new NotORM($pdo);
?>
