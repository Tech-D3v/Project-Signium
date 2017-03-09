<!DOCTYPE html>
<html>
<head>
<link rel="apple-touch-icon" sizes="57x57" href="icons/iphone_non_retina.png" />
<link rel="apple-touch-icon" sizes="72x72" href="icons/ipad_non_retina.png" />
<link rel="apple-touch-icon" sizes="114x114" href="icons/iphone_retina.png" />
<link rel="apple-touch-icon" sizes="144x144" href="icons/ipad_retina.png" />
	<link rel="stylesheet" type="text/css" href="css/style.css"/>
	<link rel="stylesheet" type="text/css" href="css/font-awesome.min.css"/>
	<script type="text/javascript" src="js/jquery.js"></script>
	<script src="../socket_server/node_modules/socket.io/node_modules/socket.io-client/socket.io.js"></script>
	<script type="text/javascript" src="js/cookie.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
	<meta name="apple-mobile-web-app-title" content="Wellington College Sign In System">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="white">
	<script type="text/javascript">
	var socket = io.connect("http://10.11.0.23:8081");
	if(getCookie("student_logged_in") != "loggedin")
	{
		window.location.href = "login.php";
	}
	else
	{
	$(document).ready(function(){
		var mainID = getCookie("student_id");
		var house = getCookie("student_house");
		var locationArray;
		socket.emit("socket_service_request_locations", house);
		socket.on("service_socket_request_locations", function(packet){
			var json = JSON.parse(packet);
			locationArray = Array();
			var noGroupList = Array();
			var inCollegeList = Array();
			var outOfCollegeList = Array();
			for(var i = 0; i < json.length; i++)
			{
				var object = json[i];
				var name = object.Location;
				var colour = object.Colour;
				var heading = object.Heading;
				var id = object.ID;
				locationArray.push({id: id, name: name, colour: colour});
				switch(heading)
				{
					case "No Group":
							noGroupList.push({id: id, name: name, colour: colour});
							break;
					case "In College":
							inCollegeList.push({id: id, name: name, colour: colour});
							break;
					case "Out of College":
							outOfCollegeList.push({id: id, name: name, colour: colour});
							break;
				}
			}
			var html = '<ul id="drawer">';
			noGroupList.forEach(function(location){
					html += '<li><a id="' + location.id + '"  style="color: #FFFFFF; background-color: ' + location.colour + '" class="btn-selector">' + location.name + '</a></li>';
			});
			html += '<li><h4> In College</h4></li>';
			inCollegeList.forEach(function(location){
					html += '<li><a id="' + location.id + '"  style="color: #FFFFFF; background-color: ' + location.colour + '" class="btn-selector">' + location.name + '</a></li>';
			});
			html += '<li><h4>Out of College</h4></li>';
			outOfCollegeList.forEach(function(location){
					html += '<li><a id="' + location.id + '" style="color: #FFFFFF; background-color: ' + location.colour + '" class="btn-selector">' + location.name + '</a></li>';
			});
			html += '</ul>';
			$(".buttonspace").html(html);
			$.each(json, function(key, val){
				$("#" + val.ID).click(function(){
					console.log(mainID);
					updateLocation(val.Location, mainID, house);
				});
			});
		});
		var json_1 = JSON.stringify({ id: mainID, house: house});
		socket.emit("socket_service_request_student_info", json_1);
		socket.on("service_socket_student_info", function(data)
		{
			data = JSON.parse(data);
			var name = data.Firstname + " " + data.Surname;
			var nickname = data.Nickname;
			var yeargroup = data.Yeargroup;
			switch(yeargroup)
			{
				case "3rd":
					yeargroup = "Third Form";
					break;
				case "4th":
					yeargroup = "Fourth Form";
					break;
				case "5th":
					yeargroup = "Fifth Form";
					break;
				case "LVIth":
					yeargroup = "Lower Sixth";
					break;
				case "UVIth":
					yeargroup = "Upper Sixth";
					break;
			}
			var location = data.Location;
			var time = data.Time;
			var date = data.Date;
			var showHouse = house.toLowerCase().replace(/\b[a-z]/g, function(letter) {
    			return letter.toUpperCase();
			});
			$(".name").text(name);
			$(".nickname").text(nickname);
			$(".yeargroup").text(yeargroup);
			$(".location").text(location);
			$(".date").text(date);
			$(".time").text(time);
			$(".house").text(showHouse);
			var index;
			locationArray.forEach(function(flocation)
			{
				if(flocation.name == location)
				{
					index = flocation;
				}
			});
			console.log(index);
			$(".student-card").css("border-color", index.colour)
		});
		socket.on("update_student_location", function(packet)
		{
			console.log(mainID);
			console.log(packet);
			packet = JSON.parse(packet);
			if(packet.house == house)
			{
				if(packet.id == mainID)
				{

					$(".location").text(packet.location);
					$(".date").text(packet.date);
					$(".time").text(packet.time);
					$(".student-card").css("border-color", packet.colour);
				}
			}
		});
	});
}
		function updateLocation(location, id, house)
		{
			var json = JSON.stringify({location: location, id: id, house: house});
			console.log(json);
			socket.emit("update_student_location_server", json);
		}
		function logout()
		{
			setCookie("student_logged_in", "false", 365);
			setCookie("student_house", "", 365);
			setCookie("student_id", "", 365);
			window.location.href = "login.php";
		}


		function responseNav() {
    var x = document.getElementById("mainNav");
    if (x.className === "topnav") {
        x.className += " responsive";
    } else {
        x.className = "topnav";
    }
}
	</script>
	<title>WCSIS</title>
</head>
<body>
	<div class="topnav" id="mainNav">
		<a class="logout" onclick="logout();">Logout</a>
  	<a href="javascript:void(0);" class="icon" onclick="responseNav()">&#9776;</a>
	</div>
	<div class="container-fluid">
	<div class="container" id="page-content">


		</div>
		<input type="checkbox" id="drawer-toggle" name="drawer-toggle"/>
		<label for="drawer-toggle" id="drawer-toggle-label"></label>
		<header>Header</header>
			<nav class="buttonspace">
			</nav>
		</div>
</body>
</html>
