
<!DOCTYPE html>
<html lang="en">
  <head>
    <?php
        require_once "php/cdn.php";
        require_once "php/database.php";
        require_once "php/houselist.php";
        ?>
	<script src="socket_server/node_modules/socket.io/node_modules/socket.io-client/socket.io.js"></script>
  <script src="js/config.js"></script>
	<script>
	var socket = io.connect(CONFIG_NODE_IP);
	socket.emit('inhouse_number_update');
	socket.on('update_inhouse_number', function(number)
		{
			var houselist = JSON.parse('<?php echo $houseListJSON; ?>');
			var increment = 0;
			houselist.forEach(function(house)
			{
				number = number.replace(/['"]+/g, '');
				number = number.replace(/[{}]+/g, '');
				var numberArray = number.split(',');
				var finalNumber = numberArray[increment].split(':')
				document.getElementById("inhouse&" + house.House).innerHTML = "In House Currently: " + finalNumber[1];
				increment++;
			});

		});
     $(document).ready(function() {
    $(".dropdown-toggle").dropdown();
});

	</script>
	<link rel="stylesheet" href="css/style.css" type="text/css"/>
  </head>

  <body>
  <?php
        require_once "navbaradmin.php";
  ?>
  <div class="container-fluid">
	<div class="container pull-left"  style="width: 100%;">
		<div>
		 <?php
            require_once 'php/dependencies/meekrodb.2.3.class.php';

            $database = new MeekroDB("localhost", "root", "", "users");
            $houses = $database->query("SELECT * FROM houselist ORDER BY House");
            foreach ($houses as $house) {
                echo '<div class="panel panel-default adminpanel"><div class="panel-heading"><h3>'.ucfirst($house["House"]).'</h3></div><div class="panel-content adminpanelcontent"><p class="studentcount adminpanelcontent">Student Count: '.$house["StudentCount"].'</p><p class="inhousecount" id="inhouse&'.$house["House"].'">In House Currently: </p><p class="colours">Colours: </p><div class="colour-1" style="background-color:'.$house["HouseColour_1"].'"><br/><a data-toggle="modal" href="#deletemodal'.$house["ID"].'" class="deleteadmin"><span class="glyphicon glyphicon-trash"></span></a></div>'; /*<a href="edithouse.php?id='.$house["ID"].'" class="editadmin"><span class="glyphicon glyphicon-edit"></span></a>*/
                if ($house["BoolSecondColour"] == true) {
                    echo '<div class="colour-2" style="background-color:'.$house["HouseColour_2"].'"></div>';
                }

                echo '<br/><p class="usercount">User Count: '.$house["UserCount"].'</p><br/></div></div>';
                echo '<div id="deletemodal'.$house["ID"].'" class="modal fade" role="dialog">
	  				<div class="modal-dialog">
	   					<div class="modal-content">
	     					<div class="modal-header">
	        					<button type="button" class="close" data-dismiss="modal">&times;</button>
	        				<h4 class="modal-title">Are you sure you would like to delete this house?</h4>
	      				</div>
	      			<div class="modal-body">
	        			<p>There is no recovering this when you delete it. <br/>This is an entire house that you could be deleting.</p>
	      			</div>
	      			<div class="modal-footer">
	      				<a class="btn btn-default" href="deletehouse.php?id='.$house["ID"].'" >Yes</a>
	        			<button type="button" class="btn btn-default" data-dismiss="modal">No</button>
	      			</div>
	    		</div>

	  			</div>
				</div>';
            }
          ?>
		</div>
	</div>
  </body>
</html>
