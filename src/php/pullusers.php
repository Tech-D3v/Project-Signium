<?php
	require "houselist.php";
	$names = $database->query('SELECT * FROM users ORDER BY House, Name');
	echo json_encode($names);
?>