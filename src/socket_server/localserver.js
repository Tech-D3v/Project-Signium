var socketio = require("socket.io");
var express = require("express");
var http = require("http");

var app = express();
var server = http.createServer(app);

var request = require("request");
var Entities = require("html-entities").AllHtmlEntities;
var entities = new Entities();

var CONFIG_DIRECTORY = "http://localhost/projectsignium";

var io = socketio.listen(server);
var connectedSockets = [];
io.on('connect', function(socket) {
    socket.emit('android_handshake');
    connectedSockets.push(socket);
    console.log("Client Connected");
    socket.on("inhouse_number_update", function() {
        request.post({
            headers: {
                'content-type': 'application/x-www-form-urlencoded'
            },
            url: CONFIG_DIRECTORY + '/php/updateinhouse.php'
        }, function(error, response, body) {
            connectedSockets.forEach(function(clientSocket) {
                clientSocket.emit("update_inhouse_number", body);
            });
        });
    });
    socket.on('update_student_location', function(packet) {
        console.log(packet);
        connectedSockets.forEach(function(clientSocket) {
            clientSocket.emit('update_student_location', packet);
        });
    });
    socket.on('update_student_location_server', function(packet) {
        packet = JSON.parse(packet);
        packet.location = entities.encode(packet.location);
        packet.location = encodeURIComponent(packet.location);
        request.post({
            headers: {
                'content-type': 'application/x-www-form-urlencoded'
            },
            url: CONFIG_DIRECTORY + '/php/androidlocationsupdate.php',
            body: 'id=' + packet.id + '&location=' + packet.location + '&house=' + packet.house
        }, function(error, response, body) {
            var json = JSON.parse(body);
            var date = json.Date;
            var time = json.Time;
            var colour = json.LocationColour;
            var location = entities.decode(json.Location);
            var result = JSON.stringify({
                id: packet.id,
                location: location,
                house: packet.house,
                date: date,
                time: time,
                colour: colour
            });
            console.log(result);
            connectedSockets.forEach(function(clientSocket) {
                clientSocket.emit('update_student_location', result);
                clientSocket.emit('redraw', packet.house);
            });
        });
    });
    socket.on('redraw', function(house) {
        connectedSockets.forEach(function(clientSocket) {
            clientSocket.emit('redraw', house);
        });
    });
    socket.on('redraw-colours', function(house) {
        connectedSockets.forEach(function(clientSocket) {
            clientSocket.emit('redraw-colours', house);
        });
    });
    socket.on('socket_service_startup', function() {
        console.log("Android device has connected to server");
    });
    socket.on('socket_service_request_student_info', function(data) {
        data = JSON.parse(data);
        console.log(data);
        request.post({
            headers: {
                'content-type': 'application/x-www-form-urlencoded'
            },
            url: CONFIG_DIRECTORY + '/php/androidnames.php',
            body: 'id=' + data.id + '&house=' + data.house
        }, function(error, response, body) {
            console.log(body);
            body = JSON.parse(body);
            body.Location = entities.decode(body.Location);
            body = JSON.stringify(body);
            socket.emit('service_socket_student_info', body);
        });
    });
    socket.on('socket_service_login', function(userData) {
        console.log("Android device requesting login");
        console.log(userData);
        var json = JSON.parse(userData);
        console.log(json.username);
        request.post({
            headers: {
                'content-type': 'application/x-www-form-urlencoded'
            },
            url: CONFIG_DIRECTORY + '/php/androidauthenticatelogin.php',
            body: 'username=' + json.username
        }, function(error, response, body) {
            console.log(body);
            socket.emit('service_socket_verification', body);
        });
    });
    socket.on('socket_service_request_locations', function(house) {
        console.log(house);
        request.post({
            headers: {
                'content-type': 'application/x-www-form-urlencoded'
            },
            url: CONFIG_DIRECTORY + '/php/androidlocations.php',
            body: 'house=' + house
        }, function(error, response, body) {

            body = JSON.parse(body);
            for (var i = 0; i < body.length; i++) {
                body[i].Location = entities.decode(body[i].Location);
            }
            body = JSON.stringify(body);
            socket.emit('service_socket_request_locations', body);
        });
    });
    socket.on('service_socket_send_notification', function(packet) {
        console.log(packet);
        connectedSockets.forEach(function(clientSocket) {
            clientSocket.emit('service_socket_send_notification', packet);
        });
    });
    socket.on('disconnect', function() {
        var indexOf = connectedSockets.indexOf(socket);
        connectedSockets.splice(indexOf, 0);
    });

});

server.listen(8080);
