<?php
	require_once "php/cdn.php";
	require_once "php/session.php";
	require_once "navbar.php";

?>
<!DOCTYPE html>
<html>
	<head>
		<script>
			$(document).ready(function(){
				$.ajax({
					url: "php/pullnames.php",
					dataType: "json",
					method: "get",
					success: function(data)
					{
						var element = '<form action="php/createnotification.php" method="post" role="form"><input type="submit" class="form-control btn btn-primary" value="Send Notification"/><div class="input-group" style="padding-top: 1em"> <span class="input-group-addon">Filter</span><input id="filter" type="text" class="form-control" placeholder="Search"/></div><div class="table-responsive"><table class="table table-striped"><thread><tr><th>Firstname</th><th>Lastname</th><th>Select</th></tr></thread><tbody class="searchable">';
						$.each(data, function(key, val){
							element += '<tr><td>'+ val.Firstname + '</td><td>' + val.Surname + '</td><td><input type="checkbox" name="selected[]" value="' + val.ID + '"></input></a></td></tr>';
						});
						element += '</tbody></table></div></form>';
						$("#maindiv").append(element);
    			(function ($) {

        		$('#filter').keyup(function () {

            	var rex = new RegExp($(this).val(), 'i');
            	$('.searchable tr').hide();
            	$('.searchable tr').filter(function () {
                return rex.test($(this).text());
            	}).show();

        		})

    			}(jQuery));
					}

				});


});
		</script>
	</head>
	<body>
		<div class="container" id="maindiv">
		</div>

	</body>
</html>
