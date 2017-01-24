<?php
	require_once "dependencies/meekrodb.2.3.class.php";
	$database = new MeekroDB("localhost", "root", "",  $_GET["house"]);
	$location = urldecode($_GET["location"]);
	$id = $_GET["id"];
	$row = $database->queryFirstRow("SELECT * FROM names WHERE ID=".$id);
	$database->insert("history", array('StudentFirstname' => $row["Firstname"], 'StudentSurname' => $row["Surname"], 'Location' => $location, 'Username' => 'Application'));
	$database->update("names", array('Location' => $location), "ID=%i", $id);
	$timeLastOut = $database->queryFirstRow('SELECT * FROM history WHERE StudentFirstname="'.$row["Firstname"].'" AND StudentSurname="'.$row["Surname"].'" ORDER BY Timestamp DESC');
	$timestamp = new DateTime($timeLastOut["Timestamp"]);
	$row["Date"] = $timestamp->format("d/M/y");
	$row["Time"] = $timestamp->format("G:i");
	$colour = $database->queryFirstRow('SELECT * FROM locations WHERE Location="'.$location.'"');
	$row["LocationColour"] = $colour["Colour"];
	$row["Location"] = $colour["Location"];
	echo json_encode($row);	
?>