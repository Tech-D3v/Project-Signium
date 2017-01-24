<?php
	require "cdn.php";
	require "database.php";
	$initial = isset($_GET['ids']) ? $_GET['ids'] : null;
	$array = preg_split("/[\s,]+/", $initial );
	foreach($array as $id)
	{
		$intID = intval($id);
		DB::update("callover", array("CalledOver" => "true"), "StudentID=%i", $intID);
	}
	
?>