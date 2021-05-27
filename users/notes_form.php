<?php
require_once '../db/dbhelper.php';
require_once '../utility/utils.php';

$user = checkLogin();
// var_dump($user);

if ($user == '') {
	header('Location: login.php');
}
$user_id = $user['id'];

$title = getPOST('title');
$content = getPOST('content');
$delID = getPOST('delID');
$editID = getGET('editID');
if ($editID!='') {
	$editNote = executeResult("select * from notes where id = '$editID' ",true);
}

$date = date('Y-m-d H:i:s');
$alert='';
//xóa
if($delID!=''){
	$sql = "delete from notes where id = '$delID' and user_id = '$user_id' ";
	execute($sql);
}

//thêm
if ($editID=='' && $title !='') {
	//check trùng tên
	$check = executeResult("select count(*) as 'check' from notes where title='$title' ");
	
	if ($check[0]['check']!=0) {
		echo "<script>
					alert('Ten nay da duoc su dung')
				</script>";
		$alert="ten nay da duoc su dung";
		return;
	}else{
			$sql= "insert into notes(title , content , user_id , created_at , updated_at ) values 
					( '$title', '$content' , $user_id , '$date' , '$date') ";
			execute($sql);
			header('Location: notes.php');
		}
}

//edit
if ($editID!='' && $title !=''){
	$sql= "update notes set title= '$title', content='$content' ,updated_at= '$date' where id='$editID' and user_id='$user_id' ";
	echo $sql;
	execute($sql);
	header('Location: notes.php');
}