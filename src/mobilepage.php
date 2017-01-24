
<!DOCTYPE html>
<html lang="en">
  <head>
    <?php
    	require "navbar.php";
		require_once "cdn.php";
		require_once "database.php";
		require_once "session.php";
		echo "<input id='getUsername' type='hidden' value=".$userName.">";	
	?>
	<script src="ajax.js"></script>
	<script>
	function updateServer(data)
	{
		var ids = [];
		var userName = $('#getUsername').val();
		console.log(userName);
		$('.namelink').each(function()
		{
			$(this).fitText();
			if(String($('#selected'+$(this).attr('id')).css("visibility")).valueOf() == String("visible").valueOf())
			{
				ids.push($(this).attr('id'));
			}
		});
		var result = ids.toString();
		$(document).ready(function()
		{
			$.ajax({url: "update.php", method: "POST", data: {ids: result, location: data, user: userName},success: function(e)
			{		
				//console.log(e);	
				window.location.reload(true);
			}});
		});
	}

	function deselect()
	{
		$('.namelink').each(function()
		{	
			if(String($('#selected'+$(this).attr('id')).css("visibility")).valueOf() == String("visible").valueOf())
			{
				$('#selected'+$(this).attr('id')).css("visibility", "hidden")
			}
		});
	}
	function select(yeargroup)
	{
		var IDs = $(".namelink") .map(function() { return this.id; }) .get();
		var increment = 0;
		$('.namelinkyeargroup').each(function()
		{
			switch(yeargroup)
			{
				case "3rd":
					if(String($(this).attr('id')).valueOf() == "yeargroup3rd")
					{
						$('#selected'+IDs[increment]).css("visibility", "visible");
					}
					break;
				case "4th":
					if(String($(this).attr('id')).valueOf() == "yeargroup4th")
					{
						$('#selected'+IDs[increment]).css("visibility", "visible");
					}
					break;
				case "5th":
					if(String($(this).attr('id')).valueOf() == "yeargroup5th")
					{
						$('#selected'+IDs[increment]).css("visibility", "visible");
					}
					break;
				case "LVIth":
					if(String($(this).attr('id')).valueOf() == "yeargroupLVIth")
					{
						$('#selected'+IDs[increment]).css("visibility", "visible");
					}
					break;
				case "UVIth":
					if(String($(this).attr('id')).valueOf() == "yeargroupUVIth")
					{
						$('#selected'+IDs[increment]).css("visibility", "visible");
					}
					break;
			}
			increment++;
		});
	}

     var time = new Date().getTime();
     $(document.body).bind("mousemove keypress", function(e) {
         time = new Date().getTime();
     });

     function refresh() {
         if(new Date().getTime() - time >= 60000) 
             window.location.reload(true);
         else 
             setTimeout(refresh, 10000);
     }

     setTimeout(refresh, 10000);
	</script>
  </head>


  <body>
<!-- snip -->
  <div class="container-fluid">
	<div style="width: 100%;">
		<div>
		 <?php require "draw.php" ?>
		</div>
	</div>
	<div class="container-fluid" style="width:100%; padding-top: 10px">
		<input class="btn btn-danger" onclick="location.href='fire.php';" type="button" value="FIRE ALARM" style="width: 100%; height: 5em; font-size: 16px;" />
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
			<h4 style="margin-top: 5%">Locations:</h4>
			 <?php
			 	require "updatebuttons.php";
			 ?>
			</div>
			
		</div>
	</div>
  </body>
</html>
	



