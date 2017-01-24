<?php
	require "cdn.php";
	require "database.php";
	date_default_timezone_set("Europe/London");
	$userLevel = isset($_SESSION["user_level"]) ? $_SESSION["user_level"] : null;
	$names = DB::query('SELECT * FROM names ORDER BY Yeargroup ASC, Surname');
	/*Building The Names*/
	$counter = 0;
	$lastYearGroup = "Third Form";
	echo '<div class="row">';
	foreach($names as $person)
	{	
		$array = DB::queryFirstRow('SELECT * FROM history WHERE StudentFirstname="'.$person["Firstname"].'" AND StudentSurname="'.$person["Surname"].'" ORDER BY Timestamp DESC');
		$timestamp = new DateTime($array["Timestamp"]);
		$date = $timestamp->format("d/M/y");
		$time = $timestamp->format("G:i");
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
		$class = "";
		if($detect->isMobile() && !$detect->isTablet())
		{
			$class = "";
		}
		else
		{
			$class = "col-sm-1 col-xs-2 col-lg-1";
		}
		echo '<div class="'.$class.'">';
		echo '<div class="namelink panel" id="'.$person["ID"].'">';
		echo '<span class="glyphicon glyphicon-ok selected" aria-hidden="true" style="visibility: hidden;" id="selected'.$person["ID"].'"></span>';
		echo '<span class="namelinkcontent" id="name'.$person["ID"].'" >'.htmlspecialchars_decode($person["Firstname"]).'<br/> '.htmlspecialchars_decode($person["Surname"]).$nickname.'</span>';
		echo '<br/><span class="namelinkyeargroup" id="yeargroup'.$person["Yeargroup"].'">'.$yeargroup.'</span>';
		if(strcmp($userLevel,"HM") == 0 || strcmp($userLevel,"ADMIN") == 0 || strcmp($userLevel, "Tutor") == 0)
		{
		if(strcmp($userLevel,"HM") == 0 || strcmp($userLevel,"ADMIN") == 0 )
		{
			echo '<br/><a href="editstudent.php?id='.$person["ID"].'" class="editlinks"><span class="glyphicon glyphicon-edit"></span></a>';
			echo '<br/><a data-toggle="modal" href="#deletemodal'.$person["ID"].'" class="deletelinks"><span class="glyphicon glyphicon-trash"></span></a>';
			
		}
		echo '<br/><p class="datetime time">'.$time.'</p>';
			echo '<br/><p class="datetime date">'.$date.'</p>';
		}
		echo '</div>';
		echo '</div>';
		echo '<div id="deletemodal'.$person["ID"].'" class="modal fade" role="dialog">
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
      				<a class="btn btn-default" href="deletestudent.php?id='.$person["ID"].'" >Yes</a>
        			<button type="button" class="btn btn-default" data-dismiss="modal">No</button>
      			</div>
    		</div>

  			</div>
			</div>';
		$lastYearGroup = $yeargroup;
		/*if($person["Location"] == "In House")
		{
			echo "<script>
        	$( '#".$incrementLoop."' ).css('background-color', '#dff0d8');
    		</script>";
		}
		if($person["Location"] == "Library")
		{
			echo "<script>
        	$( '#".$incrementLoop."' ).css('background-color', '#d8dff0');
    		</script>";
		}*/
		
	}
	echo '</div>';

?>