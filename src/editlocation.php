<?php
  require_once "php/database.php";
  require_once "php/session.php";
  $array = null;
  $names = DB::query('SELECT * FROM locations');
  $disabled = "";
  foreach ($names as $row) {
      if ($row["ID"] == $_GET['id']) {
          $array = $row;
          if ($row["Location"] == "In House" || $row["Location"] == "Lessons") {
              $disabled = "readonly";
          }
      }
  }
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
  </head>
  <body>
  <div class="container">
    <h1 class="page-header">Edit a Location</h1>
    <form role="form" method="post" action="php/newlocation.php">
      <div class="form-group">
        <label class="control-label" for="location">Location:</label>
        <div class="">
          <input type="text" class="form-control" id="location" name="location" placeholder="Enter Location" value="<?php echo $array["Location"]; ?>" <?php echo $disabled; ?>/>
        </div>
      </div>
      <div class="form-group">
        <label class="control-label" for="colour">Pick a Colour:</label>
        <div class="">
          <input type="button" class=" form-control jscolor {valueElement: 'color_value'}" value="Pick a Colour"/>
          <input type="text" style="visibility: hidden;" name="colour" id="color_value" value="<?php echo $array["Colour"]; ?>" />
        </div>
      </div>
      <div class="form-group">
        <label class="control-label" for="heading">Under Which Heading</label>
          <div class="">
          <select class="form-control" id="heading" name="heading" <?php echo $disabled; ?>>
            <option <?php if ($array["Heading"] == "In College") {
    echo 'selected="selected"';
} ?> >In College</option>
            <option <?php if ($array["Heading"] == "Out of College") {
    echo 'selected="selected"';
} ?>>Out of College</option>
            <option <?php if ($array["Heading"] == "No Group") {
    echo 'selected="selected"';
} ?>>No Group</option>
          </select>
        </div>
      </div>
      <!--<div class="form-group">
        <label class="control-label" for="height">Height:</label>
        <div class="">
          <input type="range" min="1" max="5" class="form-control" id="height" name="height" value="<?php echo $array["Height"]; ?>" />
        </div>
      </div>-->
      <div class="form-group">
        <label class="control-label" for="bottomrow">Place on Bottom Row at Signing In Page?</label>
        <div class="">
          <input type="checkbox" id="bottomrow" name="bottomrow" value="true" <?php if ($array["BottomSpace"] == "true") {
    echo 'checked="checked"';
} ?> />
        </div>
      </div>
      <div class="form-group">
        <div class="">
          <input type="submit" value="Finish" class="btn btn-default"/>
        </div>
        <input type="hidden" value="<?php echo $array['ID'];?>" name="id"/>
      </div>
    </form>
    </div>
  </body>
</html>
