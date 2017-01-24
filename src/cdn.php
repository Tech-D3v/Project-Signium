<?php
	require_once 'dependencies/Mobile_Detect.php';
	$detect = new Mobile_Detect;

	echo '<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- jQuery library -->
	<script src="jquery.js"></script>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	<!-- Latest compiled JavaScript -->
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>';
	require_once "dependencies/meekrodb.2.3.class.php";
	if($detect->isMobile() && !$detect->isTablet())
	{
		echo '<link href="mobilestyle.css" type="text/css" rel="stylesheet"/>';
	}
	else
	{
		echo '<link href="style.css" type="text/css" rel="stylesheet"/>';
	}
	echo '<script src="dependencies/jquery.textfill.min.js"></script>';
	echo '<script src="dependencies/jquery.textfill.js"></script>';
	echo '<script src="dependencies/jquery.fittext.js"></script>';
	echo '<script src="dependencies/jscolor.js"></script>';
	echo '<script src="dependencies/jscolor.min.js"></script>';
	//echo '<link href="cssreset.css" rel="stylesheet" type="text/css"/>';
?>