<?php
	require "cdn.php";
	require "database.php";
	$array = DB::query("SELECT * FROM callover");
	$second = DB::query("SELECT * FROM names");
	foreach($array as $row)
	{
		foreach($second as $row2)
		{
			if($row["StudentFirstname"] == $row["Firstname"])
		}
	}
?>