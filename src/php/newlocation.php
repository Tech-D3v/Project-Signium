<?php
    require "database.php";
    require "cdn.php";


    $location = htmlspecialchars($_POST['location']);
    $bottomRow = $_POST['bottomrow'] == "true" ? "true" : "false";
    $colour = "#".$_POST['colour'];
    $heading = $_POST["heading"] == null ? "No Group" : $_POST["heading"];
    if (isset($_POST["id"])) {
        DB::replace('locations', array(
            'ID' => $_POST["id"],
            'Location' => $location,
            'Colour' => $colour,
            'Heading' => $heading,
            'BottomSpace' => $bottomRow/*,
              'Height' => $_POST["height"]*/
        ));
    } else {
        DB::insert('locations', array(
            'Location' => $location,
            'Colour' => $colour,
            'Heading' => $heading,
            'BottomSpace' => $bottomRow/*,
              'Height' => $_POST["height"]*/
        ));
    }
    header("location:../mainpage.php");
