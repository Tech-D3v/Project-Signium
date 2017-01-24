<?php
	require_once "database.php";
	$names = DB::query('SELECT * FROM calloverHistory ORDER BY Timestamp DESC, CalledOver DESC');
	echo json_encode($names);
?>