var socket = io.connect(CONFIG_NODE_IP);
var house = "";
$.ajax({
    url: "php/gethouse.php",
    method: "get",
    success: function(data) {
        house = data;
    }
});

var inHouseClass = "";
var calledOver = [];

function presentClicked(id) {
    calledOver.push(id);
    $("#calloverbutton" + id).prop("disabled", true);
    if ($("#callover" + id).children("p").text() != "In House") {
        var ids = [];
        ids.push(id);
        $.ajax({
            url: "php/update.php",
            method: "get",
            dataType: "json",
            data: {
                ids: ids.toString(),
                location: "In House",
                user: "Callover"
            },
            success: function(result) {
                var data = result;
                for (i in data) {
                    var date = data[i].Date;
                    var time = data[i].Time;
                    var colour = data[i].LocationColour;
                    var location = data[i].Location;
                    var id = data[i].ID;
                    var packet = {
                        id: id,
                        location: location,
                        house: house,
                        date: date,
                        time: time,
                        colour: colour
                    };
                    socket.emit('update_student_location', JSON.stringify(packet));
                    $("#calloverlocationname" + data[i].ID).removeClass();
                    $("#calloverlocationname" + data[i].ID).addClass(inHouseClass);
                    $("#calloverlocationname" + data[i].ID).css("background-color", data[i].LocationColour);
                    $("#calloverlocationname" + data[i].ID).text(data[i].Location);
                }
            }
        });

    }
}

function uploadData() {
    $.ajax({
        url: "php/updatecallover.php",
        method: "get",
        data: {
            ids: calledOver.toString()
        },
        success: function() {
            $(".btn-present").each(function() {
                $(this).prop("disabled", false);
            });
            calledOver = [];
        }
    });
}


function drawCalloverData() {
    $.ajax({
        url: "php/download.php",
        method: "get",
        dataType: "json",
        success: function(calloverStudents) {
            var html = "";
            $.each(calloverStudents, function(key, student) {
                if (student.Location == "In House") {
                    inHouseClass = "calloverlocation" + loseSpaces(student.Location);
                }
                html += '<li class="list-group-item calloveritem"  style="position: relative;" id="callover' + student.ID + '">' + student.Firstname + ' ' + student.Surname;
                html += '<p style="color: white; position: absolute; right: 40%; top: 0%; text-align: center; padding-top: 10px; width: 20%; padding-bottom: 10px;" id="calloverlocationname' + student.ID + '" class="calloverlocation' + loseSpaces(student.Location) + '">' + student.Location + '</p>';
                html += '<button id="calloverbutton' + student.ID + '" class="btn btn-default btn-present" style="height: 96%; position: absolute; right: 1%; top: 2%;" onclick="presentClicked(' + student.ID + ')">Present</button>';
                html += '</li>';
            });
            $(".calloverlist").html(html);
        }
    });

}

function loseSpaces(input) {
    input = input.replace(/\s/g, '');
    return input.replace(/\W/g, '');
}

function colourCalloverData() {
    $.ajax({
        method: 'get',
        url: 'php/downloadLocations.php',
        dataType: 'json',
        success: function(locations) {
            $.each(locations, function(key, location) {
                $('.calloverlocation' + loseSpaces(location.Location)).css("background-color", location.Colour);
            });
        }
    });
}

$(document).ready(function() {
    drawCalloverData();
    colourCalloverData();
});
