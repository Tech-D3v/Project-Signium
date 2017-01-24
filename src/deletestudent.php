<?php
	require "database.php";
	$names = DB::query('SELECT * FROM names ORDER BY Yeargroup ASC, Surname');
	foreach($names as $row)
	{
		if($row["ID"] == $_GET['id'])
		{
			DB::delete('names', "ID=%i", $row["ID"]);
		}
	}
	header("location: mainpage.php");
?>