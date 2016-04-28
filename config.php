<?php
// include_once "notorm/NotORM.php";
// 
// $dsn = "mysql:dbname=congreso;host=localhost";
// $pdo = new PDO($dsn, "congreso", "congreso");
// $db = new NotORM($pdo);

$db_hostname = "localhost";
$db_user = "congreso";
$db_password = "congreso";
$db_name = "congreso";

$db = new mysqli( $db_hostname, $db_user, $db_password, $db_name );
$db->set_charset( 'utf8' );
?>
