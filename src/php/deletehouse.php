<?php
	require_once "houselist.php";
	echo $_GET['id'];
	foreach($houseList as $row)
  	{
    if($row["ID"] == $_GET['id'])
    {
    	$array = $database->query('SELECT * FROM users');
    	foreach($array as $user)
    	{
    		if($user["House"] == $row["House"])
    		{
    			$database->delete('users', "ID=%i", $user["ID"]);
    		}
    	}
      	$database->delete('houselist', "ID=%i", $row["ID"]);
      	$database->useDB($row["House"]);
      	$database->query("DROP DATABASE ".$row["House"]);

    }
  }
  header("location: ../mainpage.php");

?>