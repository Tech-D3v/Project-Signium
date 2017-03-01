
  <!DOCTYPE html>
  <html>
  	<head>
      <?php
          require_once "php/cdn.php";
      ?>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
  		<script>
      var timestampArray = [];
  			$(document).ready(function(){
  					$.ajax({
  						url: "php/pullcallover.php",
  						dataType: "json",
  						method: "get",
  						data: { noJSON: "true", id: 0},
  						success: function(data)
  						{
                var element = "";
                element += '<div class="list-group" style="float:left;">';
                var first = -1;
  						  $.each(data, function(key, val)
              {
                if(first == -1)
                {
                  first = val.ID;
                }
                timestampArray[val.ID] = val.Timestamp;
                element += '<a class="links list-group-item" href="#" onclick="showMore(' + val.ID + ');" id="selectCallover' + val.ID + '">' + val.Timestamp + '</a>';
              });
              element += '</div>';
              $('#sidediv').html(element);
              console.log(first);
  							showMore(first);
  						}
  					});



  });

  			function showMore(id)
  			{
          $('.links').each(
            function()
            {
              $(this).removeClass("active");
            }
          )
          $('#selectCallover' + id).addClass("active");
  				$.ajax({
  					url: "php/pullnames",
  					dataType: "json",
  					method: "get",
  					success: function(json)
  					{


  				$.ajax({
  					url: "php/pullcallover.php",
  					dataType: "json",
  					method: "get",
  					data: { noJSON: "false", id: id},
  					success: function(result)
  					{
              result = JSON.parse(result);
              var element = "";
  						element += '<div class="table-responsive"><table class="table table-striped"><thread><tr><th>Firstname</th><th>Lastname</th><th>Timestamp</th><th>Called Over?</th></tr></thread><tbody class="searchable">';
  						$.each(json, function(key, val){
  							var calledOver = false;
  							$.each(result, function(jKey, jVal)
  						{
  							if(val.ID == jVal.ID)
  							{
  								calledOver = true;
  							}

  						});
  							element += '<tr><td>'+ val.Firstname + '</td><td>' + val.Surname + '</td><td>' + timestampArray[id] + '</td><td>' + calledOver + '</td></tr>';
  						});
  						element += '</tbody></table></div>';
  						$("#maindiv").html(element);
            }
  						});
}
});
}


  		</script>
  	</head>
  	<body>
      <?php
        require "navbar.php";
      ?>
      <div class="container-fluid">
        <div id="sidediv">
        </div>
  		<div class="container">
  		<div id="maindiv">
  		</div>
  		</div>
  </div>
  	</body>
  </html>
