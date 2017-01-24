<?php
	require_once 'dependencies/meekrodb.2.3.class.php';
	$database = new MeekroDB("localhost", "root", "", "users");
	$houseList = $database->query("SELECT * FROM houselist");
	$houseListASC = $database->query("SELECT House FROM houselist ORDER BY House");
	$houseListJSON = json_encode($database->query("SELECT House FROM houselist"));
?>