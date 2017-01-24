<?php
	require_once "database.php";
	$names = DB::query('SELECT * FROM names');
	echo json_encode($names);
?>