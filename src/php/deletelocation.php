<?php
  require "database.php";
  $names = DB::query('SELECT * FROM locations');
  foreach($names as $row)
  {
    if($row["ID"] == $_GET['id'])
    {
      DB::delete('locations', "ID=%i", $row["ID"]);
    }
  }
  header("location: ../mainpage.php");
?>