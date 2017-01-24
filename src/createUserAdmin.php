<?php
	require_once "php/cdn.php";
  require_once "php/session.php";
    require_once "navbaradmin.php";
  require_once 'php/dependencies/meekrodb.2.3.class.php';
  $database = new MeekroDB("localhost", "root", "", "users");
?>
<!DOCTYPE html>
<html>
	<head>
	</head>

	<body>
		  <div class="container">
    <form class="form-signin" action="php/newuser.php" method="post">       
      <h2 class="form-signin-heading">Create a New User</h2>
      <div class="form-group">
      <input type="text" class="form-control" name="username" placeholder="Username" required="true" autofocus="" /></div><div class="form-group">
      <input type="password" class="form-control" name="password" placeholder="Password" required="true"/></div>
      <div class="form-group"><input type="password" class="form-control" name="confirmpassword" placeholder="Confirm Password" required="true"/></div><div class="form-group">
      <input type="text" class="form-control" name="name" placeholder="Preferred Name" required="true" autofocus="" />      </div><div class="form-group">
       <select class="form-control" id="role" name="role">
            <?php if($adminUser) { echo "<option>ADMIN</option>"; } ?>
            <option>HM</option>
            <option>Tutor</option>
      </select> </div><div class="form-group">
      <?php 
        if($adminUser)
        {
           echo '<select class="form-control" id="house" name="house">';
           $results = $database->query("SELECT * FROM houselist");
           foreach($results as $row)
          {
            echo '<option>'.ucfirst($row["House"]).'</option>';
          }
          echo '</select>';
        }
      ?></div>
	<br/>
      <button class="btn btn-lg btn-primary btn-block" type="submit">Create Account</button> <br/>
      <?php
      if(isset($_GET["usernametaken"]))
      { 
        if($_GET["usernametaken"] == true)
        {
          echo '<div class="alert alert-danger fade in">
      		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
      			<strong>Account Creation Failed</strong> This Username has already been taken.
    		</div>';
    	  }
      }
      if(isset($_GET["passwordnomatch"]))
      { 
        if($_GET["passwordnomatch"] == true)
        {
          echo '<div class="alert alert-danger fade in">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Account Creation Failed</strong> Passwords did not match.
        </div>';
        }
      }
		?>  
    </form>
  </div>
	</body>
</html>