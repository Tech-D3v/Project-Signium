<?php
	require_once "database.php";
	require_once "cdn.php";
	$userLevel = isset($_SESSION["user_level"]) ? $_SESSION["user_level"] : null;
	$array = DB::query("SELECT * FROM locations");
	$noheaderLocations = [];
	$incollegeLocations = [];
	$outofcollegeLocations = [];
	foreach($array as $row)
	{
		$finalVariable = "";
		if(strcmp($userLevel,"HM") == 0  || strcmp($userLevel,"ADMIN") == 0 || strcmp($userLevel,"Tutor") == 0 )
		{
			$finalVariable .= '
		<input class="btn btn-selector" style="width: 85%; margin-top: 1%;" type="button" id="button'.$row['ID'].'" value="'.htmlspecialchars_decode($row['Location']).'"/>		<script> 
					$(document).ready(function(){
					$("#button'.$row['ID'].'").off("click");
					$("#button'.$row['ID'].'").click(function(){ updateServer("'.$row['Location'].'");
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
			<a href="editlocation.php?id='.$row["ID"].'"><span class="glyphicon glyphicon-edit"></span></a>
			<a data-toggle="modal" href="#deletemodal'.$row["ID"].'"><span class="glyphicon glyphicon-trash" style="padding-left: 2px"></span></a>
			<div id="deletemodal'.$row["ID"].'" class="modal fade" role="dialog">
			  				<div class="modal-dialog">
			   					<div class="modal-content">
			     					<div class="modal-header">
			        					<button type="button" class="close" data-dismiss="modal">&times;</button>
			        				<h4 class="modal-title">Are you sure you would like to delete this student?</h4>
			      				</div>
			      			<div class="modal-body">
			        			<p>There is no recovering this when you delete it.</p>
			      			</div>
			      		<div class="modal-footer">
			      			<a class="btn btn-default" href="deletelocation.php?id='.$row["ID"].'" >Yes</a>
			        		<button type="button" class="btn btn-default" data-dismiss="modal">No</button>
			      		</div>
			    	</div>
			  </div>
			</div>';
		}
		else
		{
			$finalVariable .= '
			<input class="btn btn-selector" style="width: 100%; margin-top: 1%;" type="button" id="button'.$row['ID'].'" value="'.htmlspecialchars_decode($row['Location']).'"/>		<script> 
						$(document).ready(function(){
						$("#button'.$row['ID'].'").off("click");
						$("#button'.$row['ID'].'").click(function(){ updateServer("'.$row['Location'].'");
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
						});});</script>';
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
	printNoHeader($noheaderLocations);
	printInCollege($incollegeLocations);
	printOutOfCollege($outofcollegeLocations);

	function printNoHeader($array)
	{
		foreach($array as $row)
		{
			echo $row;
		}
	}
	function printInCollege($array)
	{
		echo "<h4>In College:</h4>";
		foreach($array as $row)
		{
			echo $row;
		}
	}
	function printOutOfCollege($array)
	{
		echo "<h4>Out of College:</h4>";
		foreach($array as $row)
		{
			
			echo $row;
		}
	}
?>