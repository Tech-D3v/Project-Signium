
<!DOCTYPE html>
<html lang="en">
  <head>
    <?php
		require "php/cdn.php";
		require "php/databaseView.php";
		if(!isset($_SESSION))
		{
			session_start();
		}
		$_SESSION["signinpage"] = true;
	?>
	<script src="socket_server/node_modules/socket.io/node_modules/socket.io-client/socket.io.js"></script>
	<script src="js/drawscript.js"></script>

	<link rel="stylesheet" type="text/css" href="css/style.css">
	<meta name="viewport" content="width=device-width, user-scalable=no">
	<title>Sign In Page</title>
  </head>


  <body>
  <div class="container-fluid">
	<div class="container pull-left"  style="width: 85%;">
		<div class="cardspace" id="cardspace">
		<script>
		var socket = io.connect("http://10.11.0.23:8081");
		var house = "<?php 
		echo $_GET['house'];
	?>";
	$("#getHouse").val(house);
			socket.emit("redraw", house);
			</script>
		</div>
		<input class="btn bottombutton" id="bottominhouse" value="In House">
		<input class="btn bottombutton" id="bottomlessons" value="Lessons" style="float:right">
	</div>
	<div class="container pull-right buttoncontainer" style="width:15%;">
	<button class="btn btn-default" id="selector" onclick="$('#criteriaModal').collapse('toggle');" style="width:100%;">Select</button>
	<div id="criteriaModal" class="collapse">
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
		</div>
			<div class="buttonspace"></div>
			</div>
		</div>
	</div>
	<input id="getUsername" type="hidden" value="Sign In PC"/>
	<input id="getHouse" type="hidden"/>
  </body>
</html>