<?php
require_once 'login_form.php';
?>

<!DOCTYPE html>
<html>
<head>
	<title>Login page</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	<!-- include summernote css/js -->
	<link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote.css" rel="stylesheet">
	<script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote.js"></script>
</head>
<body>
	<div class="container">
		<form method="post" style="width: 800px;margin:0px auto;margin-top: 50px;">
			<span style="color: red"><?=$alert ?></span>
			<div class="form-group">
				<label>Email</label>
				<input class="form-control" type="email" name="email" value="<?= $email?>">
			</div>
			<div class="form-group">
				<label>Pass</label>
				<input class="form-control" type="password" name="pass">
			</div>
			<button class="btn btn-danger">Login</button>
		</form>
	</div>
</body>
</html>