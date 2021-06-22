<?php

$selected='adm_albums';

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

$user_id=$user['id'];

  $alert = '';
  $date = date('Y-m-d H:i:s');
  $title = getPost('title');
  $thumbnail =getPost('thumbnail');
  $description =getPost('description');
  $game_id = getPost('game_id');

  $delID= getPost('delID');

  $editID = getGet('editID');

  if ($editID !=''){
        //tránh tình trạng typing vào url
        $edit_album = executeResult(" select * from albums where id = $editID " ,true);

        if ($edit_album=='') {
          header('Location: adm_albums.php');
          die();
        }
    }

  if (!empty($_POST)) {
    //delete
    if ($delID!='') {
        execute("delete from photoes where album_id = $delID");
        execute("delete from albums where id = $delID");

        mess('<b>Album có ID='.$delID.'</b> đã bị xóa bỏi admin '.$user['fullname'],'adm_albums.php');

        header('Location: adm_albums.php');
        die();
    }

    //add
    if ($title!='' && $editID =='') {

        execute("insert into albums (title , game_id , thumbnail,description ,created_at , updated_at ) 
            values ('$title', '$game_id' ,'$thumbnail' ,'$description', '$date','$date')");

        mess('<b>Album '.$title.'</b> đã được tạo bỏi admin '.$user['fullname'],'adm_albums.php');

        echo "<script>
          alert('Bạn đã thêm một albums mới !')
          window.location.replace('adm_albums.php')
        </script>";
    }
    //edit
    if ( $title!='' && $editID !=''){
        execute("update albums set title='$title' ,game_id='$game_id',
                    thumbnail='$thumbnail' ,description='$description' ,
                      updated_at='$date' where id ='$editID' ");

        mess('<b>Album '.$title.'</b> đã được update bởi admin '.$user['fullname'],'adm_albums.php');

        header('Location: adm_albums.php');
        die();
    }
  }

//pagination

  $search=getGET('search');
  if ($search !='') {
    $sub_sql = " and ( albums.id like '%$search%' or albums.title like '%$search%' ) ";
  }else {$sub_sql='';}

$totalItems = executeResult("select count(*) 'count' from albums , games , category
                                                      where albums.game_id = games.id and games.cate_id = category.id  ".$sub_sql ,true);
  $totalItems = $totalItems['count'];

$href='adm_albums.php?search='.$search.'&';

$page = getGET('page');
if($page==''){$page = 1;}

$limit  =5;
$totalPages = ceil($totalItems / $limit);
$start = ($page-1) * $limit;

$data = executeResult(" select albums.id ,albums.title 'albums title' ,albums.thumbnail, games.title 'games title',category.title 'category title',games.updated_at
                                                      from albums , games , category
                                                      where albums.game_id = games.id and games.cate_id = category.id ".$sub_sql. "

                                                        order by albums.updated_at desc
                                                        limit $start , $limit "
                                                    );
