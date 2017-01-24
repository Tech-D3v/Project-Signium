<?php
	$password = $_POST["password"];
	$hash = $_POST["hash"];
	echo password_verify($password, $hash);