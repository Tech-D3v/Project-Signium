<?php
	require "session.php";
	require "database.php";
	require_once "cdn.php";
	$address = "MANNW@wellingtoncollege.org.uk";
	$subject = "Fire";
	$txt = "List of Names for Alarm: \n";
	$headers = "";
	$query = DB::query("SELECT * FROM names WHERE Location=%s", "In House");
	foreach($query as $row)
	{
		$txt .= "".$row["Firstname"]." ". $row["Surname"]."\n";
	}
	mail($address, $subject, $txt, $headers);
	header("location:index.php");
?>