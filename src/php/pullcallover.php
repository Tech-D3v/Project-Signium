<?php
    require_once "database.php";
        if (isset($_GET["noJSON"])) {
            if ($_GET["noJSON"] == "true") {
                $names = DB::query('SELECT ID, Timestamp FROM calloverHistory ORDER BY Timestamp DESC');
            } else {
                $tmp_names = DB::queryFirstRow('SELECT * FROM calloverHistory WHERE ID='.$_GET["id"]);
                $names = $tmp_names["JSON"];
            }
        }

    echo json_encode($names);
?>
