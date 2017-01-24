<?php
	session_start();
	$loggedIn = isset($_SESSION['user_id']);
	$userName = isset($_SESSION['user_name']) ? $_SESSION['user_name'] : null;
	$prefName = isset($_SESSION['pref_name']) ? $_SESSION['pref_name'] : null;
	$userLevel = isset($_SESSION["user_level"]) ? $_SESSION["user_level"] : null;
		if($loggedIn == false)
		{
			header("location:login.php");
		}
?>