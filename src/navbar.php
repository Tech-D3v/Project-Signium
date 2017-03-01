<?php
  require_once "php/session.php";
  require_once "php/database.php";
  $database = new MeekroDB("localhost", "root", "", "users");
  $database->query("SELECT * FROM users WHERE House=%s", $userHouse);
  $count = $database->count();
  $database->update("houselist", array("UserCount" => $count), "House=%s", $userHouse);
  ?>
<title>Wellington College Sign In System</title>
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="<?php echo __ROOT__."/mainpage.php"; ?>"><?php echo ucfirst($userHouse); ?></a>
    </div>
    <ul class="nav navbar-nav">
      <li><a href="mainpage.php">Home</a></li>
      <li><a href="locationfeed.php">Update History</a></li>
      <li><a href="createLocation.php"">Create a new Location</a></li>
      <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Callover
        <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="callover.php"">Callover</a></li>
          <li><a href="calloverFeed.php"">Callover History</a></li>
        </ul></li>
      <!--<li><a href="notificationfeed.php">Send a notification</a></li>-->

      <?php if($userLevel == "HM" || $userLevel == "ADMIN")
      {
        echo '<li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Excel
        <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="importdatapage.php?overwrite=true">Overwrite Data</a></li>
          <li><a href="importdatapage.php?overwrite=false">Insert Data</a></li>
          <li><a href="php/exportdata.php">Download Student Excel Data</a></li>
          <li><a href="php/exporttemplate.php">Download Template Data</a></li>
        </ul></li>
        <li><a href="createstudent.php">Create a new Student</a></li>
      <li><a href="createuser.php">Create a new User</a></li>';
    }
      ?>
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <?php  if($adminUser == true){
        echo'<li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Select House - '.ucfirst($userHouse).'
        <span class="caret"></span></a>
        <ul class="dropdown-menu">';
          $result = $database->query("SELECT * FROM houselist ORDER BY House");
          foreach($result as $row)
          {
            echo '<li><a href="php/switchhouse.php?house='.$row["House"].'">'.ucfirst($row["House"]).'</a></li>';
          }
          echo '<li class="divider"></li>
          <li><a href="adminpage.php">ADMIN</a></li>
        </ul></li>'; } ?>
      <li><a href="view.php?house=<?php echo $userHouse; ?>">Signing in DEVICE VIEW</a></li>
      <li><a href="edituser.php">Edit User</a></li>
      <?php echo '<li><a>Welcome, '.$prefName.'</a></li>'?>
      <li><a href="logout.php"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
    </ul>
  </div>
</nav>
