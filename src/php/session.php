<?php
	require_once "config.php";
	if(!isset($_SESSION))
	{
		session_start();
	}
	$loggedIn = isset($_SESSION['user_id']);
	$userName = isset($_SESSION['user_name']) ? $_SESSION['user_name'] : null;
	$prefName = isset($_SESSION['pref_name']) ? $_SESSION['pref_name'] : null;
	$userLevel = isset($_SESSION["user_level"]) ? $_SESSION["user_level"] : null;
	$userHouse = isset($_SESSION["user_house"]) ? $_SESSION["user_house"] : null;
	$adminUser = $_SESSION["user_level"] == "ADMIN" ? true : false;
		if($loggedIn == false)
		{
			header("location: ../login.php");
		}
?>