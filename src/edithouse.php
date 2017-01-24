
<!DOCTYPE html>
<html>
  <head>
	<?php
	  	require_once "php/session.php";	
		require_once "php/cdn.php";
		require_once "php/houselist.php";
		require_once "navbaradmin.php";
		$row = null;
		foreach($houseList as $house)
		{
			if($house["ID"] == $_GET['id'])
			{
				$row = $house;
			}
		}
	?>
  </head>
  <body>
  <div class="container">
    <h1 class="page-header">Edit House</h1>
    <form role="form" method="post" action="php/changehouse.php">
      <div class="form-group">
        <label class="control-label" for="housename">House name:</label>
        <div class="">
          <input type="text" required="true" class="form-control" id="housename" name="emptyname" disabled placeholder="Enter Housename" value="<?php echo ucfirst($house['House']);?>"/>
        </div>
      </div>
      <div class="form-group">
        <label class="control-label" for="housename">House initials:</label>
        <div class="">
          <input type="text" required="true" class="form-control" id="houseinitials" name="houseinitials" placeholder="Enter House initials" value="<?php echo $house['HouseInitials'];?>"/>
        </div>
      </div>
      <div class="form-group">
        <label class="control-label" for="housecolour">Pick a House Colour:</label>
        <div class=""> 
          <input type="button" class=" form-control jscolor {valueElement: 'color_value'}" value="Pick a Colour"/>
          <input type="text" style="visibility: hidden;" name="housecolour_1" id="color_value" value="<?php echo $house['HouseColour_1'];?>"/>
        </div>
      </div>
      <div class="form-group">
          <label class="control-label" for="colour">Require Secondary Colour? (Check again if you require an extra colour)</label>
          <div class=""> 
            <input type="checkbox" name="secondarycolour" value="enabled"/>
          </div>
        </div>
        <div class="form-group">
          <label class="control-label" for="housecolour_2">Pick a Secondary Colour:</label>
          <div class=""> 
            <input type="button" class=" form-control jscolor {valueElement: 'color_value2'}" value="Pick a Colour"/>
            <input type="text" style="visibility: hidden;" name="housecolour_2" id="color_value2" value="<?php echo $house['HouseColour_2'];?>"/>
          </div>
        </div>
      <div class="form-group"> 
        <div class="">
          <input type="submit" value="Finish" class="btn btn-default"/>
        </div>
      <input type="hidden" name="id" id="id" value="<?php echo $house['ID'];?>"/>
      <input type="hidden" name="housename" value="<?php echo $house['House'];?>"/>
    </form>
    </div>
  </body>
</html>