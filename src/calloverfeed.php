<?php
	require_once "php/cdn.php";
	require_once "navbar.php";
	require_once "php/session.php";
?>
<!DOCTYPE html>
<html>
	<head>
		<script>
			$(document).ready(function(){
				$.ajax({
					url: "php/pullcallover.php",
					dataType: "json",
					method: "get",
					success: function(data)
					{
						var element = '<div class="input-group"> <span class="input-group-addon">Filter</span><input id="filtercallover" type="text" class="form-control" placeholder="Search"/></div><div class="table-responsive"><table class="table table-striped"><thread><tr><th>Firstname</th><th>Lastname</th><th>Called Over</th><th>Timestamp</th></tr></thread><tbody class="searchable">';
						var lastTimestamp;
						$.each(data, function(key, val){
							if(String(lastTimestamp).valueOf() != String(val.Timestamp).valueOf())
							{
								element += '<tr><td><b>NEW CALLOVER</b></td><td></td><td></td><td></td></tr>';
							}
							
							element += '<tr><td>'+ val.StudentFirstname + '</td><td>' + val.StudentSurname + '</td><td>' + val.CalledOver + '</td><td>' + val.Timestamp + '</td></tr>';
							
							lastTimestamp = val.Timestamp;
						});
						element += '</tbody></table></div>';
						$("#callovermaindiv").append(element);
		    			(function ($) {

		        		$('#filtercallover').keyup(function () {
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
		<div class="container" id="callovermaindiv">
		</div>

	</body>
</html>
