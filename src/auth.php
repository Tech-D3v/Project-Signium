<?php
	require_once 'database.php';
	require_once "PasswordStorage.php";
	$username = htmlspecialchars($_POST['username']);
	$query_raw = DB::queryRaw("SELECT * FROM users WHERE Username=%s", $username);
	$row = $query_raw->fetch_assoc();
	if(PasswordStorage::verify_password( $_POST['password'], $row['Password']) == true)
	{
		session_start();
		$_SESSION['user_id'] = $row['ID'];
		$_SESSION['user_name'] = htmlspecialchars_decode($row['Username']);
		$_SESSION['pref_name'] = htmlspecialchars_decode($row['Name']);
		$_SESSION['user_level'] = $row['Role'];
		header("location: mainpage.php");
	}
	else
	{
		header("location:login.php?invalid=true");
	}
?>