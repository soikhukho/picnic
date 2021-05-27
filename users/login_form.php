<?php
require_once '../db/dbhelper.php';
require_once '../utility/utils.php';

$email = getPost('email');
$pass = getPost('pass');
$pass = getMd5($pass);
$alert='';

if (!empty($_POST)) {
	if ($email!='') {
		$sql = "select * from users where email = '$email' and pass = '$pass' ";
		$users = executeResult($sql);

		//nếu chỉ có 1 kết quả thì cho login
		if(count($users)==1){
			//tạo token rồi cho lên cookie và db
			$token = getMd5( $email.time() );
			setcookie('token',$token,0,'/');
			$sql = "update users set token = '$token' where email = '$email' ";
			execute($sql);

			header('Location: notes.php');
		}
		else{
			$alert = "email hoặc pass không đúng";
		}
	}
}