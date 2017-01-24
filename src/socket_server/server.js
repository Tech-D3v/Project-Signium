var socketio = require("socket.io");
var express = require("express");
var http = require("http");

var app = express();
app.use(function(req, res, next) {
    res.header("Access-Control-Allow-Origin", "*");
    res.header("Access-Control-Allow-Headers", "Origin, X-Requested-With, Content-Type, Accept");
    next();
});
var server = http.createServer(app);

var request = require("request");
var Entities = require("html-entities").AllHtmlEntities;
var entities = new Entities();

var io = socketio.listen(server);
var connectedSockets = [];
io.on('connect', function(socket)
{
	socket.emit('android_handshake');
	connectedSockets.push(socket);
	console.log("Client Connected");
	socket.on("inhouse_number_update", function()
		{
			request.get({headers: {'content-type' : 'application/x-www-form-urlencoded'},
			url: 'http://localhost/php/updateinhouse.php'}, function(error, response, body)
			{
			connectedSockets.forEach(function(clientSocket)
			{
				clientSocket.emit("update_inhouse_number", body);
			});
		});
		});
	socket.on('update_student_location', function(packet)
	{
		connectedSockets.forEach(function(clientSocket){
			clientSocket.emit('update_student_location', packet);
		});
	});
	socket.on('update_student_location_server', function(packet)
	{
		packet = JSON.parse(packet);
		packet.location = entities.encode(packet.location);
		packet.location = encodeURIComponent(packet.location);
		request.get({
			headers: {'content-type' : 'application/x-www-form-urlencoded'},
			url: 'http://localhost/php/androidlocationsupdate.php?id=' + packet.id + '&location=' + packet.location + '&house=' + packet.house
		}, function(error, response, body)
		{
			var json = JSON.parse(body);
			var date = json.Date;
			var time = json.Time;
			var colour = json.LocationColour;
			var location = entities.decode(json.Location);
			var result = JSON.stringify({id: packet.id, location: location, house: packet.house, date: date, time: time, colour: colour});	
			connectedSockets.forEach(function(clientSocket)
			{
				clientSocket.emit('update_student_location', result);
				clientSocket.emit('redraw', packet.house);
			});
		});
	});
	socket.on('redraw', function(house)
	{
		connectedSockets.forEach(function(clientSocket)
			{
				clientSocket.emit('redraw', house);
			});
	});
	socket.on('redraw-colours', function(house)
	{
		connectedSockets.forEach(function(clientSocket)
			{
				clientSocket.emit('redraw-colours', house);
			});
	});
	socket.on('socket_service_startup', function(){
		console.log("Android device has connected to server");
	});
	socket.on('socket_service_request_student_info', function(data)
	{
		data = JSON.parse(data);
		request.get({
			headers: {'content-type' : 'application/x-www-form-urlencoded'},
			url: 'http://localhost/php/androidnames.php?id=' + data.id + '&house=' + data.house
		}, function(error, response, body)
		{
			body = JSON.parse(body);
			body.Location = entities.decode(body.Location);
			body = JSON.stringify(body);
			socket.emit('service_socket_student_info', body);
		});
	});
	socket.on('socket_service_request_all_names', function(house)
	{
		request.get({
			headers: {'content-type' : 'application/x-www-form-urlencoded'},
			url: 'http://localhost/php/androidnames.php?house' + house
		}, function(error, response, body)
		{
			body = JSON.parse(body);
			body.Location = entities.decode(body.Location);
			body = JSON.stringify(body);
			socket.emit('service_socket_all_names', body);
		});
	});
	socket.on('socket_service_login', function(userData)
	{
		userData = JSON.parse(userData);
		request.post({
			headers: {'content-type' : 'application/x-www-form-urlencoded'},
			url: 'http://localhost/php/androidauthenticatelogin.php',
			body: 'username=' + userData.username
		}, function(error, response, body)
		{
			socket.emit('service_socket_verification', body);
		});
	});
	socket.on('socket_service_request_locations', function(house)
	{
		request.get({
			headers: {'content-type' : 'application/x-www-form-urlencoded'},
			url: 'http://localhost/php/androidlocations.php?house=' + house
		}, function(error, response, body)
		{
			
			body = JSON.parse(body);
			for(var i = 0; i < body.length; i++)
			{
				body[i].Location = entities.decode(body[i].Location);
			}
			body = JSON.stringify(body);
			socket.emit('service_socket_request_locations', body);
		});
	});
	socket.on('service_socket_send_notification', function(packet){
		connectedSockets.forEach(function(clientSocket)
			{
				clientSocket.emit('service_socket_send_notification', packet);
			});
	});
	socket.on('disconnect', function()
	{
		var indexOf = connectedSockets.indexOf(socket);
		connectedSockets.splice(indexOf, 0);
	});
	
});

server.listen(8081);
