$(document).ready(function()
{
$.ajax({
  method: 'get',
  url: 'download.php',
  dataType: 'json',
	success: function (data) {
  		updateColours(data);
  		updateSelection(data);
	}
});

});

function updateColours(data)
{
	$(document).ready(function()
	{
		$.ajax({
			method: 'get',
			url: 'downloadLocations.php',
			dataType: 'json',
			success: function(locations)
			{
		$.each(data, function(key, val)
		{
			$.each(locations, function(id, location)
			{
				if(val.Location == location.Location)
				{
					$('#'+val.ID).css("border-color", location.Colour);
				}
		});
		});
	}
	});
	});
}
function updateSelection(data)
{	
	$.each(data, function(key, val)
	{
	$('#'+ val.ID).click(function(e)
	{
		if($('#selected'+val.ID).css("visibility") == "hidden")
		{
			$('#selected'+val.ID).css("visibility", "visible");
		}
		else if($('#selected'+val.ID).css("visibility") == "visible")
		{
			$('#selected'+val.ID).css("visibility", "hidden");
		}
	});
});
}
