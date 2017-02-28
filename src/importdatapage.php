

<!DOCTYPE html>
<html>
	<head>
		<?php
			require "php/cdn.php";
			require "navbar.php";
			$overwrite = $_GET["overwrite"];
		 ?>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
	</head>
	<body>
		<div class="container">
			<h1 class="page-header">Import Excel Table</h1>
			<form action="php/importdata.php" method="post" role="form" enctype="multipart/form-data">
				<div class="form-group">
	       			<label class="control-label" for="file">File:</label>
	        		<div class="">
	          			<input type="file" class="form-control" id="file" name="file" placeholder="Select File" accept=".xlsx"/>
	        		</div>
	      		</div>
	      		<div class="form-group">
	        		<div class="">
	          			<input type="submit" value="Upload" class="btn btn-default"/>
	        	</div>
	        	<input type="hidden" value="<?php echo $overwrite;?>" name="overwrite"/>
	      	</div>
	      	</form>
		</div>
	</body>
</html>
