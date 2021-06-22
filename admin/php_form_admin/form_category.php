<?php

$selected='adm_category';

  $user = checkLogin();
      if ($user=='') {
        header('Location: index.php');
        die();
      }
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
  $delID= getPost('delID');

  $editID = getGet('editID');
  if ($editID !=''){
        $edit_cate = executeResult("select * from category where id = $editID ",true);
        if ($edit_cate=='') {
          header('Location: adm_category.php');
          die();
        }
    }

  if (!empty($_POST)) {
    //delete
    if ($delID!='') {
        execute("delete from category where id = $delID");
        mess('<b>Danh mục ID='.$delID.'</b> đã bị xóa bởi admin '.$user['fullname'],'adm_category.php');
        header('Location: adm_category.php');
        die();
    }

    //add
    if ($title!='' && $editID =='') {
        execute("insert into category(title , created_at , updated_at) values ('$title','$date','$date')");

        mess('<b>Danh mục '.$title.'</b> đã được tạo bởi admin '.$user['fullname'],'adm_category.php');
        echo "<script>
          alert('Ban da them danh muc thanh cong')
          window.location.replace('adm_category.php')
        </script>";
    }
    //edit
    if ( $title!='' && $editID !=''){
        execute("update category set title='$title' , updated_at='$date' where id ='$editID' ");
        mess('<b>Danh mục '.$title.'</b> đã được update bởi admin '.$user['fullname'],'adm_category.php');
        header('Location: adm_category.php');
        die();
    }
  }

  //pagination
  $search=getGET('search');
  if ($search !='') {
    $sub_sql = " where ( category.id like '%$search%' or category.title like '%$search%' ) ";
  }else {$sub_sql='';}

  $totalItems = executeResult("select count(*) 'count' from category ".$sub_sql,true);
  $totalItems = $totalItems['count'];

  $href='adm_category.php?search='.$search.'&';

  $page = getGET('page');
  if($page==''){$page = 1;}

  $limit  =5;
  $totalPages = ceil($totalItems / $limit);
  $start = ($page-1) * $limit;

  $data = executeResult("select * from category ".$sub_sql."order by updated_at desc  limit $start , $limit ");

  $cate = $data;