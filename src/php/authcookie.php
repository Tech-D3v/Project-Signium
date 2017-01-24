<?php
	require_once 'dependencies/meekrodb.2.3.class.php';
	$database = new MeekroDB("localhost", "root", "", "users");
	$username = $_COOKIE["loginuser"];
	$query_raw = $database->queryRaw("SELECT * FROM users WHERE Username=%s", $username);
	$row = $query_raw->fetch_assoc(); 
	setcookie("signinhouse", "null", time() + (60*60*24*30*12));
	session_start();
	$_SESSION['user_id'] = $row['ID'];
	$_SESSION['user_name'] = htmlspecialchars_decode($row['Username']);
	$_SESSION['pref_name'] = htmlspecialchars_decode($row['Name']);
	$_SESSION['user_level'] = $row['Role'];
	$_SESSION["user_house"] = "";
	if($row['Role'] == "ADMIN")
	{
		$_SESSION['user_house'] = "unselected";
	}
	else
	{
		$_SESSION['user_house'] = $row['House'];
	}
	header("location: ../mainpage.php");
?>