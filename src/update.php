<?php
	require "database.php";
	$initial = isset($_POST['ids']) ? $_POST['ids'] : null;
	$array = preg_split("/[\s,]+/", $initial );
	$location = $_POST["location"];
	$userName = $_POST["user"];
	foreach($array as $id)
	{
		$intID = intval($id);
		$row = DB::queryFirstRow("SELECT * FROM names WHERE ID=".$intID);
		DB::insert("history", array('StudentFirstname' => $row["Firstname"], 'StudentSurname' => $row["Surname"], 'Location' => $location, 'Username' => $userName));
		DB::update("names", array('Location' => $location), "ID=%i", $intID);
	}	

	mysqli_close($conn);
?>