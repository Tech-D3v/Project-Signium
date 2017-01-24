<?php
	require_once 'dependencies/meekrodb.2.3.class.php';
	$database = new MeekroDB("localhost", "root", "", "users");
	$houselist = $database->query("SELECT * FROM houselist");
	foreach($houselist as $house)
	{
		$houseDB = new MeekroDB("localhost", "root", "", $house["House"]);
		$names = $houseDB->query("SELECT * FROM names");
		foreach($names as $name)
		{

			if(strtolower($name["Usercode"]) == $_POST["username"])
			{	
					echo json_encode(array('id' => $name["ID"], 'password' => $name["Password"], 'house' => $house["House"], 'staff' => 'false'));
					exit;
			}
		}
	}
	echo json_encode(array('id' => '-1', 'password' => '', 'house' => ''));
?>