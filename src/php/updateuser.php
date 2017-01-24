<?php
	require "cdn.php";
	require "session.php";
	require_once 'dependencies/meekrodb.2.3.class.php';
	$database = new MeekroDB("localhost", "root", "", "users");
	$id = $_SESSION["user_id"];
	$database->update('users', array("Username" => $_POST["username"], "Name" => $_POST["name"]), "ID=%i", $_SESSION["user_id"]);
	session_destroy();
	header("location:../mainpage.php");

?>