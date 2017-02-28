
<!DOCTYPE html>
<html>
	<head>
  <?php
  require_once "php/cdn.php";
  require_once "php/session.php";
  require_once "navbaradmin.php";
  require_once 'php/dependencies/meekrodb.2.3.class.php';
  $database = new MeekroDB("localhost", "root", "", "users");
  if($adminUser)
  {
    $_SESSION["user_house"] = "unselected";
  }
  $array = $database->query("SELECT * FROM users");
  $user = null;
  foreach($array as $row)
  {
    if($row["ID"] == $_GET['id'])
    {
      $user = $row;
    }
  }
  ?>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	</head>

	<body>
		  <div class="container">
    <form class="form-signin" action="php/newuser.php" method="post">
      <h2 class="form-signin-heading">Edit an existing user</h2>
      <div class="form-group">
      <input type="text" class="form-control" name="username" placeholder="Username" required="true" autofocus="" value="<?php echo $user["Username"]; ?>" />
      </div>
      <div class="form-group">
      <input type="password" class="form-control" name="password" placeholder="Password" required="true" value="<?php echo $user["Password"]; ?>"/>
      </div>
      <div class="form-group">
      <input type="password" class="form-control" name="confirmpassword" placeholder="Confirm Password" required="true"/>
      </div>
      <div class="form-group">
      <input type="text" class="form-control" name="name" placeholder="Preferred Name" required="true" autofocus="" value="<?php echo $user["Name"]; ?>"/>
      </div>
      <div class="form-group">
       <select class="form-control" id="role" name="role">
            <?php
            if($adminUser) {
              if($user["Role"] == "ADMIN")
                { echo '<option selected="selected">ADMIN</option>';
              }
              else
              {
                echo "<option>ADMIN</option>";
                }
              }
              ?>
            <option <?php if($user["Role"] == "HM") { echo 'selected="selected"'; } ?>>HM</option>
            <option <?php if($user["Role"] == "Tutor") { echo 'selected="selected"'; } ?> >Tutor</option>
      </select> </div><div class="form-group">
      <?php
        if($adminUser)
        {
           echo '<select class="form-control" id="house" name="house">';
           $results = $database->query("SELECT * FROM houselist");
           foreach($results as $row)
          {
            if($row["House"] == $user["House"])
            {
              echo '<option selected="selected">'.ucfirst($row["House"]).'</option>';
            }
            else
            {
              echo '<option>'.ucfirst($row["House"]).'</option>';
            }

          }
          echo '</select>';
        }
      ?>

      </div>
	     <br/>
      <button class="btn btn-lg btn-primary btn-block" type="submit">Change Account</button>
      <input type="hidden" name="id" value="<?php echo $user['ID']; ?>" id="adminid" /><br/>

      <?php
      if(isset($_GET["usernametaken"]))
      {
        if($_GET["usernametaken"] == true)
        {
          echo '<div class="alert alert-danger fade in">
      		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
      			<strong>Account Edit Failed</strong> This Username has already been taken.
    		</div>';
    	  }
      }
      if(isset($_GET["passwordnomatch"]))
      {
        if($_GET["passwordnomatch"] == true)
        {
          echo '<div class="alert alert-danger fade in">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Account Edit Failed</strong> Passwords did not match.
        </div>';
        }
      }
		?>

    </form>

  </div>
	</body>

</html>
