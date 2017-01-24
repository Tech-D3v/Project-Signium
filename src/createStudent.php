<!DOCTYPE html>
<html>
  <head>
    <?php
      require "php/cdn.php";
      require "navbar.php";
    ?>
  </head>
  <body>
  <div class="container">
    <h1 class="page-header">Create a new Student</h1>
    <form role="form" method="post" action="php/send.php">
      <div class="form-group">
        <label class="control-label" for="firstname">Firstname:</label>
        <div class="">
          <input type="text" class="form-control" id="firstname" name="firstname" placeholder="Enter Firstname"/>
        </div>
      </div>
      <div class="form-group">
        <label class="control-label" for="surname">Surname:</label>
        <div class=""> 
          <input type="text" class="form-control" id="surname" name="surname" placeholder="Enter Surname"/>
        </div>
      </div>
      <div class="form-group">
        <label class="control-label" for="nickname">Preferred Name:</label>
        <div class=""> 
          <input type="text" class="form-control" id="nickname" name="nickname" placeholder="Enter Preferred Name"/>
        </div>
      </div>
      <div class="form-group">
        <label for="yeargroup">Select Year:</label>
        <div class="">
          <select class="form-control" id="yeargroup" name="yeargroup">
            <option>3rd</option>
            <option>4th</option>
            <option>5th</option>
            <option>LVIth</option>
            <option>UVIth</option>
          </select>
        </div>
      </div>
      <div class="form-group">
        <label class="control-label" for="usercode">Usercode:</label>
        <div class=""> 
          <input type="text" class="form-control" id="usercode" name="usercode" placeholder="Enter Usercode" ></input>
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
      </div>
    </form>
    </div>
  </body>
</html>