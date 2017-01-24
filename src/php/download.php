<?php
	require_once "database.php";
	$names = DB::query('SELECT * FROM names');
	for($i = 0; $i < count($names); $i++)
	{
		$names[$i]["Location"] = htmlspecialchars_decode($names[$i]["Location"]);
	}
	echo json_encode($names);
?>