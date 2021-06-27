<?php

$selected="adm_games";

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
  $cate_id = getPost('cate_id');
  $price = getPost('price');

  $delID= getPost('delID');

  $editID = getGet('editID');
  $trashed_id = getPost('trashed_id');
  $restore_id = getPost('restore_id');

  $select=" and games.status = '0' ";
 
  $game_status = getGet('game_status');
  if ($game_status=='-1') {
    $select=" and games.status = '-1' ";
  }

  
 //kích hoạt xóa 
  //ngày cách đây 1 tháng :
  $month = strtotime(date("Y-m-d", strtotime($date)) . " -1 month");
  $a_month_ago = strftime("%Y-%m-%d", $month);

  execute("delete from games where status !=0 and updated_at < '$a_month_ago' ");




  if ($editID !=''){
        //tránh tình trạng sửa trên url
        $edit_game = executeResult(" select * from games where id = $editID " ,true);

        if ($edit_game=='') {
          header('Location: adm_games.php');
          die();
        }
    }

  if (!empty($_POST)) {
    //tráhed 
    if ($trashed_id !='') {
      execute("update games set status = '-1' , updated_at ='$date' where id = '$trashed_id' ");
      mess('<b>Game ID='.$trashed_id.'</b> đã bị ẩn bởi admin '.$user['fullname'],'adm_games.php');
    }

    //restore
    if ($restore_id !='') {
      execute("update games set status = '0' where id = '$restore_id' ");
      mess('<b>Game ID='.$restore_id.'</b> đã được RESTORE bởi admin '.$user['fullname'],'adm_games.php');
    }

    //delete
    if ($delID!='') {
        execute("delete from games where id = $delID");
        mess('<b>Game ID='.$delID.'</b> đã bị xóa bởi admin '.$user['fullname'],'adm_games.php');
        header('Location: adm_games.php');
        die();
    }

    //add
    if ($title!='' && $editID =='') {

        execute("insert into games (title , cate_id,price , thumbnail,description ,content , created_at , updated_at , user_id) 
            values ('$title', '$cate_id', '$price','$thumbnail' ,'$description', '$content','$date','$date', '$user_id')");
        mess('<b>Game '.$title.'</b> đã được tạo mới bởi admin '.$user['fullname'],'adm_games.php');
    
        echo "<script>
          alert('Bạn đã thêm một games mới !')
          window.location.replace('adm_games.php')
        </script>";
    }
    //edit
    if ( $title!='' && $editID !=''){
        execute("update games set title='$title' ,cate_id='$cate_id',price='$price',
                    thumbnail='$thumbnail' ,description='$description' ,content= '$content',
                      updated_at='$date' where id ='$editID' ");

        mess('<b>Game '.$title.'(ID='.$editID.')</b> đã được update bởi admin '.$user['fullname'],'adm_games.php');

        header('Location: adm_games.php');
        die();
    }
  }

//pagination
  $search=getGET('search');
  if ($search !='') {
    $sub_sql = " and ( games.id like '%$search%' or games.title like '%$search%' ) ";
  }else {$sub_sql='';}

$totalItems = executeResult("select count(*) 'count' from games ,  category , users
                                                    where games.cate_id = category.id 
                                                    and  games.user_id = users.id   ".$select.$sub_sql,true);
  $totalItems = $totalItems['count'];

$href='adm_games.php?game_status='.$game_status.'&search='.$search.'&';

$page = getGET('page');
if($page==''){$page = 1;}

$limit  =5;
$totalPages = ceil($totalItems / $limit);
$start = ($page-1) * $limit;


$data = executeResult(" select games.id ,games.title 'game title',
                                                        category.title 'category title' ,
                                                        games.thumbnail ,games.price , users.fullname , games.created_at , games.updated_at ,games.status
                                                    from games ,  category , users
                                                    where games.cate_id = category.id 
                                                    and  games.user_id = users.id  ".$select.$sub_sql."
                                                    ORDER by games.updated_at desc limit $start , $limit ");
