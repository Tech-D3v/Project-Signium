<?php
	require "database.php";
	if(isset($_POST["id"]))
	{
		DB::replace('names', array('ID' => $_POST["id"], 'Firstname' => htmlspecialchars($_POST["firstname"]),'Surname' => htmlspecialchars($_POST["surname"]), 'Nickname' => htmlspecialchars($_POST["nickname"]), 'Yeargroup' => $_POST["yeargroup"], 'Location' => 'In House'));
	}
	else
	{
		DB::insert('names', array('Firstname' => htmlspecialchars($_POST["firstname"]),'Surname' => htmlspecialchars($_POST["surname"]), 'Nickname' => htmlspecialchars($_POST["nickname"]), 'Yeargroup' => $_POST["yeargroup"], 'Location' => 'In House'));

	}
	header("location:mainpage.php");

?>