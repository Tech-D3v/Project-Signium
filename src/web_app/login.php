<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<link rel="stylesheet" type="text/css" href="css/loginstyle.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
	<script src="js/cookie.js"></script>
	<script src="js/jquery.js"></script>
	<script src="../socket_server/node_modules/socket.io/node_modules/socket.io-client/socket.io.js"></script>
	<script type="text/javascript">
		var socket = io.connect("http://10.11.0.23:8081");
		$(function(){
			$("#incorrect_login").hide();
		})

		function buttonClicked(){
			console.log("clicked");
			var username = $("#username").val().toLowerCase();
			var password = $("#password").val();
			var json = JSON.stringify({username: username});
			socket.emit("socket_service_login", json);
			socket.on("service_socket_verification", function(data)
			{
				data = JSON.parse(data);
				if(data.id == -1)
				{
					$("#incorrect_login").show();
				}
				else
				{
					$.ajax({
						url : "verify_password.php",
						method: "post",
						data: {password: password, hash: data.password},
						success: function(result){
							if(result == true)
							{
								$("#incorrect_login").hide();
								setCookie("student_house", data.house, 365);
								setCookie("student_id", data.id, 365);
								setCookie("student_logged_in", "loggedin", 365);
								window.location.href = "index.php";
								console.log(getCookie("student_house"));
							}
							else
							{
								$("#incorrect_login").show();
							}
						}
					})
				}
			});
		}

	</script>
</head>
<body>
<div class="form">
		<div class="form-group"><label>Username:<input type="text" id="username" name="username" placeholder="Enter Username"></label></div>
		<div class="form-group"><label>Password:<input type="password" id="password" name="password" placeholder="Enter Password"></label></div>
		<div class="form-group"><button type="button" onclick="buttonClicked();" >Login</button></div>
		<p id="incorrect_login">Incorrect Login</p>
	</div>
</body>
</html>
