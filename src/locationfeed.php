
<!DOCTYPE html>
<html>
	<head>
		<?php
			require_once "php/cdn.php";
			require_once "navbar.php";
		?>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="css/style.css"/>
		<script>
		var amount = 50;
			$(document).ready(function(){


    			showMore(0);
					$("#filter").on("input", function(){
						showMore(0, $("#filter").val());
					});

});

			function showMore(amountIncrease, filter = "null")
			{
				amount += amountIncrease;


				$.ajax({
					url: "php/pulllocations.php",
					data: {amount: amount, filter: filter},
					dataType: "json",
					method: "get",
					beforeSend: function()
					{
							$("#loading-icon").addClass("ajax-loading-icon");
					},
					success: function(data)
					{
						$("#loading-icon").removeClass("ajax-loading-icon");
						var element = "";
						element += '<div class="table-responsive"><table class="table table-striped"><thread><tr><th>Firstname</th><th>Lastname</th><th>Location</th><th>Timestamp</th><th>Approved By</th></tr></thread><tbody class="searchable">';
						$.each(data, function(key, val){
							element += '<tr><td>'+ val.StudentFirstname + '</td><td>' + val.StudentSurname + '</td><td>' + val.Location + '</td><td>' + val.Timestamp + '</td><td>' + val.Username + '</td></tr>';
						});
						element += '</tbody></table><input type="button" class="btn btn-default" value="Show More" onclick="showMore(50);"/></div>';
						$("#maindiv").html(element);
					}
				});
			}


		</script>
	</head>
	<body>

		<div class="container">
		<div class="input-group"> <span class="input-group-addon">Filter</span><input id="filter" type="text" class="form-control" placeholder="Search"/></div>
		<div id="maindiv">
		</div>
		<div id="loading-icon" style="margin-left: 50%; margin-right: 50%; margin-top: 25%; z-index: 5000; postion: fixed;">
		</div>
		</div>

	</body>
</html>
