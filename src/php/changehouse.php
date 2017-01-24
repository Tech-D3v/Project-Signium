<?php
	require_once "houselist.php";
	$housename = strtolower($_GET["housename"]);
	$secondColour = $_GET["secondarycolour"] == "enabled" ? true : false;
	if(isset($_GET["id"]))
	{
		$database->replace('houselist', array("ID" => $_GET['id'], "House" => $housename, "StudentCount" => 0, "UserCount" => 0, "HouseInitials" => $_GET["houseinitials"], "HouseColour_1" => '#'.$_GET["housecolour_1"], "HouseColour_2" => '#'.$_GET["housecolour_2"], "BoolSecondColour" => $secondColour));
	}
	header("location: ../adminpage.php");
?>