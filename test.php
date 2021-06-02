<!DOCTYPE html>
<html>
<head>
	<title>test</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	<!-- include summernote css/js -->
	<link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote.css" rel="stylesheet">
	<script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote.js"></script>
	<link rel="stylesheet" type="text/css" href="style/toogle_switch.css">
</head>
<body>
	
	<button id="btn" class="btn btn-danger">show</button>

	<?php include_once 'popup_login.php'; ?>

	<script type="text/javascript">
		$('#btn').click(function () {
			document.getElementById("popup_login").style.display=''
		})
	</script>
</body>
<input type="" name="" readonly="true">
</html>