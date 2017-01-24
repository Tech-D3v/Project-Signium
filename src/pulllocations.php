<?php
	require_once "database.php";
	$names = DB::query('SELECT * FROM history ORDER BY Timestamp DESC');
	echo json_encode($names);
?>