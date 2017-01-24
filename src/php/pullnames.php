<?php
	require_once "database.php";
	$names = DB::query('SELECT * FROM names ORDER BY Yeargroup ASC, Surname');
	echo json_encode($names);
?>