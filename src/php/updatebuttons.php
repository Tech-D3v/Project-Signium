<?php
    if (!isset($_SESSION)) {
        session_start();
    }
    $signInPage = $_SESSION["signinpage"];
    if ($signInPage == true) {
        require_once "databaseView.php";
    } else {
        require_once "database.php";
    }
    $userLevel = isset($_SESSION["user_level"]) ? $_SESSION["user_level"] : null;
    $array = DB::query("SELECT * FROM locations");
    $noheaderLocations = [];
    $incollegeLocations = [];
    $outofcollegeLocations = [];
    $bottomtally = 0;
    $bottomVariable = "";
    $bottomScript = "";
    foreach ($array as $row) {
        $finalVariable = "";
        if ((strcmp($userLevel, "HM") == 0  || strcmp($userLevel, "ADMIN") == 0 || strcmp($userLevel, "Tutor") == 0) && $signInPage == false) {
            if ($row["Location"] == "In House") {
                $finalVariable .= '<div class="btn-selector-parent" id="parentbutton'.$row['ID'].'">
		<input class="btn btn-selector" style="" type="button" id="button'.$row['ID'].'" value="'.htmlspecialchars_decode($row['Location']).'"/>		<script>
					$(document).ready(function(){
					$("#button'.$row['ID'].'").off("click");
					$("#button'.$row['ID'].'").click(function(){ updateServer("'.$row['Location'].'", "'.$currentHouse.'", "'.$row['Colour'].'");
					});
					$("#button'.$row['ID'].'").css("background-color", "'.$row['Colour'].'");
					$("#button'.$row['ID'].'").css("font-weight", "normal");
					$("#button'.$row['ID'].'").css("background-color", "'.$row['Colour'].'");
					$("#button'.$row['ID'].'").css("color", "#FFFFFF");
					});</script>
			<a href="editlocation.php?id='.$row["ID"].'" class="btn-gly"><span class="glyphicon glyphicon-edit" style="color: #FFFFFF;"></span></a></div>';
            } elseif ($row["Location"] == "Lessons") {
                $finalVariable .= '<div class="btn-selector-parent" id="parentbutton'.$row['ID'].'">
		<input class="btn btn-selector" style="" type="button" id="button'.$row['ID'].'" value="'.htmlspecialchars_decode($row['Location']).'"/>		<script>
					$(document).ready(function(){
					$("#button'.$row['ID'].'").off("click");
					$("#button'.$row['ID'].'").click(function(){ updateServer("'.$row['Location'].'", "'.$currentHouse.'", "'.$row['Colour'].'");
					});
					$("#button'.$row['ID'].'").css("background-color", "'.$row['Colour'].'");
						$("#button'.$row['ID'].'").css("font-weight", "normal");
						$("#button'.$row['ID'].'").css("background-color", "'.$row['Colour'].'");
						$("#button'.$row['ID'].'").css("color", "#FFFFFF");
					});</script>
			<a href="editlocation.php?id='.$row["ID"].'" class="btn-gly"><span class="glyphicon glyphicon-edit" style="color: #FFFFFF;"></span></a></div>';
            } else {
                $finalVariable .= '
		<div class="btn-selector-parent">
		<input class="btn btn-selector" style="" type="button" id="button'.$row['ID'].'" value="'.htmlspecialchars_decode($row['Location']).'"/>		<script>
					$(document).ready(function(){
					$("#button'.$row['ID'].'").off("click");
					$("#button'.$row['ID'].'").click(function(){ updateServer("'.$row['Location'].'","'.$currentHouse.'", "'.$row['Colour'].'");
					});
					$("#button'.$row['ID'].'").css("background-color", "'.$row['Colour'].'");
						$("#button'.$row['ID'].'").css("font-weight", "normal");
						$("#button'.$row['ID'].'").css("background-color", "'.$row['Colour'].'");
						$("#button'.$row['ID'].'").css("color", "#FFFFFF");
					});</script>
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
            }
        } else {
            if ($row["BottomSpace"] != "true") {
                $finalVariable .= '<div class="btn-selector-parent">
			<input class="btn btn-selector" type="button" id="button'.$row['ID'].'" value="'.htmlspecialchars_decode($row['Location']).'"/>		<script>
						$(document).ready(function(){
						$("#button'.$row['ID'].'").off("click");
						$("#button'.$row['ID'].'").click(function(){ updateServer("'.$row['Location'].'","'.$currentHouse.'", "'.$row['Colour'].'");
						});
						$("#button'.$row['ID'].'").css("background-color", "'.$row['Colour'].'");
							$("#button'.$row['ID'].'").css("font-weight", "normal");
							$("#button'.$row['ID'].'").css("background-color", "'.$row['Colour'].'");
							$("#button'.$row['ID'].'").css("color", "#FFFFFF");
						});</script></div>';
            } else {
                $bottomVariable .= '<input class="btn bottombutton" type="button" id="button'.$row['ID'].'" value="'.htmlspecialchars_decode($row['Location']).'"/>';
                $bottomScript .= '$(document).ready(function(){
						$("#button'.$row['ID'].'").off("click");
						$("#button'.$row['ID'].'").click(function(){ updateServer("'.$row['Location'].'","'.$currentHouse.'", "'.$row['Colour'].'");
						});
						$("#button'.$row['ID'].'").css("background-color", "'.$row['Colour'].'");
							$("#button'.$row['ID'].'").css("font-weight", "normal");
							$("#button'.$row['ID'].'").css("background-color", "'.$row['Colour'].'");
							$("#button'.$row['ID'].'").css("color", "#FFFFFF");
						});';
                $bottomtally++;
            }
        }
        switch ($row["Heading"]) {
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
    if ($signInPage) {
        $bottompercent = (100 / $bottomtally);
        echo '<script>
				$("#bottomcheck").html(\' '.$bottomVariable.' \');
				'.$bottomScript.'
        	$(".bottombutton").css("width", "'.$bottompercent.'%");
				</script>';
    }
    printNoHeader($noheaderLocations);
    printInCollege($incollegeLocations);
    printOutOfCollege($outofcollegeLocations);

    echo '<div class="btn-selector-parent"><input data-toggle="modal" href="#othermodal" class="btn btn-selector btn-default" type="button" id="buttonother" value="Other" style="color: #000000;"/></div><div id="othermodal" class="modal fade" role="dialog">
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
			    	</div></div></div>';



    function printNoHeader($array)
    {
        foreach ($array as $row) {
            echo $row;
        }
    }
    function printInCollege($array)
    {
        echo '<h4 style="text-align:center; width: 100%; margin-top: 10%">In College</h4>';
        foreach ($array as $row) {
            echo $row;
        }
    }
    function printOutOfCollege($array)
    {
        echo '<h4 style="text-align:center; width: 100%; margin-top: 10%">Out of College</h4>';
        foreach ($array as $row) {
            echo $row;
        }
    }
