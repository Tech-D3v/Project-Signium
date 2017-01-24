<?php
	require_once "dependencies/meekrodb.2.3.class.php";
	DB::$user = "root";//"viewuser";
	DB::$password = "";//"C1dTgb51";
	DB::$dbName = "users";
	DB::$host = "localhost";
	$array = DB::query("SELECT * FROM houselist");
	$counter = 0;
	$result = array();
	foreach($array as $row)
	{
		$result[$row["House"]] = $row["InHouseCurrently"];
	}
	echo json_encode($result);

?>