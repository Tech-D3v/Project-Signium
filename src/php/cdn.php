<?php
	require_once 'dependencies/Mobile_Detect.php';
	$detect = new Mobile_Detect;

	echo '<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- jQuery library -->
	<script src="php/dependencies/jquery.js"></script>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="php/dependencies/bootstrap-3.3.6-dist/css/bootstrap.min.css">
	<!-- Latest compiled JavaScript -->
	<script src="php/dependencies/bootstrap-3.3.6-dist/js/bootstrap.min.js"></script>';
	require_once "dependencies/meekrodb.2.3.class.php";
	echo '<script src="php/dependencies/jquery.textfill.min.js"></script>';
	echo '<script src="php/dependencies/jquery.textfill.js"></script>';
	//echo '<script src="dependencies/jquery.fittext.js"></script>';
	echo '<script src="php/dependencies/jscolor.js"></script>';
	echo '<script src="php/dependencies/jscolor.min.js"></script>';
	//echo '<link href="cssreset.css" rel="stylesheet" type="text/css"/>';
?>