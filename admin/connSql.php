<?php
	$host = 'localhost';
	$database = 'machine';
	$dbname = 'root';
	$dbpwd = '';
	$pdo = new PDO("mysql:host=$host;dbname=$database", $dbname, $dbpwd);//创建一个pdo对象
	$pdo->exec("set names 'utf8'");
?>