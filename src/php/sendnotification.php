<?php
	require_once "database.php";
	require_once "session.php";

	echo json_decode($_POST["array"]);
	echo $_POST["username"];
	$jsonGet = json_decode($_POST["array"]);
	$json = array();
	echo $_POST["array"];
foreach($jsonGet as $row)
			{
			$result = array();
			$result["ID"] = $row;
			$result["House"] = $currentHouse;
			$result["Content"] = $_POST["content"];
			$result["Username"] = $_POST["username"];
			$json[] = json_encode($result);
			}
	?>
<script src="../socket_server/node_modules/socket.io/node_modules/socket.io-client/socket.io.js"></script>
	<script src="js/socket.js"></script>
	<script>
	var socket = getSocket();
<?php for($i = 0; $i < count($json); $i++){ echo 'socket.emit("service_socket_send_notification", '.$json[$i].');';}?>
		//window.location.href = "mainpage.php";
	</script>;
	