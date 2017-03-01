<!DOCTYPE html>
<html>
  <head>
    <?php
      require "php/cdn.php";
      require "navbaradmin.php";
    ?>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  </head>
  <body>
  <div class="container">
    <h1 class="page-header">Create a new House</h1>
    <form role="form" method="post" action="php/newhouse.php">
      <div class="form-group">
        <label class="control-label" for="housename">House name:</label>
        <div class="">
          <input type="text" required="true" class="form-control" id="housename" name="housename" placeholder="Enter Housename"/>
        </div>
      </div>
      <div class="form-group">
        <label class="control-label" for="housename">House initials:</label>
        <div class="">
          <input type="text" required="true" class="form-control" id="houseinitials" name="houseinitials" placeholder="Enter House initials"/>
        </div>
      </div>
      <div class="form-group">
        <label class="control-label" for="housecolour">Pick a House Colour:</label>
        <div class="">
          <input type="button" class=" form-control jscolor {valueElement: 'color_value'}" value="Pick a Colour"/>
          <input type="text" style="visibility: hidden;" name="housecolour_1" id="color_value" />
        </div>
      </div>
      <div class="form-group">
          <label class="control-label" for="colour">Require Secondary Colour?</label>
          <div class="">
            <input type="checkbox" name="secondarycolour" value="enabled"/>
          </div>
        </div>
        <div class="form-group">
          <label class="control-label" for="housecolour_2">Pick a Secondary Colour:</label>
          <div class="">
            <input type="button" class=" form-control jscolor {valueElement: 'color_value2'}" value="Pick a Colour"/>
            <input type="text" style="visibility: hidden;" name="housecolour_2" id="color_value2" />
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
