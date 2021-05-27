<?php
	require_once 'register_form.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title>Register page</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	<!-- include summernote css/js -->
	<link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote.css" rel="stylesheet">
	<script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote.js"></script>
</head>
<body>
	<div class="container" >

		<form id="form_register" method="post" style="width: 800px;margin:0px auto;margin-top: 50px;">
			<center><h2>Register form:</h2></center>

			<div class="form-group">
				<label>Email</label>
				<span style="color: red"><?=$alert?></span>
				<input  class="form-control" type="text" name="email" value="<?=$email?>">
			</div>
			<div class="form-group">
				<label>Fulname</label>
				<input  class="form-control" type="text" name="fullname" value="<?=$fullname?>">
			</div>
			<div class="form-group">
				<label>Pass</label>
				<input  class="form-control" type="password" name="pass">
			</div>
			<div class="form-group">
				<label>Confirm Pass</label>
				<input  class="form-control" type="password" name="cfpass">
			</div>
			<button class="btn btn-primary">Register</button>
		</form>
	</div>
<script type="text/javascript">
	$('#form_register').submit(function () {
		//check pass có khớp nhau không
		var pass= $('[name = pass]').val()
		var cfpass= $('[name = cfpass]').val()
		if (pass != cfpass) {
			alert('pass chua khop')
			return false;
		}
	})
</script>
</body>
</html>