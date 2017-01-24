<?php
  require_once "php/session.php";
	require_once "php/database.php";
	require_once "navbar.php";	
	require_once "php/cdn.php";
	$array = null;
	$names = DB::query('SELECT * FROM names ORDER BY Yeargroup ASC, Surname');
	foreach($names as $row)
	{
		if($row["ID"] == $_GET['id'])
		{
			$array = $row;
		}
	}
?>

<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" href="css/style.css" type="text/css"/>
	</head>
	
	<body>
		
		<div class="container">
    <h1 class="page-header">Edit a Student</h1>
    <form role="form" method="post" action="php/send.php">
      <div class="form-group">
        <label class="control-label" for="firstname">Firstname:</label>
        <div class="">
          <input type="text" class="form-control" id="firstname" name="firstname" placeholder="Enter Firstname" <?php echo "value=".$array["Firstname"]; ?> ></input>
        </div>
      </div>
      <div class="form-group">
        <label class="control-label" for="pwd">Surname:</label>
        <div class=""> 
          <input type="text" class="form-control" id="surname" name="surname" placeholder="Enter Surname" <?php echo "value=".$array["Surname"]; ?>  ></input>
        </div>
      </div>
      <div class="form-group">
        <label class="control-label" for="nickname">Preferred Name:</label>
        <div class=""> 
          <input type="text" class="form-control" id="nickname" name="nickname" placeholder="Enter Preferred Name" <?php echo "value=".$array["Nickname"]; ?> ></input>
        </div>
      </div>
      <div class="form-group">
        <label for="yeargroup">Select Year:</label>
        <div class="">
          <select class="form-control" id="yeargroup" name="yeargroup">
            <option <?php if($array["Yeargroup"] == "3rd"){ echo 'selected="selected"'; } ?> >3rd</option>
            <option <?php if($array["Yeargroup"] == "4th"){ echo 'selected="selected"'; } ?> >4th</option>
            <option <?php if($array["Yeargroup"] == "5th"){ echo 'selected="selected"'; } ?> >5th</option>
            <option <?php if($array["Yeargroup"] == "LVIth"){ echo 'selected="selected"'; } ?> >LVIth</option>
            <option <?php if($array["Yeargroup"] == "UVIth"){ echo 'selected="selected"'; } ?> >UVIth</option>
          </select>
        </div>
      </div>
      <div class="form-group">
        <label class="control-label" for="usercode">Usercode:</label>
        <div class=""> 
          <input type="text" class="form-control" id="usercode" name="usercode" placeholder="Enter Usercode" <?php echo "value=".$array["Usercode"]; ?> ></input>
        </div>
      </div>
       <div class="form-group">
        <label class="control-label" for="password">Password:</label>
        <div class=""> 
          <input type="text" class="form-control" id="password" name="password" placeholder="Enter Password"></input>
        </div>
      </div>
      <div class="form-group"> 
        <div class="">
          <input type="submit" value="Finish" class="btn btn-default"/>
        </div>
        <input type="hidden" value="<?php echo $array['ID'];?>" name="id"/>
        <input type="hidden" value="<?php echo $array['Location'];?>" name="location"/>
      </div>
    </form>
    </div>
	</body>
</html>