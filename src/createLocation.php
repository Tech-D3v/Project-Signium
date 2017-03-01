
<!DOCTYPE html>
<html>
  <head>
    <?php
      require_once "php/cdn.php";
      require_once "navbar.php";
    ?>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  </head>
  <body>
  <div class="container">
    <h1 class="page-header">Create a new Location</h1>
    <form role="form" method="post" action="php/newlocation.php">
      <div class="form-group">
        <label class="control-label" for="location">Location:</label>
        <div class="">
          <input type="text" class="form-control" id="location" name="location" placeholder="Enter Location" />
        </div>
      </div>
      <div class="form-group">
        <label class="control-label" for="colour">Pick a Colour:</label>
        <div class="">
          <input type="button" class=" form-control jscolor {valueElement: 'color_value'}" value="Pick a Colour"/>
          <input type="text" style="visibility: hidden;" name="colour" id="color_value" />
        </div>
      </div>
      <div class="form-group">
        <label class="control-label" for="heading">Under Which Heading</label>
          <div class="">
          <select class="form-control" id="heading" name="heading">
            <option>In College</option>
            <option>Out of College</option>
            <option>No Group</option>
          </select>
        </div>
      </div>
      <!--<div class="form-group">
        <label class="control-label" for="height">Height:</label>
        <div class="">
          <input type="range" min="1" max="5" class="form-control" id="height" name="height"  />
        </div>
      </div>-->
      <div class="form-group">
        <label class="control-label" for="bottomrow">Place on Bottom Row at Signing In Page?</label>
        <div class="">
          <input type="checkbox" id="bottomrow" name="bottomrow" value = "true"/>
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
