<?php
	require_once "php/cdn.php";
  require_once "php/session.php";
?>
<!DOCTYPE html>
<html>
	<head>
	</head>

	<body>
		  <div class="container">
    <form class="form-signin" action="newpassword.php" method="post">       
      <h2 class="form-signin-heading">Change Password</h2>
      <div class="form-group">
      <input type="password" class="form-control" name="oldpassword" placeholder="Old Password" required="true" autofocus="" /></div><div class="form-group">
      <input type="password" class="form-control" name="newpassword" placeholder="New Password" required="true"/></div><div class="form-group">
      <input type="password" class="form-control" name="confirmpassword" placeholder="Confirm New Password" required="true" autofocus="" />      </div><div class="form-group">
      <br/>
      </div><div class="form-group">
      <button class="btn btn-lg btn-primary btn-block" type="submit">Change Password</button>
      </div>
      <?php
      if(isset($_GET["passwordnomatch"]))
      { 
      if($_GET["passwordnomatch"] == true)
      {
      echo '<div class="alert alert-danger fade in">
  		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  			<strong>Passwords do not match</strong>The two new passwords do not match up.
		</div>';
	}
}
if(isset($_GET["passwordnomatchserver"]))
      { 
      if($_GET["passwordnomatchserver"] == true)
      {
      echo '<div class="alert alert-danger fade in">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Incorrect Password</strong>Old Password Does Not Match</div>';
  }
}
		?>  
    </form>
  </div>
	</body>
</html>