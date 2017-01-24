<?php
	require "session.php";
	$time = time()+ (60*60*24*30*12);
	setcookie('signinuser', 'viewsigninallowed',$time,'/');
	header("location:view.php");
?>