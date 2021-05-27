<?php
require_once '../db/dbhelper.php';
require_once '../utility/utils.php';
$alert='';
$email = getPost('email');
$fullname = getPost('fullname');
$pass = getPost('pass');
$pass = getMd5($pass);

if (!empty($_POST) && $email!='') {
	//check tồn tại 
	$sql = "select count(*) as 'total' from users where email = '$email' ";
	$check = executeResult($sql,true);

	if ($check['total']==0) {
		//set token , đưa vào cookie và db
		$token = getMd5($fullname.time());
		setcookie('token',$token,0,'/');

		$sql = "insert into users (email ,fullname, pass ,token) values ('$email','$fullname','$pass','$token') ";
		execute($sql);
		header('Location: notes.php');

	}else{
		//nếu tìm thấy thì in ra dòng chữ thông báo lỗi
		$alert=' (Email da duoc su dung , vui lòng sử dụng một email khác !!!)';
	}

	
}
