<?php
	session_start();
	$_SESSION["user_house"] = $_GET["house"];
	echo $_SESSION["user_house"];
	header("location:../mainpage.php");
?>