<?php
	require "session.php";
	$time = time()+ (60*60*24*30*12);
	setcookie('signinuser', '',$time);
	setcookie('signinhouse', '', $time);
	setcookie('signinuser', 'viewsigninallowed',$time);
	setcookie('signinhouse', $_GET["house"], $time);
	header("location: ../view.php?house=".$_GET["house"]);
?>