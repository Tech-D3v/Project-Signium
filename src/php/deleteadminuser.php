<?php 
	require "houselist.php";
	$users = $database->query("SELECT * FROM users");
	foreach ($users as $user) {
		if($user["ID"] == $_GET['id'])
		{
			$database->delete('users', "ID=%i", $user["ID"]);
		}
	}
	header("location:../userlist.php");
?>