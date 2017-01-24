<?php
	require_once "dependencies/meekrodb.2.3.class.php";
	DB::$user = "root";//"viewuser";
	DB::$password = "";//"C1dTgb51";
	$cookieResult = $_COOKIE["signinhouse"] != "null" ? $_COOKIE["signinhouse"] : null;
	DB::$dbName = $cookieResult;
	DB::$host = "localhost";
	$currentHouse = $cookieResult;
?>