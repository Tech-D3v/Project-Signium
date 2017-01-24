<?php 
  require_once "php/session.php";
  $database = new MeekroDB("localhost", "root", "", "users");
   ?>
<title>Wellington College Sign In System - ADMIN</title> 
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="mainpage.php">ADMIN</a>
    </div>
    <ul class="nav navbar-nav">
      <li><a href="adminpage.php">Home</a></li>
      <li><a href="userlist.php">User List</a></li>
      <li><a href="createhouse.php">Create a new House</a></li>
      <?php if($userLevel == "HM" || $userLevel == "ADMIN")
      { 
        echo'
      <li><a href="createUserAdmin.php">Create a new Admin User</a></li>'; 
    }
    if($adminUser == true){ 
        echo'<li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Select House - ADMIN 
        <span class="caret"></span></a>
        <ul class="dropdown-menu">';
        $result = $database->query("SELECT * FROM houselist ORDER BY House");
          foreach($result as $row)
          {
            echo '<li><a href="php/switchhouse.php?house='.$row["House"].'">'.ucfirst($row["House"]).'</a></li>';
          }
          echo '
          <li class="divider"></li>
          <li><a href="php/switchhouse.php?house=unselected">ADMIN</a></li> 
        </ul></li>'; }
      ?>
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <li><a href="edituseradmin.php">Edit User</a></li>
      <?php echo '<li><a>Welcome, '.$prefName.'</a></li>'?>
      <li><a href="logout.php"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
    </ul>
  </div>
</nav>