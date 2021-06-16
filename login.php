<?php
$alert_login = '';
$action=getPost('action');
$email = getPost('email');
$pwd = getPost('pwd');
$password= getMd5($pwd);

	if (!empty($_POST) && $action!='signup') {
				
			//check email
			$check=executeResult(" select * from users where email = '$email' and password='$password'");
		
			if (count($check)==1) {
				$user=$check[0];
				//tạo token 
				$token = getMd5($user['email'].time());
				//luu token lên cookie
				setcookie("token", $token ,time() +60*60*24*7, "/");
				//update lên db
				execute("update users set token = '$token' where email='$email' ");

				$_POST='';
				header("Refresh:0");
				die();
			}else{
				$alert_login='Email hoặc password không đúng !';
			}		
		
	}
?>