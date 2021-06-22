<?php

$user = checkLogin();
      if ($user=='') {
        header('Location: index.php');
        die();
      }
$user_id=$user['id'];
$active=$user['active'];
if ($active != 1) {
  echo '<script type="text/javascript">
          alert("Tài khoản của bạn chưa được kích hoạt")
          window.location.replace("admin.php")
        </script>';
}

$change_id =getPost('change_id');
$checked_all =getPost('checked_all');


if ($change_id!='' && $checked_all=='') {
    execute("update message set status = 1 where id = $change_id");
}

if ($change_id=='' && $checked_all!=''){
     execute("update message set status = 1");
}

//pagination
$search=getGET('search');
  if ($search !='') {
    $sub_sql = " where content like '%$search%' ";
  }else {$sub_sql='';}

$totalItems = executeResult("select count(*) 'count' from message ".$sub_sql,true);
  $totalItems = $totalItems['count'];

$href='adm_message.php?search='.$search.'&';

$page = getGET('page');
if($page==''){$page = 1;}

$limit  =10;
$totalPages = ceil($totalItems / $limit);
$start = ($page-1) * $limit;

$sql="select * from message ".$sub_sql." order by status asc, created_at desc limit $start , $limit ";
$data=executeResult($sql);
