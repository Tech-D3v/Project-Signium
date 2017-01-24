<?php
	if(isset($_COOKIE['signinuser']))
	{
		if(strcmp($_COOKIE['signinuser'], 'viewsigninallowed') < 0 || strcmp($_COOKIE['signinuser'], 'viewsigninallowed') > 0 ){    
			header("location:blankpage.php");
		}
	}
	else
	{
		header("location:blankpage.php");
	}
?>