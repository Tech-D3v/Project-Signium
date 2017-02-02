var socket = io.connect(CONFIG_NODE_IP);
socket.emit("redraw");
var house = "";
var url = "wellingtonsigninsystem";
$.ajax({
    url: "php/gethouse.php",
    method: "get",
    success: function(data) {
        house = data;
    }
});
if (house == "" || house == null) {
    house = $("#getHouse").val();
}
var selectedIDS = [];

function updateSelection(id) {
    $(document).ready(function() {

        if ($("#selected" + id).css("visibility") == "hidden") {
            $("#selected" + id).css("visibility", "visible");
            selectedIDS.push(id);
        } else if ($("#selected" + id).css("visibility") == "visible") {
            $("#selected" + id).css("visibility", "hidden");
            var tmpIndex = selectedIDS.indexOf(id);
            selectedIDS.splice(tmpIndex, 1);
        }
    });
}

function updateServerCustom() {
    var text = $("#otherinput").val();
    updateServer(text, house, "#000000");
}

function updateServer(data, house, colour) {
    var ids = selectedIDS;
    var userName = $('#getUsername').val();
    /*$('.namelink').each(function()
    {
    	if(String($('#selected'+$(this).attr('id')).css("visibility")).valueOf() == String("visible").valueOf())
    	{
    		ids.push($(this).attr('id'));
    	}
    });*/
    sendData(data, ids, userName, house);

}

function sendData(data, ids, userName, house) {
    var result = ids.toString();
    $(document).ready(function() {
        $.ajax({
            url: "php/update.php",
            method: "get",
            dataType: "json",
            data: {
                ids: result,
                location: data,
                user: userName
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
                }
                socket.emit('inhouse_number_update');
                socket.emit('redraw-colours', house);
            }
        });
    });

}

function deselect() {
    $('.namelink').each(function() {
        if (String($('#selected' + $(this).attr('id')).css("visibility")).valueOf() == String("visible").valueOf()) {
            $('#selected' + $(this).attr('id')).css("visibility", "hidden")
        }
    });
    selectedIDS = [];
}
function select(yeargroup) {
    var IDs = $(".namelink").map(function() {
        return this.id;
    }).get();
    var increment = 0;
    $('.namelinkyeargroup').each(function() {
        switch (yeargroup) {
            case "3rd":
                if (String($(this).children().attr('id')).valueOf() == "yeargroup3rd") {
                    $('#selected' + IDs[increment]).css("visibility", "visible");
                    selectedIDS.push(IDs[increment]);
                }
                break;
            case "4th":
                if (String($(this).children().attr('id')).valueOf() == "yeargroup4th") {
                    $('#selected' + IDs[increment]).css("visibility", "visible");
                    selectedIDS.push(IDs[increment]);
                }
                break;
            case "5th":
                if (String($(this).children().attr('id')).valueOf() == "yeargroup5th") {
                    $('#selected' + IDs[increment]).css("visibility", "visible");
                    selectedIDS.push(IDs[increment]);
                }
                break;
            case "LVIth":
                if (String($(this).children().attr('id')).valueOf() == "yeargroupLVIth") {
                    $('#selected' + IDs[increment]).css("visibility", "visible");
                    selectedIDS.push(IDs[increment]);;
                }
                break;
            case "UVIth":
                if (String($(this).children().attr('id')).valueOf() == "yeargroupUVIth") {
                    $('#selected' + IDs[increment]).css("visibility", "visible");
                    selectedIDS.push(IDs[increment]);
                }
                break;
        }
        increment++;
    });
}
socket.on("redraw-colours", function(fHouse) {
    if (fHouse == house) {
        $.ajax({
            method: 'get',
            url: 'php/download.php',
            dataType: 'json',
            success: function(data) {
                updateColours(data);
            }
        });
        deselect();
    }
});
socket.on("redraw", function(fHouse) {
    if (fHouse == house) {
        $.ajax({
            url: "php/draw.php",
            method: "get",
            success: function(data) {
                $(".cardspace").html(data);
                setUpGrid();
            }
        });
        $.ajax({
            url: "php/updatebuttons.php",
            method: "get",
            success: function(data) {
                $(".buttonspace").html(data);
                setUpButtons();
            }
        });
        socket.emit("redraw-colours", fHouse);
    }
});

function setUpButtons(maxHeight = parseInt($(".cardspace").css("height"))) {
    $(".buttonspace").css("height", maxHeight + "px");
    var totalCards = $(".btn-selector-parent").size() + 1;
    var height = Math.floor(maxHeight / totalCards);
    var halfheight = Math.floor(height / 2);
    $(".btn-selector-parent").css("padding-top", halfheight + "px");
    $(".btn-selector-parent").css("padding-bottom", halfheight + "px");
    $("#selector").css("height", height + "px");
}




function setUpGrid() {
    var totalCards = $(".name").size();
    var maxWidth = 130;
    var minWidth = 120;
    var screenWidth = parseInt($(".namespace").css("width"));
    var maxSideMargin = 50;
    var maxMargin = 15;
    var minMargin = 10;
    var cardSet = $(".name").toArray();
    var maxN = (screenWidth + minMargin) / (minWidth + minMargin);
    var intMaxN = Math.floor(maxN);

    var minN = (screenWidth + maxMargin - 2 * maxSideMargin) / (maxWidth + maxMargin);
    var intMinN = Math.ceil(minN);

    var possN = new Array();
    for (var i = intMaxN; i >= intMinN; i--) {
        var ratio = totalCards % i !== 0 ? (totalCards % i) / i : 1;
        possN.push(ratio);
    }

    var n = 0;
    var maxRatio = 0;
    possN.forEach(function(poss) {
        if (poss > maxRatio) {
            maxRatio = poss;
            n = intMaxN - i;
        }
    });
    var finalSize = minWidth;
    var finalMargin = minMargin;
    var finalSideMargin = getSideMargin(screenWidth, finalSize, finalMargin, n);

    for (var width = minWidth; width <= maxWidth; width++) {
        for (var margin = minMargin; margin <= maxMargin; margin++) {
            var sideMargin = getSideMargin(screenWidth, width, margin, n);
            if (sideMargin >= 0 && sideMargin <= maxSideMargin) {
                finalSize = width;
                finalMargin = margin;
                finalSideMargin = sideMargin;
            }
        }
    }

    var numCols = n;
    var numRows = Math.ceil(totalCards / numCols);
    var left, right, top, bottom;
    for (var i = 0; i < totalCards; i++) {
        left = right = top = bottom = false;
        var col = i % numCols;
        var row = Math.floor(i / numCols);
        left = col === 0;
        right = col === (numCols - 1);
        top = row === 0;
        bottom = row === (numRows - 1);
        setUpCardSize(cardSet[i], left, right, top, bottom, finalSize, finalMargin, finalSideMargin);
    }
}

function setUpCardSize(card, left, right, top, bottom, size, margin, side) {
    $(card).css("width", size);
    $(card).css("height", size * 1.4375);
    if (left) {
        $(card).css("margin-left", side - 1);
    } else {
        $(card).css("margin-left", margin / 2);
    }

    if (right) {
        $(card).css("margin-right", side - 1);
    } else {
        $(card).css("margin-right", margin / 2);
    }

    $(card).css("margin-top", margin / 2);
    $(card).css("margin-bottom", margin / 2);
}

function getSideMargin(screenWidth, boxWidth, margin, n) {
    return Math.floor((screenWidth - (n * boxWidth) - ((n - 1) * margin)) / 2);
}

function updateColours(data) {
    setUpButtons();
    var val1 = Array();
    var val2 = Array();
    $(document).ready(function() {
        $.ajax({
            method: 'get',
            url: 'php/downloadLocations.php',
            dataType: 'json',
            success: function(locations) {
                $.each(data, function(key, val) {
                    if (val.Location == "In House") {
                        val1 = val;
                    }
                    if (val.Location == "Lessons") {
                        val2 = val;
                    }
                    $.each(locations, function(id, location) {
                        if (val.Location == location.Location) {

                            $("#" + val.ID).css("border-color", location.Colour);
                            $("#location" + val.ID).text(val.Location);
                        }

                    });
                });
                var fHouse = $("#getHouse").val();

            }
        });
    });
}

                 
$(document).ready(function() {
    $(window).resize(function() {
        setUpButtons();
        setUpGrid();
    });
    $(window).load(function() {
        setUpButtons();
    });
});
