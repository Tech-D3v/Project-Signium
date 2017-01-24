<?php
	if(!isset($_SESSION))
	{
		session_start();
	}
	$signInPage = $_SESSION["signinpage"];
	if($signInPage == true)
	{
		require_once "databaseView.php";
	}
	else
	{
		require_once "database.php";
	}
	$userLevel = isset($_SESSION["user_level"]) ? $_SESSION["user_level"] : null;
	$array = DB::query("SELECT * FROM locations");
	$inhouse = DB::queryFirstRow("SELECT * FROM locations WHERE Location='In House'");
	$noheaderLocations = [];
	$incollegeLocations = [];
	$outofcollegeLocations = [];
	$inhousedata;
	$lessondata;
	foreach($array as $row)
	{
		if($row["Location"] == "In House")
		{
			$inhousedata = $row;
		}
		else if($row["Location"] == "Lessons")
		{
			$lessondata = $row;
		}
		$finalVariable = "";
		if((strcmp($userLevel,"HM") == 0  || strcmp($userLevel,"ADMIN") == 0 || strcmp($userLevel,"Tutor") == 0) && $signInPage == false)
		{
			if($row["Location"] == "In House" )
		{
			$finalVariable .= '<div class="btn-selector-parent" id="parentbutton'.$row['ID'].'">
		<input class="btn btn-selector" style="" type="button" id="button'.$row['ID'].'" value="'.htmlspecialchars_decode($row['Location']).'"/>		<script> 
					$(document).ready(function(){
					$("#button'.$row['ID'].'").off("click");
					$("#button'.$row['ID'].'").click(function(){ updateServer("'.$row['Location'].'", "'.$currentHouse.'", "'.$row['Colour'].'");
					});
					$("#button'.$row['ID'].'").css("background-color", "'.$row['Colour'].'");
					
					$("#button'.$row['ID'].'").hover(function(){
						$("#button'.$row['ID'].'").css("font-weight", "bold");
						$("#button'.$row['ID'].'").css("background-color", "#FFFFFF");
						$("#button'.$row['ID'].'").css("color", "'.$row['Colour'].'");
					}, function(){
						$("#button'.$row['ID'].'").css("font-weight", "normal");
						$("#button'.$row['ID'].'").css("background-color", "'.$row['Colour'].'");
						$("#button'.$row['ID'].'").css("color", "#FFFFFF");
					});});</script>
			<a href="editlocation.php?id='.$row["ID"].'" class="btn-gly"><span class="glyphicon glyphicon-edit" style="color: #FFFFFF;"></span></a></div>';
		}
		else if($row["Location"] == "Lessons")
		{
			$finalVariable .= '<div class="btn-selector-parent" id="parentbutton'.$row['ID'].'">
		<input class="btn btn-selector" style="" type="button" id="button'.$row['ID'].'" value="'.htmlspecialchars_decode($row['Location']).'"/>		<script> 
					$(document).ready(function(){
					$("#button'.$row['ID'].'").off("click");
					$("#button'.$row['ID'].'").click(function(){ updateServer("'.$row['Location'].'", "'.$currentHouse.'", "'.$row['Colour'].'");
					});
					$("#button'.$row['ID'].'").css("background-color", "'.$row['Colour'].'");
					
					$("#button'.$row['ID'].'").hover(function(){
						$("#button'.$row['ID'].'").css("font-weight", "bold");
						$("#button'.$row['ID'].'").css("background-color", "#FFFFFF");
						$("#button'.$row['ID'].'").css("color", "'.$row['Colour'].'");
					}, function(){
						$("#button'.$row['ID'].'").css("font-weight", "normal");
						$("#button'.$row['ID'].'").css("background-color", "'.$row['Colour'].'");
						$("#button'.$row['ID'].'").css("color", "#FFFFFF");
					});});</script>
			<a href="editlocation.php?id='.$row["ID"].'" class="btn-gly"><span class="glyphicon glyphicon-edit" style="color: #FFFFFF;"></span></a></div>';
		}
		else{

			$finalVariable .= '
		<div class="btn-selector-parent">
		<input class="btn btn-selector" style="" type="button" id="button'.$row['ID'].'" value="'.htmlspecialchars_decode($row['Location']).'"/>		<script> 
					$(document).ready(function(){
					$("#button'.$row['ID'].'").off("click");
					$("#button'.$row['ID'].'").click(function(){ updateServer("'.$row['Location'].'","'.$currentHouse.'", "'.$row['Colour'].'");
					});
					$("#button'.$row['ID'].'").css("background-color", "'.$row['Colour'].'");
					$("#button'.$row['ID'].'").hover(function(){
						$("#button'.$row['ID'].'").css("font-weight", "bold");
						$("#button'.$row['ID'].'").css("background-color", "#FFFFFF");
						$("#button'.$row['ID'].'").css("color", "'.$row['Colour'].'");
					}, function(){
						$("#button'.$row['ID'].'").css("font-weight", "normal");
						$("#button'.$row['ID'].'").css("background-color", "'.$row['Colour'].'");
						$("#button'.$row['ID'].'").css("color", "#FFFFFF");
					});});</script>
			<a href="editlocation.php?id='.$row["ID"].'" class="btn-gly" style="position: absolute;"><span class="glyphicon glyphicon-edit" style="color: #FFFFFF;"></span></a>
			<a data-toggle="modal" href="#deletemodal'.$row["ID"].'" style="position: absolute; left: 87%; text-size: 1vw;" class="btn-gly"><span class="glyphicon glyphicon-trash " style=" color: #FFFFFF;"></span></a></div>
			<div id="deletemodal'.$row["ID"].'" class="modal fade" role="dialog">
			  				<div class="modal-dialog">
			   					<div class="modal-content">
			     					<div class="modal-header">
			        					<button type="button" class="close" data-dismiss="modal">&times;</button>
			        				<h4 class="modal-title">Are you sure you would like to delete this location?</h4>
			      				</div>
			      			<div class="modal-body">
			        			<p>There is no recovering this when you delete it.</p>
			      			</div>
			      		<div class="modal-footer">
			      			<a class="btn btn-default" href="php/deletelocation.php?id='.$row["ID"].'" >Yes</a>
			        		<button type="button" class="btn btn-default" data-dismiss="modal">No</button>
			      		</div>
			    	</div>
			  </div>
			</div>';
		}}
		else
		{
			if($row["Location"] != "In House" && $row["Location"] != "Lessons")
			{
			$finalVariable .= '<div class="btn-selector-parent">
			<input class="btn btn-selector" type="button" id="button'.$row['ID'].'" value="'.htmlspecialchars_decode($row['Location']).'"/>		<script> 
						$(document).ready(function(){
						$("#button'.$row['ID'].'").off("click");
						$("#button'.$row['ID'].'").click(function(){ updateServer("'.$row['Location'].'","'.$currentHouse.'", "'.$row['Colour'].'");
						});
						$("#button'.$row['ID'].'").css("background-color", "'.$row['Colour'].'");
						$("#button'.$row['ID'].'").hover(function(){
							$("#button'.$row['ID'].'").css("font-weight", "bold");
							$("#button'.$row['ID'].'").css("background-color", "#FFFFFF");
							$("#button'.$row['ID'].'").css("color", "'.$row['Colour'].'");
						}, function(){
							$("#button'.$row['ID'].'").css("font-weight", "normal");
							$("#button'.$row['ID'].'").css("background-color", "'.$row['Colour'].'");
							$("#button'.$row['ID'].'").css("color", "#FFFFFF");
						});});</script></div>';
					}
		}
		switch($row["Heading"])
		{
			case "No Group":
				$noheaderLocations[] = $finalVariable;
				break;
			case "In College":
				$incollegeLocations[] = $finalVariable;
				break;
			case "Out of College":
				$outofcollegeLocations[] = $finalVariable;
		}
	
					
	}
	if($signInPage)
	{
		echo '<script>
					$("#bottominhouse").css("background-color", "'.$inhousedata["Colour"].'");
					$("#bottominhouse").click(function(){  updateServer("'.$inhousedata["Location"].'", "'.$currentHouse.'",  "'.$inhousedata["Colour"].'");});
					$("#bottominhouse").hover(function()
					{
						$("#bottominhouse").css("background-color", "#FFFFFF");
						$("#bottominhouse").css("color",  "'.$inhousedata["Colour"].'");
						$("#bottominhouse").css("font-weight", "bold");
					}, function(){
						$("#bottominhouse").css("color", "#FFFFFF");
						$("#bottominhouse").css("background-color",  "'.$inhousedata["Colour"].'");
						$("#bottominhouse").css("font-weight", "normal");
					});
					$("#bottomlessons").css("background-color",  "'.$lessondata["Colour"].'");
					$("#bottomlessons").click(function(){ updateServer("'.$lessondata["Location"].'", "'.$currentHouse.'",  "'.$lessondata["Colour"].'");});
					$("#bottomlessons").hover(function()
					{
						$("#bottomlessons").css("background-color", "#FFFFFF");
						$("#bottomlessons").css("color",  "'.$lessondata["Colour"].'");
						$("#bottomlessons").css("font-weight", "bold");
					}, function(){
						$("#bottomlessons").css("color", "#FFFFFF");
						$("#bottomlessons").css("background-color",  "'.$lessondata["Colour"].'");
						$("#bottomlessons").css("font-weight", "normal");
					});</script>';

	}
	printNoHeader($noheaderLocations);
	printInCollege($incollegeLocations);
	printOutOfCollege($outofcollegeLocations);

	/*echo '<div class="btn-selector-parent"><input data-toggle="modal" href="#othermodal" class="btn btn-selector btn-default" type="button" id="buttonother" value="Other" style="color: #000000;"/></div><div id="othermodal" class="modal fade" role="dialog">
							<div class="modal-dialog">
			   					<div class="modal-content">
			     					<div class="modal-header">
			        					 <button type="button" class="close" data-dismiss="modal" onclick="window.location.reload();">&times;</button>
			        				<h4 class="modal-title">Other</h4>
			      				</div>
			      			<div class="modal-body">
			        			<input class="form-control" type="text" id="otherinput">
			      			</div>
			      		<div class="modal-footer">
			      			<button class="btn btn-default" data-dismiss="modal" onclick="updateServerCustom();">Submit</button>
			      		</div>
			    	</div></div></div>';*/


	
	function printNoHeader($array)
	{
		foreach($array as $row)
		{
			echo $row;
		}
	}
	function printInCollege($array)
	{
		echo '<h4 style="text-align:center; width: 100%; margin-top: 10%">In College</h4>';
		foreach($array as $row)
		{
			echo $row;
		}
	}
	function printOutOfCollege($array)
	{
		echo '<h4 style="text-align:center; width: 100%; margin-top: 10%">Out of College</h4>';
		foreach($array as $row)
		{
			
			echo $row;
		}
	}
?>