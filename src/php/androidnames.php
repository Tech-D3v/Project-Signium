<?php
	require_once 'dependencies/meekrodb.2.3.class.php';
	$houseDB = new MeekroDB("localhost", "root", "", $_GET["house"]);
	$row = $houseDB->queryFirstRow("SELECT * FROM names WHERE ID=".$_GET["id"]);
	$timeLastOut = $houseDB->queryFirstRow('SELECT * FROM history WHERE StudentFirstname="'.$row["Firstname"].'" AND StudentSurname="'.$row["Surname"].'" ORDER BY Timestamp DESC');
	$timestamp = new DateTime($timeLastOut["Timestamp"]);
	$date = $timestamp->format("d/M/y");
	$time = $timestamp->format("G:i");
	$row["Time"] = $time;
	$row["Date"] = $date;	
	$row["House"] = $_GET["house"];
	echo json_encode($row);
	
?>