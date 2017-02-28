
<!DOCTYPE html>
<html>
	<head>
		<?php
			require "php/cdn.php";
		  if(isset($_COOKIE["loginuser"]))
		  {
		    header("location: php/authcookie.php");
		  }
		?>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link href="css/loginstyle.css" rel="stylesheet" type="text/css"/>
	</head>

	<body>
		  <div class="wrapper">
    <form class="form-signin" action="php/auth.php" method="post">
      <h2 class="form-signin-heading">Login</h2>
      <input type="text" class="form-control" name="username" placeholder="Username" required="true" autofocus="" />
      <input type="password" class="form-control" name="password" placeholder="Password" required="true"/>
      <!--<label class="checkbox">
        <input type="checkbox" value="remember-me" id="rememberMe" name="rememberMe"> Remember me
      </label>-->
      <br/>
      <button class="btn btn-lg btn-primary btn-block" type="submit">Login</button>
      <?php
      if(isset($_GET["invalid"]))
      {
      if($_GET["invalid"] == true)
      {
      echo '<div class="alert alert-danger fade in">
  		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  			<strong>Login Failed</strong> Wrong Username or Password.
		</div>';
	}
}
		?>
    </form>
  </div>
	</body>
</html>
