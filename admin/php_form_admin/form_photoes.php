<?php

$selected='adm_photoes';

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
  $address=getPost('address');
  $album_id=getPost('album_id');

  if (isset($_FILES['photo_file']) &&$_FILES['photo_file']!='') {

    $result=upload($_FILES['photo_file'],array('jpg', 'png', 'jpeg', 'gif','JPG', 'PNG', 'JPEG', 'GIF') );

    $alert= $result[1];
    if ($alert=='') {
      //lấy tên file nếu ko có báo cáo lỗi
      $address=$result[0];
    }
    
  }
  

  $delID= getPost('delID');

  $editID = getGet('editID');
  if ($editID !=''){
        $edit_photo = executeResult("select * from photoes where id = $editID ",true);
        if ($edit_photo=='') {
          header('Location: adm_photoes.php');
          die();
        }
    }

if (!empty($_POST)) {

    //delete
    if ($delID!='') {
        execute("delete from photoes where id = $delID");

         mess('<b>Photo ID='.$delID.'</b> đã bị xóa bởi admin '.$user['fullname'],'adm_photoes.php');

        header('Location: adm_photoes.php');
        die();
    }

    //add
    if ($title!='' && $editID =='' &&$address !='') {
        execute("insert into photoes(title ,address , album_id, created_at , updated_at)
                   values ('$title','$address' ,$album_id , '$date','$date')");

         mess('<b>Photo '.$title.'</b> đã được thêm bởi admin '.$user['fullname'],'adm_photoes.php');

        echo "<script>
          alert('Bạn đã thêm ảnh thành công')
          window.location.replace('adm_photoes.php')
        </script>";
    }
    //edit
    if ( $title!='' && $editID !='' &&$address !=''){
        execute("update photoes set title='$title' ,address='$address' , album_id='$album_id' ,
                      updated_at='$date' where id ='$editID' ");

        mess('<b>Photo '.$title.'(ID='.$editID.')</b> đã được update bởi admin '.$user['fullname'],'adm_photoes.php');

        header('Location: adm_photoes.php');
        die();
    }
  }

//pagination form ?page=
  $search=getGET('search');
  if ($search !='') {
    $sub_sql = " and ( photoes.id like '%$search%' or photoes.title like '%$search%' ) ";
  }else {$sub_sql='';}

$totalItems = executeResult("select count(*) 'count' from photoes join albums 
                                                    on photoes.album_id = albums.id ".$sub_sql,true);
  $totalItems = $totalItems['count'];

$href='adm_photoes.php?search='.$search.'&';

$page = getGET('page');
if($page==''){$page = 1;}

$limit  =5;
$totalPages = ceil($totalItems / $limit);
$start = ($page-1) * $limit;

  $data = executeResult("select photoes.id , photoes.title  ,photoes.address,
                                                         albums.title 'album title' ,photoes.created_at ,
                                                        photoes.updated_at ,games.id 'game id' , games.title 'game title' 
                                                    from photoes ,albums ,games
                                                    where photoes.album_id = albums.id and albums.game_id = games.id 
                                                    ".$sub_sql."
                                                    order by photoes.updated_at desc    limit $start , $limit      ");

$game_list = executeResult("select games.id, games.title from games");
