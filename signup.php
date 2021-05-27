<?php
	require_once 'db/dbhelper.php';
	require_once 'utility/utils.php';

	 $user = checkLogin();

	$alert = '';
	$date= date('Y-m-d H:i:s');
	$email = getPost('email');
	$fullName = getPost('fullName');
	$birthday = getPost('birthday');
	$address = getPost('email');
	$phone_no = getPost('phone_no');
	$pwd = getPost('pwd');
	$cf_pwd = getPost('cf_pwd');

	if (!empty($_POST)) {
			//check email
			$user=executeResult(" select * from users where email = '$email' ");
			echo count($user);
			if (count($user)>0) {
				$alert= 'email đã được sử dụng';
			}

			//nếu email hợp lệ và pass khớp nhau
			if (count($user)==0 && $pwd==$cf_pwd) {
					$password= getMd5($pwd);
					$sql = "insert into users(email , password, fullname, phone_no , address , birthday, created_at, updated_at) 
						values ('$email', '$password', '$fullName', '$phone_no', '$address','$birthday', '$date','$date')";
					execute($sql);

					header('Location: login.php');
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
				<h2 class="text-center">Sign up form</h2>
			</div>
			<div class="panel-body">
				<form id="signup_form" method="post">
					<span style="color: red"><?= $alert ?></span>
					
					<div class="form-group">
					  <label for="email">Email:</label>
					  <input required="true" type="email" class="form-control" id="email" name="email" value="<?= $email ?>">
					</div>

					<div class="form-group">
					  <label for="fullName">Full name:</label>
					  <input required="true" type="text" class="form-control" id="fullName" name="fullName" value="<?= $fullName ?>">
					</div>

					<div class="form-group">
					  <label for="phone_no">Phone number:</label>
					  <input required="true" type="text" class="form-control" id="phone_no" name="phone_no" value="<?= $phone_no ?>">
					</div>

					<div class="form-group">
					  <label for="address">Address:</label>
					  <input required="true" type="text" class="form-control" id="address" name="address" value="<?= $address ?>">
					</div>
					
					<div class="form-group">
					  <label for="birthday">Birthday:</label>
					  <input required="true" type="date" class="form-control" id="birthday" name="birthday" value="<?= $birthday ?>">
					</div>
					<div class="form-group">
					  <label for="pwd">Password:</label>
					  <input required="true" type="password" class="form-control" id="pwd" name="pwd">
					</div>
					<div class="form-group">
					  <label for="cf_pwd">Confirmation Password:</label>
					  <input required="true" type="password" class="form-control" id="cf_pwd" name="cf_pwd">  
					</div>
					
					<center><button class="btn btn-warning" style="font-size: 20px;">Sign Up</button></center>
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