<?php
	require_once "database.php";
	$names = DB::query('SELECT * FROM history ORDER BY Timestamp DESC');
	$filter = $_GET["filter"];
	$final = Array();
	if($filter != "null")
	{

		foreach($names as $name)
		{
			if(preg_match('/'.$filter.'/i', $name["StudentFirstname"]) || preg_match('/'.$filter.'/i', $name["StudentSurname"]) || preg_match('/'.$filter.'/i', $name["Location"]) || preg_match('/'.$filter.'/i', $name["Timestamp"]) || preg_match('/'.$filter.'/i', $name["Username"]))
			{
				$final[] = $name;
			}
		}
	}
	else
	{
	for($i = 0; $i < $_GET["amount"]; $i++)
	{
		$final[$i] = $names[$i];
	}
}
	echo json_encode($final);
?>