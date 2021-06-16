<?php
require_once 'db/dbhelper.php';

//nếu đang có cookie token thì xóa đi
if (isset($_COOKIE['token'])) {

	$token=$_COOKIE['token'];
	$sql = " update users set token = null where token ='$token' ";
	execute($sql);


	setcookie("token",'' ,time() -1, "/");


};
header('Location: index.php');
die();