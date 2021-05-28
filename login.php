<?php
	require_once 'db/dbhelper.php';
	require_once 'utility/utils.php';

	$user = checkLogin();
	// var_dump($user);
	if ($user!='') {
		header('Location: index.php');
	}

	$alert = '';
	$email = getPost('email');
	$pwd = getPost('pwd');
	$password= getMd5($pwd);

	if (!empty($_POST)) {
			//check email
			$check=executeResult(" select * from users where email = '$email' and password='$password'");
		
			if (count($check)==1) {
				$user=$check[0];
				//tạo token 
				$token = getMd5($user['email'].time());
				//luu token lên cookie
				setcookie("token", $token ,0, "/");
				//update lên db
				execute("update users set token = '$token' where email='$email' ");

				header('Location: index.php');
			}else{
				$alert='Email hoặc password không đúng !';
			}		
		
	}
?>
<!DOCTYPE html>
<html>
<head>
  <title></title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <!-- include summernote css/js -->
  <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote.css" rel="stylesheet">
  <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote.js"></script>
  <link rel="stylesheet" type="text/css" href="style/style.css">
</head>
<body>
    <?php include 'layout/header.php'; ?>

    <div style=" width:600px;margin: 0px auto; margin-top: 50px;">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h2 class="text-center">Login</h2>
			</div>
			<div class="panel-body">
				<form id="login_form" method="post">
					<span style="color: red"><?= $alert ?></span>
					
					<div class="form-group">
					  <label for="email">Email:</label>
					  <input required="true" type="email" class="form-control" id="email" name="email" value="<?= $email ?>">
					</div>

					<div class="form-group">
					  <label for="pwd">Password:</label>
					  <input required="true" type="password" class="form-control" id="pwd" name="pwd">
					</div>
					
					<center><button class="btn btn-warning" style="font-size: 20px;">Login</button></center>
				</form>
			</div>
		</div>
	</div>

    <?php include 'layout/footer.php'; ?>

 <script type="text/javascript">
 	$('#signup_form').submit(function(){
 		if ($('#pwd').val() != $('#cf_pwd').val()) {
 			alert('Password chua khop nhau')
 			$('#pwd').val('')
 			$('#cf_pwd').val('')
 			$('#pwd').focus()
 			return false;
 		}
 	})
 </script>
</body>
</html>