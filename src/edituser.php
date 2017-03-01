<?php
	require_once "php/session.php";
	$database = new MeekroDB("localhost", "root", "", "users");
	$query_raw = $database->queryRaw("SELECT * FROM users WHERE ID=%s", $_SESSION["user_id"]);
	$row = $query_raw->fetch_assoc();
?>
<!DOCTYPE html>
<html>
	<head>
		<?php
			require_once "navbar.php";
			require_once "php/cdn.php";
		?>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="css/style.css">
	</head>
	<body>
		<div class="container">
			<h1 class="page-header">Edit Information</h1>
			<form action="php/updateuser.php" role="form" method="post">
				<div class="form-group">
        			<label class="control-label" for="username">Change Username:</label>
        			<div class="">
          				<input type="text" class="form-control" id="username" name="username" placeholder="Enter Username" required="true" <?php echo "value=".$row["Username"]; ?> ></input>
        			</div>
      			</div>
      			<div class="form-group">
        			<label class="control-label" for="preferredname">Change Preferred Name:</label>
        			<div class="">
          				<input type="text" class="form-control" id="name" name="name" placeholder="Enter Preffered Name" required="true" <?php echo "value=".$row["Name"]; ?> ></input>
        			</div>
      			</div>
      			<div class="form-group">
			        <div class="">
			          <input type="submit" value="Apply" class="btn btn-default"/>
			          <button class="btn btn-default" data-toggle="collapse" data-target="#changepassword" type="button">Change Password</button>
			        </div>
      			</div>
      			</form>

			<?php if(isset($_GET["changepassword"]) && $_GET["changepassword"] == "true"){
					echo '<div id="changepassword" class="collapse in">';
				}
				else
				{
					echo '<div id="changepassword" class="collapse">';
				}
				?>
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

			</div>
			</form>
		</div>
	</body>
</html>
