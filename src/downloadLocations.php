<?php
	require_once "database.php";
	$names = DB::query('SELECT * FROM locations');
	echo json_encode($names);
?>