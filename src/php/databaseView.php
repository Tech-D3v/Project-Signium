<?php
  	require_once "dependencies/meekrodb.2.3.class.php";
  	if(!isset($_SESSION))
      {
          session_start();
      }
  	DB::$user = "root";
  	DB::$password = "";
  	DB::$dbName = $_SESSION["signinhouse"];
  	DB::$host = "localhost";
  	$currentHouse = $_SESSION["signinhouse"];
  ?>
