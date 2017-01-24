<?php
	require "cdn.php";
	require "database.php";
	require "session.php";
	$id = $_SESSION["user_id"];
	DB::update('users', array("Username" => $_POST["username"], "Name" => $_POST["name"]), "ID=%i", $_SESSION["user_id"] );
	session_destroy();
	session_start();
	$_SESSION['user_id'] = $row['ID'];
	$_SESSION['user_name'] = htmlspecialchars_decode($row['Username']);
	$_SESSION['pref_name'] = htmlspecialchars_decode($row['Name']);
	header("location: mainpage.php");

?>