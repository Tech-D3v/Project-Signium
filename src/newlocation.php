<?php
	require "database.php";
	require "cdn.php";
	

	$location = htmlspecialchars($_POST['location']);
	$colour = "#".$_POST['colour'];
	if(isset($_POST["id"]))
	{
		DB::replace('locations', array(
			'ID' => $_POST["id"],
	  		'Location' => $location,
	  		'Colour' => $colour,
	  		'Heading' => $_POST["heading"]
		));
	}
	else
	{
		DB::insert('locations', array(
	  		'Location' => $location,
	  		'Colour' => $colour,
	  		'Heading' => $_POST["heading"]
		));
	}
	header("location:mainpage.php");

?>