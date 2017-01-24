<?php
	require "database.php";
	require "cdn.php";

	DB::query("CREATE USER 'root'@'%' IDENTIFIED BY 'test'");
?>