<?php 
	require "database.php";
	require "cdn.php";
	require "PasswordStorage.php";
	$username = htmlspecialchars($_POST['username']);
	$prefName = htmlspecialchars($_POST['name']);
	$userLevel = $_POST['role'];
	$sql = "";
	$result = false;
	$passwordHash = PasswordStorage::create_hash($_POST['password']);
	try
	{
		DB::insert('users', array(
  			'Username' => $username,
  			'Password' => $passwordHash,
  			'Name' => $prefName,
			'Role' => $userLevel
		));
	}
	catch(Exception $e)
	{
		header("location: createuser.php?usernametaken=true");
	}
	$row = DB::query("SELECT ID FROM users WHERE Username =%s", $username);
	$_SESSION['user_id'] = $row['ID'] ;
	$_SESSION['user_name'] = $_POST['username'];
	$_SESSION['pref_name'] = $_POST['name'];
	header("location: mainpage.php");
?>