<?php
  require_once "php/session.php";
	require_once "php/database.php";
	require_once "navbar.php";	
	require_once "php/cdn.php";
	$array = array();
	$names = DB::query('SELECT * FROM names ORDER BY Yeargroup ASC, Surname');
	foreach($names as $row)
	{
    foreach($_POST["selected"] as $select)
    {
        if($select == $row["ID"])
        {
          $array[] = $row["ID"];
        }
    }
   
		
	}
  $jsonArray = json_encode($array);
  echo '<p id="array" style="visibility: hidden">'.$jsonArray.'</p>';
  ?>

<!DOCTYPE html>
<html>
	<head>
  <script src="socket_server/node_modules/socket.io/node_modules/socket.io-client/socket.io.js"></script>
    <script src="js/socket.js"></script>

    <script>
    var socket = getSocket();
      function sendNotification()
      {
          console.log("Clicked");
          var house = "<?php echo $currentHouse; ?>";
          var content = $("#content").val();
          var username = $("#username").val();
          console.log(username);
          var array = JSON.parse($("#array").text());
          console.log(array);
          array.forEach(function(json)
          {
            var result = {ID: json, House: house, Content: content, Username: username};
            socket.emit("service_socket_send_notification", JSON.stringify(result));
          }); 
      }
    </script>
		<link rel="stylesheet" href="style.css" type="text/css"/>
	</head>
	
	<body>
		
		<div class="container">
    <h1 class="page-header">Send a notification</h1>
      <div class="form-group">
        <label class="control-label" for="content">Content:</label>
        <div class=""> 
          <textarea rows="4" cols="50" class="form-control" id="content" name="content" placeholder="Enter Content"></textarea>
        </div>
      </div>
      <input type="hidden" value="<?php echo $userName;?>" name="username" id="username"/>
      <div class="form-group"> 
        <div class="">
          <button onclick="sendNotification();" class="btn btn-default">Finish</button>
        </div>
      </div>
    </div>
	</body>
</html>