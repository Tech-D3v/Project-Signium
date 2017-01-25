
<!DOCTYPE html>
<html lang="en">
  <head>
    <?php
        require_once "php/session.php";
        require_once "php/cdn.php";
        require_once "php/database.php";
        if ($adminUser == true && $userHouse == "unselected") {
            header("location: adminpage.php");
        }
        echo "<input id='getUsername' type='hidden' value=".$userName.">";
        $_SESSION["signinpage"] = false;
    ?>

	<script src="socket_server/node_modules/socket.io/node_modules/socket.io-client/socket.io.js"></script>
  <script src="js/config.js"></script>
	<script src="js/drawscript.js"></script>
	<script>
	var socket = io.connect(CONFIG_NODE_IP);
     $(document).ready(function() {
    $(".dropdown-toggle").dropdown();
 	});

     function redrawCriteria(criteria, yeargroup)
{
	if(criteria.length > 0)
	{
		criteria = JSON.stringify(criteria);
	}
	else
	{
		criteria = null;
	}
	if(yeargroup.length > 0)
	{
		yeargroup = JSON.stringify(yeargroup);
	}
	else
	{
		yeargroup = null;
	}
	$.ajax({
		url: "php/draw.php",
		method: "get",
		data: {criteriaarray: criteria, yeargrouparray: yeargroup},
		success: function(data)
		{
			$(".cardspace").html(data);
			setUpGrid();
			setUpButtons();
		}
	});
	$.ajax({
  method: 'post',
  url: 'php/download.php',
  dataType: 'json',
	success: function (data) {
  		updateColours(data);
	}
});

}
    	function updateSelectors()
    	{
    	var boxChecked = new Array();
    	var yeargroupChecked = new Array();
    $(".checkboxlocation").each(function(checkIndex, checkValue)
    {

    		if($(checkValue).is(":checked"))
    		{
    			var checkLocation = $(checkValue).val();
    			boxChecked.push(checkLocation);
    		}

    	});
    $(".checkboxyeargroup").each(function(checkIndex, checkValue)
    {

    		if($(checkValue).is(":checked"))
    		{
    			var checkLocation = $(checkValue).val();
    			yeargroupChecked.push(checkLocation);
    		}

    	});
    		redrawCriteria(boxChecked, yeargroupChecked);

 }



</script>

  </head>


  <body>

  <?php
        require_once "navbar.php";
  ?>
  <div class="container-fluid">
	<div class="container pull-left"  style="width: 80%;">
		<div class="cardspace" id="cardspace">
		<script>
		var house = "<?php
        echo $userHouse;
    ?>";
			socket.emit("redraw", house);

		</script>
		</div>

	</div>
	<div class="container pull-right buttoncontainer" style="width:20%;">
		<div class="row">
			<div class="col-sm-12">
				<button class="btn btn-default" onclick="$('#criteriaModal').collapse('toggle');" style="width:100%;">Filter</button>
				<div id="criteriaModal" class="collapse">
					<div class="row">
	       			 <?php
                           $locationsList = DB::query("SELECT * FROM locations");
                           foreach ($locationsList as $row) {
                               echo '<div class="col-sm-4"><input type="checkbox" onclick="updateSelectors();" value="'.$row["Location"].'" class="checkboxlocation" id="checkbox'.$row["Location"].'"/>'.$row["Location"]."</div>";
                           }
                         ?>
	       			  </div>
	       			  <div class="row">
	       			  <div class="col-sm-4"><input type="checkbox" value="3rd" onclick="updateSelectors();" class="checkboxyeargroup" id="checkbox3rd"/>Third Form</div>
	       			  <div class="col-sm-4"><input type="checkbox" value="4th" onclick="updateSelectors();" class="checkboxyeargroup" id="checkbox4th"/>Fourth Form</div>
	       			  <div class="col-sm-4"><input type="checkbox" value="5th" onclick="updateSelectors();" class="checkboxyeargroup" id="checkbox5th"/>Fifth Form</div>
	       			  <div class="col-sm-4"><input type="checkbox" value="LVIth" onclick="updateSelectors();" class="checkboxyeargroup" id="checkboxLVIth"/>Lower Sixth</div>
	       			  <div class="col-sm-4"><input type="checkbox" value="UVIth" onclick="updateSelectors();" class="checkboxyeargroup" id="checkboxUVIth"/>Upper Sixth</div>
	       			  </div>
	     		</div>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-6">
				<button type="button"  class="btn btn-default" onclick="deselect();" style="width: 100%; margin-top: 5%;"
				>Deselect All</button>
			</div>
			<div class="col-sm-6">
				<button type="button"  class="btn btn-default" onclick="select('3rd');" style="width: 100%; margin-top: 5%;"
				>Select All 3rd</button>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-6">
				<button type="button"  class="btn btn-default" onclick="select('4th');" style="width: 100%; margin-top: 5%;"
				>Select All 4th</button>
			</div>
			<div class="col-sm-6">
				<button type="button"  class="btn btn-default" onclick="select('5th');" style="width: 100%; margin-top: 5%;"
				>Select All 5th</button>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-6">
				<button type="button"  class="btn btn-default" onclick="select('LVIth');" style="width: 100%; margin-top: 5%;"
				>Select All LVIth</button>
			</div>
			<div class="col-sm-6">
				<button type="button"  class="btn btn-default" onclick="select('UVIth');" style="width: 100%; margin-top: 5%;"
				>Select All UVIth</button>
			</div>
		</div>
			<h4 style="margin-top: 5%; text-align: center; ">Locations</h4>
			 <div class="buttonspace"></div>
			</div>
		</div>

  </body>
</html>
