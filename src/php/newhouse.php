<?php
	require "session.php";
	$housename = strtolower($_POST["housename"]);
	require_once 'dependencies/meekrodb.2.3.class.php';
	$secondColour = $_POST["secondarycolour"] == "enabled" ? true : false;
	$database = new MeekroDB("localhost", "root", "", "users");
	$database->query("CREATE DATABASE ".$housename);
	$database->insert("houselist", array("House" => $housename, "StudentCount" => 0, "UserCount" => 0, "HouseInitials" => $_POST["houseinitials"], "HouseColour_1" => '#'.$_POST["housecolour_1"], "HouseColour_2" => '#'.$_POST["housecolour_2"], "BoolSecondColour" => $secondColour));
	$conn = mysqli_connect("localhost", "root", "", $housename);
	$calloverSQL = 
	"CREATE TABLE `callover` (
  	`ID` int(11) NOT NULL,
  	`StudentID` int(11) NOT NULL,
  	`StudentFirstname` varchar(255) NOT NULL,
  	`StudentSurname` varchar(255) NOT NULL,
  	`CalledOver` varchar(255) NOT NULL
	) ENGINE=InnoDB DEFAULT CHARSET=latin1";
	$calloverHistorySQL = "CREATE TABLE `calloverhistory` (
  	`ID` int(11) NOT NULL,
  	`StudentID` int(11) NOT NULL,
  	`StudentFirstname` varchar(255) NOT NULL,
  	`StudentSurname` varchar(255) NOT NULL,
  	`CalledOver` varchar(255) NOT NULL
	) ENGINE=InnoDB DEFAULT CHARSET=latin1";
	$historySQL = "CREATE TABLE `history` (
	 `ID` int(11) NOT NULL,
	 `StudentFirstname` varchar(255) NOT NULL,
	 `StudentSurname` varchar(255) NOT NULL,
	 `Location` varchar(255) NOT NULL,
	 `Username` varchar(255) NOT NULL,
	 `Timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
	) ENGINE=InnoDB DEFAULT CHARSET=latin1";
	$locationsSQL = "CREATE TABLE `locations` (
  `ID` int(11) NOT NULL,
  `Location` varchar(255) NOT NULL,
  `Colour` varchar(255) NOT NULL,
  `Heading` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1";
$namesSQL = "CREATE TABLE `names` (
  `ID` int(11) NOT NULL,
  `Surname` varchar(255) NOT NULL,
  `Firstname` varchar(255) NOT NULL,
  `Nickname` varchar(255) NOT NULL,
  `Location` varchar(255) NOT NULL,
  `Yeargroup` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1";

$alterCallover = "ALTER TABLE `callover`
  ADD PRIMARY KEY (`ID`)";

$alterCalloverHistory = "ALTER TABLE `calloverhistory`
  ADD PRIMARY KEY (`ID`)";

$alterHistory = "ALTER TABLE `history`
  ADD PRIMARY KEY (`ID`)";

$alterLocations = "ALTER TABLE `locations`
  ADD PRIMARY KEY (`ID`)";

$alterNames = "ALTER TABLE `names`
  ADD PRIMARY KEY (`ID`)";

$aiCallover = "ALTER TABLE `callover`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT";

$aiCalloverHistory = "ALTER TABLE `calloverhistory`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT";

$aiHistory = "ALTER TABLE `history`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT";

$aiLocations = "ALTER TABLE `locations`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT";

$aiNames = "ALTER TABLE `names`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT";

  $q1 = mysqli_query($conn, $calloverSQL);
  $q2 = mysqli_query($conn, $calloverHistorySQL);
  $q3 = mysqli_query($conn, $historySQL);
  $q4 = mysqli_query($conn, $locationsSQL);
  $q5 = mysqli_query($conn, $namesSQL);
  $q6 = mysqli_query($conn, $alterCallover);
  $q7 = mysqli_query($conn, $alterCalloverHistory);
  $q8 = mysqli_query($conn, $alterHistory);
  $q9 = mysqli_query($conn, $alterLocations);
  $q10 = mysqli_query($conn, $alterNames);
  $q11 = mysqli_query($conn, $aiCallover);
  $q12 = mysqli_query($conn, $aiCalloverHistory);
  $q13 = mysqli_query($conn, $aiHistory);
  $q14 = mysqli_query($conn, $aiLocations);
  $q15 = mysqli_query($conn, $aiNames);
  mysqli_close($conn);
  
  $currentDB = new MeekroDB("localhost", "root", "", $housename);
  $currentDB->insert("locations", array("Location" => "In House", "Colour" => "#00CC00", "Heading" => "No Group"));
  header("location:../adminpage.php");
?>