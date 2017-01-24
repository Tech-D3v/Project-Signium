<?php
	require_once 'database.php';
	require_once "PasswordStorage.php";
	require_once "session.php";
	$query_raw = DB::queryRaw("SELECT * FROM users WHERE Username=%s", $userName);
	$row = $query_raw->fetch_assoc();
	if(PasswordStorage::verify_password( $_POST['oldpassword'], $row['Password']) == true)
	{
		 if(strcmp ($_POST['newpassword'] , $_POST['confirmpassword']) == 0)
		 {
		 	DB::update("users", array( 'Password' => PasswordStorage::create_hash($_POST['newpassword']) ), "Username=%s", $userName);
		 	header("location:mainpage.php");
		 }
		 else
		{
			header("location:changepassword.php?passwordnomatch=true");
		}
	}
	else
	{
		header("location:changepassword.php?passwordnomatchserver=true");
	}
?>