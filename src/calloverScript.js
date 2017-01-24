var ids = [];

function validate()
{
	$('.callover').each(function()
	{
		if(String($('#selectedcallover'+$(this).attr('id')).css("visibility")).valueOf() == String("visible").valueOf())
		{
			ids.push($(this).attr('id'));
		}
	});
	var result = ids.toString();
	$(document).ready(function(){
	$.ajax({ url: "updateCallover.php", method: "post", data: {ids: result}, success : function(e)
		{
			window.location.reload(true);
		} });
		var newIDs = [];
		$('.namelink').each(function()
		{
			$(this).fitText();
			if(String($('#selected'+$(this).attr('id')).css("visibility")).valueOf() == String("visible").valueOf())
			{
				newIDs.push($(this).attr('id'));
			}
		});
		var newResult = newIDs.toString();
		$(document).ready(function()
		{
			$.ajax({url: "update.php", method: "POST", data: {ids: result, location: "In House", user: "Callover"},success: function(e)
			{		
				//console.log(e);	
				window.location.reload(true);
			}});
		});
});
}
function resetCallover()
{
	window.location.href = "newcallover.php";
}
$(document).ready(function(){
$.ajax({url: "downloadCallover.php", dataType: "json", method: "post", success: function(data)
{
	$.each(data, function(key, val)
	{
		if(String(val.CalledOver).valueOf() == String("false").valueOf())
		{
			$('#notselectedcallover'+val.StudentID).css("visibility","visible");
		}
		else if(String(val.CalledOver).valueOf() == String("true").valueOf())
		{
			$('#notselectedcallover'+val.StudentID).css("visibility", "hidden");
		}
	});
	
}});
});
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
		if($('#selectedcallover'+val.ID).css("visibility") == "hidden")
		{
			$('#selectedcallover'+val.ID).css("visibility", "visible");
		}
		else if($('#selectedcallover'+val.ID).css("visibility") == "visible")
		{
			$('#selectedcallover'+val.ID).css("visibility", "hidden");
		}
	});
});
}