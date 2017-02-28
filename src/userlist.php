
<!DOCTYPE html>
<html>
	<head>
		<?php
			require_once "php/cdn.php";
			require_once "navbaradmin.php";
		?>
		<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
		<script>
			$(document).ready(function(){
				$.ajax({
					url: "php/pullusers.php",
					dataType: "json",
					method: "get",
					success: function(data)
					{
						var element = '<div class="input-group"> <span class="input-group-addon">Filter</span><input id="filter" type="text" class="form-control" placeholder="Search"/></div><div class="table-responsive"><table class="table table-striped"><thread><tr><th>Username</th><th>Preferred Name</th><th>House</th><th>Role</th><th>Edit</th><th>Delete</th></tr></thread><tbody class="searchable">';
						$.each(data, function(key, val){
							element += '<tr><td>'+ val.Username + '</td><td>' + val.Name + '</td><td>' + val.House + '</td><td>' + val.Role + '</td><td><a href="editadminuser.php?id=' + val.ID + '"><span class="glyphicon glyphicon-edit"></span></a></td><td><a data-toggle="modal" href="#deletemodaladmin' + val.ID + '"><span class="glyphicon glyphicon-trash"></span></a></td></tr>';
							element += '<div id="deletemodaladmin' + val.ID + '" class="modal fade" role="dialog"><div class="modal-dialog"><div class="modal-content"><div class="modal-header">					<button type="button" class="close" data-dismiss="modal">&times;</button>		<h4 class="modal-title">Are you sure you would like to delete this user?</h4>      				</div><div class="modal-body"><p>There is no recovering this when you delete it.</p> 			</div>  			<div class="modal-footer"><a class="btn btn-default" href="php/deleteadminuser.php?id=' + val.ID + '" >Yes</a>    			<button type="button" class="btn btn-default" data-dismiss="modal">No</button></div>';
						});
						element += '</tbody></table></div>';
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
