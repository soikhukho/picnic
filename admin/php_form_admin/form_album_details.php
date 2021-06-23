<?php
session_start();

$alert='';
if (isset($_SESSION['alert'])) {
  # code...
  $alert=$_SESSION['alert'];
}

$selected='adm_albums';

  $user = checkLogin();
      if ($user=='') {
        header('Location: index.php');
        die();
      }
    $user_id=$user['id'];

//rồi code tiếp php ở đây
    $album_id = getGET('album_id');
    $album=executeResult("select title from albums where albums.id='$album_id' ",true);
    $album_title=$album['title'];

    $data=executeResult("select photoes.* , albums.title 'album title' from photoes,albums where albums.id = photoes.album_id and albums.id = '$album_id' order by photoes.updated_at desc ");

//pagination form ?page=
  $search=getGET('search');
  if ($search !='') {
    $sub_sql = " and ( photoes.id like '%$search%' or photoes.title like '%$search%' ) ";
  }else {$sub_sql='';}

$totalItems = executeResult("select count(*) 'count' from photoes,albums where albums.id = photoes.album_id and albums.id = '$album_id' ".$sub_sql,true);
  $totalItems = $totalItems['count'];

$href='adm_album_details.php?album_id='.$album_id.'&search='.$search.'&';

$page = getGET('page');
if($page==''){$page = 1;}

$limit  =5;
$totalPages = ceil($totalItems / $limit);
$start = ($page-1) * $limit;

$sql="select photoes.id , photoes.title  ,photoes.address,albums.title 'album title' ,
                                                    photoes.created_at , photoes.updated_at 
    from photoes ,albums 
    where photoes.album_id = albums.id 
            and albums.id = '$album_id' ".$sub_sql." 
            order by photoes.updated_at desc    
            limit $start , $limit      ";

$data = executeResult($sql);

  



  $date = date('Y-m-d H:i:s');
  $title = getPost('title');
  $address=getPost('address');


  $file_name=[];

  if (isset($_FILES['photo_file']) ) {

        $names      = $_FILES['photo_file']['name'];
        $types      = $_FILES['photo_file']['type'];
        $tmp_names  = $_FILES['photo_file']['tmp_name'];
        $errors     = $_FILES['photo_file']['error'];
        $sizes      = $_FILES['photo_file']['size'];

        $maxfilesize  = 1048576*5;

        $maxfilesize_MB = $maxfilesize/1048576;

        $numitems = count($names);
        $numfiles = 0;
        for ($i = 0; $i < $numitems; $i ++) {
            //Kiểm tra file thứ $i trong mảng file, up thành công không
            if ($errors[$i] == 0)
            {
                $numfiles++;

                $allowtypes    = array('jpg', 'png', 'jpeg', 'gif','JPG', 'PNG', 'JPEG', 'GIF' );
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
  //đến đây là đã upfile và có list thông báo
  //tiếp theo là quản lí file đã up 


  $delID= getPost('delID');

  $editID = getGet('editID');
  if ($editID !=''){
        $edit_photo = executeResult("select * from photoes where id = $editID ",true);
        if ($edit_photo=='') {
          header("Location: adm_album_details.php?album_id=".$album_id);
          die();
        }
    }

if (!empty($_POST)) {

    //delete
    if ($delID!='') {
        execute("delete from photoes where id = '$delID' ");

         mess('<b>Photo ID='.$delID.'</b> đã bị xóa bởi admin '.$user['fullname'],'adm_photoes.php');
         die();
    }

    //add
    if ($title!='' && $editID =='' ) {
    	if ($address!='') {
        //dùng url
    		execute("insert into photoes(title ,address , album_id, created_at , updated_at)
                   values ('$title','$address' ,$album_id , '$date','$date')");

	         mess('<b>Photo '.$title.'</b> đã được thêm bởi admin '.$user['fullname'],'adm_photoes.php');

	        echo "<script>
	          alert('Bạn đã thêm ảnh thành công')
	          window.location.replace('adm_album_details.php?album_id=".$album_id."')
	        </script>";
	        
    	}
    	else{

    		foreach ($file_name as $address) {
    		
	    		execute("insert into photoes(title ,address , album_id, created_at , updated_at)
	                   values ('$title','$address' ,$album_id , '$date','$date')");

		         mess('<b>Photo '.$title.'</b> đã được thêm bởi admin '.$user['fullname'],'adm_photoes.php');
		        
	    	}

        $_SESSION['alert']=$alert;
	    	header("Location: adm_album_details.php?album_id=".$album_id);
        die();
    	}
        
    }
    //edit
    if ( $title!='' && $editID !=''){
      if ($address =='') {
        $address = $file_name[0];
      }
        execute("update photoes set title='$title' ,address='$address' , album_id='$album_id' ,
                      updated_at='$date' where id ='$editID' ");

        mess('<b>Photo '.$title.'(ID='.$editID.')</b> đã được update bởi admin '.$user['fullname'],'adm_photoes.php');

        header("Location: adm_album_details.php?album_id=".$album_id);
        die();
    }
  }

