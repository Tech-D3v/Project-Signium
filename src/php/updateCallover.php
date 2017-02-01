<?php
  require "database.php";
  $initial = isset($_GET["ids"]) ? $_GET["ids"] : null;
  $array = preg_split("/[\s,]+/", $initial);
  $result = array();
  foreach ($array as $id) {
      $intID = intval($id);
      $row = DB::queryFirstRow("SELECT * FROM names WHERE ID=".$intID);
      $result[] = array('ID' => $row["ID"]);
  }
  DB::insert('calloverHistory', array('JSON' => json_encode($result)));
