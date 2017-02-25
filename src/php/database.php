<?php
	require_once "dependencies/meekrodb.2.3.class.php";
	if(!isset($_SESSION))
    {
        session_start();
    }
	DB::$user = "root";//"viewuser";
	DB::$password = "";//"C1dTgb51";
	DB::$dbName = $_SESSION["user_house"];
	DB::$host = "localhost";
	$currentHouse = $_SESSION["user_house"];
?>
