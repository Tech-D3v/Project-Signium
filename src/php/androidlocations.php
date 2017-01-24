<?php
	require_once "dependencies/meekrodb.2.3.class.php";
	$database = new MeekroDB("localhost", "root", "", $_GET["house"]);
	$array = $database->query("SELECT * FROM locations");
	echo json_encode($array);
?>