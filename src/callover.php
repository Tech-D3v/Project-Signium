<!DOCTYPE html>
<html>
	<head>
		<?php
            require_once "php/cdn.php";
        ?>
		<script src="socket_server/node_modules/socket.io/node_modules/socket.io-client/socket.io.js"></script>
		<script src="js/config.js"></script>
		<script src="js/calloverscript.js"></script>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<style>
			.btn-finish
			{
				width: 100%;
			}
		</style>
	</head>
	<body>
		<?php
            require_once "navbar.php";
        ?>
				<div class="container">
				<button class="btn btn-success btn-finish" onclick="uploadData();">Finish</button>
			<ul class="list-group calloverlist">
			</ul>
			<button class="btn btn-success btn-finish" onclick="uploadData();">Finish</button>
		</div>
	</body>
</html>
