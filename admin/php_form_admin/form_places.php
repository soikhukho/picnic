<?php

$selected='adm_places';

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

  $alert = '';
  $date = date('Y-m-d H:i:s');
  $title = getPost('title');
  $thumbnail =getPost('thumbnail');
  $description =getPost('description');
  $content =getPost('content');

  $delID= getPost('delID');

  $editID = getGet('editID');
  if ($editID !=''){
       
        $edit_place = executeResult("select * from places where id = $editID order by updated_at desc",true);
        if ($edit_place=='') {
          header('Location: adm_places.php');
          die();
        }
    }

  if (!empty($_POST)) {
    //delete
    if ($delID!='') {
        execute("delete from places where id = $delID");
        mess('<b>Địa điểm ID='.$delID.'</b> đã bị xóa bởi admin '.$user['fullname'],'adm_places.php');
        header('Location: adm_places.php');
        die();
    }

    //add
    if ($title!='' && $editID =='') {
        execute("insert into places (title , thumbnail,description ,content , created_at , updated_at , user_id) 
            values ('$title','$thumbnail' ,'$description', '$content','$date','$date', '$user_id')");

        mess('<b>Địa điểm '.$title.'</b> đã được thêm bởi admin '.$user['fullname'],'adm_places.php');
    
        echo "<script>
          alert('Bạn đã thêm một Places mới !')
          window.location.replace('adm_places.php')
        </script>";
    }
    //edit
    if ( $title!='' && $editID !=''){
        execute("update places set title='$title' ,thumbnail='$thumbnail' ,description='$description' ,content= '$content',
                      updated_at='$date' where id ='$editID' ");

        mess('<b>Địa điểm '.$title.'</b> đã được update bởi admin '.$user['fullname'],'adm_places.php');

        header('Location: adm_places.php');
        die();
    }
  }

//pagination form ?page=
  $search=getGET('search');
  if ($search !='') {
    $sub_sql = " where ( places.id like '%$search%' or places.title like '%$search%' ) ";
  }else {$sub_sql='';}

$totalItems = executeResult("select count(*) 'count' from places".$sub_sql,true);
  $totalItems = $totalItems['count'];

$href='adm_places.php?search='.$search.'&';

$page = getGET('page');
if($page==''){$page = 1;}

$limit  =5;
$totalPages = ceil($totalItems / $limit);
$start = ($page-1) * $limit;

  $data = executeResult("select * from places ".$sub_sql." order by updated_at desc limit $start , $limit ");