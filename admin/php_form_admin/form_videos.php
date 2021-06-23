<?php
session_start();
$alert = '';
if (isset($_SESSION['alert'])) {
  $alert = $_SESSION['alert'];
}

$selected='adm_videos';

  $user = checkLogin();
      if ($user=='') {
        header('Location: index.php');
        die();
      }
    $user_id=$user['id'];

//rồi code tiếp php ở đây


//pagination form ?page=
  $search=getGET('search');
  if ($search !='') {
    $sub_sql = " and ( videos.id like '%$search%' or videos.title like '%$search%' ) ";
  }else {$sub_sql='';}

$totalItems = executeResult("select count(*) 'count' from videos,games where videos.game_id = games.id ".$sub_sql,true);
  $totalItems = $totalItems['count'];

$href='adm_videos.php?search='.$search.'&';

$page = getGET('page');
if($page==''){$page = 1;}

$limit  =5;
$totalPages = ceil($totalItems / $limit);
$start = ($page-1) * $limit;

$sql="select videos.* , games.id 'game id' , games.title 'game title' from videos,games where videos.game_id = games.id ".$sub_sql." 
            order by updated_at desc    
            limit $start , $limit      ";

$data = executeResult($sql);

    
//

  $date = date('Y-m-d H:i:s');
  $title = getPost('title');
  $address=getPost('address');
  $game_id = getPost('game_id');


  $file_name=[];
  if (isset($_FILES['video_file']) ) {

       $files = $_FILES['video_file'];

        $names      = $files['name'];
        $types      = $files['type'];
        $tmp_names  = $files['tmp_name'];
        $errors     = $files['error'];
        $sizes      = $files['size'];


        $numitems = count($names);
        $numfiles = 0;

        $maxfilesize  = 1048576*30;
        $maxfilesize_MB = $maxfilesize/1048576;

        for ($i = 0; $i < $numitems; $i ++) {
            //Kiểm tra file thứ $i trong mảng file, up thành công không
            if ($errors[$i] == 0)
            {
                $numfiles++;

                $allowtypes    = array('JPG','avi', 'flv', 'wmv', 'mov', 'mp4','AVI', 'FLV', 'WMV', 'MOV', 'MP4',);
                
                $fileType = pathinfo($names[$i],PATHINFO_EXTENSION);

                if (file_exists('../uploads/'.$names[$i]) ==true ) {
                  $alert=$alert.'Error : file <b>'.$names[$i].'</b> đã tồn tại trên thư mục uploads/ ; <br>';
                }

                if (!in_array($fileType,$allowtypes) ) {
                  $alert=$alert.'Error : file <b>'.$names[$i].'</b> có định dạng không phù hợp để uploads ; <br>' ;
                }

                if ($sizes[$i] > $maxfilesize) {
                  $alert=$alert.'Error : file <b>'.$names[$i].'</b> có kích thước lớn hơn giới hạn là '.$maxfilesize_MB.'MB ; <br>';
                }

                //nếu tên file chưa tồn tại và đúng kiểu 
                if (!file_exists('../uploads/'.$names[$i]) && in_array($fileType,$allowtypes) && $sizes[$i] <= $maxfilesize )
                {

                  move_uploaded_file($tmp_names[$i], '../uploads/'.$names[$i]);

                   $file_name[]=$names[$i];

                   $alert=$alert.'<span style="color:green">Success: upload thành công file '.$names[$i].' vào thư mục uploads/</span><br>';

                 }

            }
        } 

  }



  $delID= getPost('delID');

  $editID = getGet('editID');
  if ($editID !=''){
        $edit_video = executeResult("select videos.* , games.id 'game id' from videos,games where videos.game_id = games.id and videos.id = $editID ",true);

        if ($edit_video=='') {
          header("Location: adm_videos.php");
          die();
        }
    }

if (!empty($_POST)) {

    //delete
    if ($delID!='') {
        execute("delete from videos where id = $delID");

         mess('<b>Video ID='.$delID.'</b> đã bị xóa bởi admin '.$user['fullname'],'adm_videos.php');

    }

    //add
    if ($title!='' && $editID =='' ) {
    	if ($address!='') {
        //dùng url
    		execute("insert into videos(title ,address , game_id, created_at , updated_at)
                   values ('$title','$address' ,$game_id , '$date','$date')");

	       mess('<b>Video '.$title.'</b> đã được thêm bởi admin '.$user['fullname'],'adm_videos.php');

	       echo "<script>
            alert('Bạn đã thêm video thành công')
            window.location.replace('adm_videos.php')
          </script>";
    	}
    	else{

    		foreach ($file_name as $address) {
    		
	    		execute("insert into videos(title ,address , game_id, created_at , updated_at)
                   values ('$title','$address' ,$game_id , '$date','$date')");

          mess('<b>Video '.$title.'</b> đã được thêm bởi admin '.$user['fullname'],'adm_videos.php');

		        
	    	}

        $_SESSION['alert']=$alert;
        header("Location: adm_videos.php");
        die();
    	}
        
    }
    //edit
    if ( $title!='' && $editID !='' ){
      if ($address =='') {
        $address = $file_name[0];
      }
       
        execute("update videos set title='$title' ,address='$address' , game_id='$game_id' ,
                      updated_at='$date' where id ='$editID' ");

        mess('<b>Video '.$title.'(ID='.$editID.')</b> đã được update bởi admin '.$user['fullname'],'adm_videos.php');

        header("Location: adm_videos.php");
        die();

    }

  }
