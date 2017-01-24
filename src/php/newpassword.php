<?php
	require_once 'dependencies/meekrodb.2.3.class.php';
	$database = new MeekroDB("localhost", "root", "", "users");
	require_once "session.php"; 
	$query_raw = $database->queryRaw("SELECT * FROM users WHERE Username=%s", $userName);
	$row = $query_raw->fetch_assoc();
	if(password_hash($_POST['oldpassword'], PASSWORD_BCRYPT) == $row['Password'])
	{
		 if(strcmp ($_POST['newpassword'] , $_POST['confirmpassword']) == 0)
		 {
		 	DB::update("users", array( 'Password' => password_hash($_POST['newpassword'], PASSWORD_BCRYPT), "Username=%s", $userName);
		 	header("location:../mainpage.php");
		 }
		 else
		{
			header("location:../edituser.php?passwordnomatch=true&changepassword=true");
		}
	}
	else
	{
		header("location:../edituser.php?passwordnomatchserver=true&changepassword=true");
	}
?>