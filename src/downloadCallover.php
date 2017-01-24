<?php
	require_once "database.php";
	$names = DB::query('SELECT * FROM callover');
	echo json_encode($names);
?>