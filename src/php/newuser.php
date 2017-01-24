<?php 
	require_once 'dependencies/meekrodb.2.3.class.php';
	session_start();
	$database = new MeekroDB("localhost", "root", "", "users");
	$username = htmlspecialchars($_POST['username']);
	$prefName = htmlspecialchars($_POST['name']);
	$userLevel = $_POST['role'];
	$sql = "";
	$result = false;
	$passwordHash = password_hash($_POST['password'], PASSWORD_BCRYPT);
	$house = "";
	if($userLevel == "ADMIN")
	{
		$house = "unselected";
	}
	else if(isset($_POST['house']))
	{
		$house = strtolower($_POST['house']);
	}
	else
	{
		$house = $_SESSION["user_house"];
	}
	if(isset($_POST['id']))
	{
		try
			{
				$database->replace('users', array(
					'ID' => $_POST['id'],
		  			'Username' => $username,
		  			'Password' => $passwordHash,
		  			'Name' => $prefName,
					'Role' => $userLevel,
					'House' => $house
				));
			}
			catch(Exception $e)
			{
				header("location: ../createuser.php?usernametaken=true");
			}
			header("location:../userlist.php");
	}
	else
	{
	try
	{
		$database->insert('users', array(
  			'Username' => $username,
  			'Password' => $passwordHash,
  			'Name' => $prefName,
			'Role' => $userLevel,
			'House' => $house
		));
	}
	catch(Exception $e)
	{
		header("location: ../createuser.php?usernametaken=true");
	}
	$row = $database->query("SELECT * FROM users WHERE Username=%s", $username);
	$_SESSION['user_id'] = $row['ID'] ;
	$_SESSION['user_name'] = $_POST['username'];
	$_SESSION['pref_name'] = $_POST['name'];
	$_SESSION['user_house'] = $row["House"];
	header("location: ../mainpage.php");
	}
?>