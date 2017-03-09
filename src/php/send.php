<?php
	require "database.php";
	$password = $_POST["password"];
	if(isset($_POST["id"]))
	{
		if($password == "")
		{
				DB::update('names', array('Firstname' => htmlspecialchars($_POST["firstname"]),'Surname' => htmlspecialchars($_POST["surname"]), 'Nickname' => htmlspecialchars($_POST["nickname"]), 'Yeargroup' => $_POST["yeargroup"], 'Location' => $_POST["location"], 'Usercode' => $_POST["usercode"]), "ID=%i", $_POST["id"]);
		}
		else
		{
			$password = password_hash($_POST['password'], PASSWORD_BCRYPT);
		DB::replace('names', array('ID' => $_POST["id"], 'Firstname' => htmlspecialchars($_POST["firstname"]),'Surname' => htmlspecialchars($_POST["surname"]), 'Nickname' => htmlspecialchars($_POST["nickname"]), 'Yeargroup' => $_POST["yeargroup"], 'Location' => $_POST["location"], 'Usercode' => $_POST["usercode"], 'Password' => $password));
		}
	}
	else
	{
		$password = password_hash($_POST['password'], PASSWORD_BCRYPT);
		DB::insert('names', array('Firstname' => htmlspecialchars($_POST["firstname"]),'Surname' => htmlspecialchars($_POST["surname"]), 'Nickname' => htmlspecialchars($_POST["nickname"]), 'Yeargroup' => $_POST["yeargroup"], 'Location' => 'In House', 'Usercode' => $_POST["usercode"], 'Password' => $password));

	}
	header("location:../mainpage.php");

?>
z
