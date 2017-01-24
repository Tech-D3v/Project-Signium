<?php
	session_start();
	session_destroy();
	setcookie("loginuser", "",  time() - 3600, "/");
	header("location: index.php");
?>