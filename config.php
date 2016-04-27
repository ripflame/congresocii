<?php
include_once "notorm/NotORM.php";

$dsn = "mysql:dbname=congreso;host=localhost";
$pdo = new PDO($dsn, "congreso", "congreso");
$db = new NotORM($pdo);
?>
