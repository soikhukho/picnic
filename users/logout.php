<?php
require_once '../db/dbhelper.php';
require_once '../utility/utils.php';

$token='';
if(isset($_COOKIE['token'])){
	$token = $_COOKIE['token'];
}
// var_dump($_COOKIE);
// echo $token;
// die();

$sql = "update users set token = null where token = '$token' ";
echo $sql;
execute($sql);

setcookie('token','',time()-1,'/');

header('Location: login.php');