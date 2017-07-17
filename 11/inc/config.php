<?php
session_start();

$dsn = 'mysql:dbname=utilisateurs;host=localhost;charset=UTF8';

try {
	$pdo = new PDO($dsn, 'root', '');
}
catch (Exception $e) {
	echo $e->getMessage();
}
