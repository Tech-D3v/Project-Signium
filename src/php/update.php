<?php
    require "database.php";
    require "houselist.php";
    $initial = isset($_GET['ids']) ? $_GET['ids'] : null;
    $array = preg_split("/[\s,]+/", $initial);
    $location = $_GET["location"];
    $userName = $_GET["user"];
    $result = array();
    foreach ($array as $id) {
        $intID = intval($id);
        $row = DB::queryFirstRow("SELECT * FROM names WHERE ID=".$intID);
        DB::insert("history", array('StudentFirstname' => $row["Firstname"], 'StudentSurname' => $row["Surname"], 'Location' => $location, 'Username' => $userName));
        DB::update("names", array('Location' => $location), "ID=%i", $intID);
        $timeLastOut = DB::queryFirstRow('SELECT * FROM history WHERE StudentFirstname="'.$row["Firstname"].'" AND StudentSurname="'.$row["Surname"].'" ORDER BY Timestamp DESC');
        $timestamp = new DateTime($timeLastOut["Timestamp"]);
        $row["Date"] = $timestamp->format("d/M/y");
        $row["Time"] = $timestamp->format("G:i");
        $colour = DB::queryFirstRow('SELECT * FROM locations WHERE Location="'.$location.'"');
        $row["LocationColour"] = $colour["Colour"];
        $row["Location"] = $colour["Location"];
        $row["ID"] = $intID;
        $result[] = $row;
    }
    $database = new MeekroDB("localhost", "root", "", "users");
    $array = DB::query("SELECT * FROM names");
    $counter = 0;
    foreach ($array as $row) {
        if ($row["Location"] == "In House") {
            $counter++;
        }
    }
    $database->update("houselist", array("InHouseCurrently" => $counter), "House=%s", DB::$dbName);


    echo json_encode($result);
?>
