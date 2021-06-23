<?php

$selected='adm_users';

  $user = checkLogin();
      if ($user=='' ||$user['email']!='picnic@gmail.com') {
        header('Location: admin.php');
        die();
      }
$active=$user['active'];
if ($active != 1) {
  echo '<script type="text/javascript">
          alert("Tài khoản của bạn chưa được kích hoạt")
          window.location.replace("admin.php")
        </script>';
}

    $active = getPost('active');
  $delID= getPost('delID');
  $updateID= getPost('updateID');
  $pwd = getPost('pwd');
  $password = getMd5($pwd);
  $date = date('Y-m-d H:i:s');

  if (!empty($_POST)) {
    //delete
    if ($delID!='') {
        execute("delete from users where id = $delID");
    }

    //update pass for user
    if($updateID!='' && $pwd !=''){
        execute("update users set password = '$password', updated_at = '$date' where id = $updateID");
    }

    //active
    if ($active!='') {
      $user=executeResult("select * from users where id=$active",true);
        if ($user['active']==1) {
          execute("update users set active=0 where id= $active");
        }else{execute("update users set active=1 where id= $active");}
    }
        
  }

  function total_post($user_id){
    $x= executeResult("select count(*) 'places' from places where user_id = $user_id ",true);
    $y= executeResult("select count(*) 'games' from games where user_id = $user_id ",true);

    return ($total_post=$x['places'] + $y['games']);
  }

  //pagination form ?page=
  $search=getGET('search');
  if ($search !='') {
    $sub_sql = " where ( users.email like '%$search%' or users.fullname like '%$search%' ) ";
  }else {$sub_sql='';}

$totalItems = executeResult("select count(*) 'count' from users ".$sub_sql,true);
  $totalItems = $totalItems['count'];

$href='adm_users.php?search='.$search.'&';

$page = getGET('page');
if($page==''){$page = 1;}

$limit  =5;
$totalPages = ceil($totalItems / $limit);
$start = ($page-1) * $limit;

$data = executeResult("select * from users ".$sub_sql." order by created_at desc limit $start , $limit ");

$vip = executeResult("select * from users where email='picnic@gmail.com' " , true);
