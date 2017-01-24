<?php
	require "cdn.php";
	require "database.php";
	$table = DB::query("SELECT * FROM callover");
	foreach($table as $row)
	{
		DB::insert("calloverHistory", array('StudentFirstname' => $row["StudentFirstname"], 'StudentSurname' => $row["StudentSurname"], 'CalledOver' => $row["CalledOver"]));
	}
	$result = DB::query("TRUNCATE callover");
	$array = DB::query("SELECT * FROM names");
	foreach($array as $row)
	{
		DB::insert("callover", array("StudentID" => $row["ID"], "StudentFirstname" => $row["Firstname"], "StudentSurname" => $row["Surname"], "CalledOver" => "false"));
	}

	header("location: callover.php");

?>