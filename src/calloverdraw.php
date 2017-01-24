<?php
	require "database.php";
	$names = DB::query('SELECT * FROM names ORDER BY Yeargroup ASC, Surname');
	echo '<div class="container pull-left" style="width: 110em">';
	echo '<div class="row">';
	foreach($names as $person)
	{	
		$nickname = "";
		if($person["Nickname"] != "")
		{
			$nickname = "<br/>(".htmlspecialchars_decode($person["Nickname"]).")";
		}
		$yeargroup = "";
		switch($person["Yeargroup"])
		{
			case "3rd":
				$yeargroup = "Third Form";
				break;
			case "4th":
				$yeargroup = "Fourth Form";
				break;
			case "5th":
				$yeargroup = "Fifth Form";
				break;
			case "LVIth":
				$yeargroup = "Lower Sixth";
				break;
			case "UVIth":
				$yeargroup = "Upper Sixth";
				break;
		}
		echo '<div class="col-sm-1 col-xs-2 col-lg-1">';
		echo '<div class="namelink callover panel" id="'.$person["ID"].'">';
		echo '<span class="glyphicon glyphicon-ok selected selectedcallover" aria-hidden="true" style="visibility: hidden;" id="selectedcallover'.$person["ID"].'"></span>';
		echo '<span class="glyphicon glyphicon-remove notselected notselectedcallover" aria-hidden="true" style="visibility: hidden;" id="notselectedcallover'.$person["ID"].'"></span>';
		echo '<span class="namelinkcontent" id="name'.$person["ID"].'" >'.htmlspecialchars_decode($person["Firstname"]).'<br/> '.htmlspecialchars_decode($person["Surname"]).$nickname.'</span>';
		echo '<br/><span class="namelinkyeargroup" id="yeargroup'.$person["Yeargroup"].'">'.$yeargroup.'</span>';
		echo '</div></div>';


	}
	echo '</div>';

?>