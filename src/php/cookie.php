<?php
	if(isset($_COOKIE['signinuser']))
	{
		if(strcmp($_COOKIE['signinuser'], 'viewsigninallowed') < 0 || strcmp($_COOKIE['signinuser'], 'viewsigninallowed') > 0 ){    
			header("location: ../mainpage.php");
		}
	}
	else
	{
		header("location: ../mainpage.php");
	}
?>