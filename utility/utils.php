<?php

function getMd5($key){
	return $key=md5( md5($key).md5(KEY) );
}

function removeSpecialCharacter($str){
		$str = str_replace('\\', '\\\\', $str);
		$str = str_replace('\'', '\\\'', $str);

		return $str;
}

function getGET($key){
		$value='';

		if (isset($_GET[$key])) {
			$value = $_GET[$key];
		}
			
		return removeSpecialCharacter($value);
}

function getPOST($key){
		$value='';

		if (isset($_POST[$key])) {
			$value = $_POST[$key];
		}
		
		return removeSpecialCharacter($value);
}

function getCOOKIE($key){
		$value='';

		if (isset($_COOKIE[$key])) {
			$value = $_COOKIE[$key];
		}
}


//return user ='' hoặc user chuẩn
function checkLogin(){
	$user='';
	if (isset($_COOKIE['token'])) {
			$token = $_COOKIE['token'];

			$sql = "select * from users where token = '$token' ";
			$users = executeResult($sql);

			//nếu có kết quả trả về ,và chỉ 1
			if ($users !='' && count($users)==1 ) {
				$user = $users[0];
			}
	}
	return $user;
}

function mess($content,$href){
	$date = date('Y-m-d H:i:s');
	execute("insert into message(content ,href ,  created_at) values ('$content','$href' ,'$date') ");
}

function timeAgo($time_ago)
{
    $time_ago = strtotime($time_ago);
    $cur_time   = time();
    $time_elapsed   = $cur_time - $time_ago;
    $seconds    = $time_elapsed ;
    $minutes    = round($time_elapsed / 60 );
    $hours      = round($time_elapsed / 3600);
    $days       = round($time_elapsed / 86400 );
    $weeks      = round($time_elapsed / 604800);
    $months     = round($time_elapsed / 2600640 );
    $years      = round($time_elapsed / 31207680 );
    // Seconds
    if($seconds <= 60){
        return "just now";
    }
    //Minutes
    else if($minutes <=60){
        if($minutes==1){
            return "one minute ago";
        }
        else{
            return "$minutes minutes ago";
        }
    }
    //Hours
    else if($hours <=24){
        if($hours==1){
            return "an hour ago";
        }else{
            return "$hours hrs ago";
        }
    }
    //Days
    else if($days <= 7){
        if($days==1){
            return "yesterday";
        }else{
            return "$days days ago";
        }
    }
    //Weeks
    else if($weeks <= 4.3){
        if($weeks==1){
            return "a week ago";
        }else{
            return "$weeks weeks ago";
        }
    }
    //Months
    else if($months <=12){
        if($months==1){
            return "a month ago";
        }else{
            return "$months months ago";
        }
    }
    //Years
    else{
        if($years==1){
            return "one year ago";
        }else{
            return "$years years ago";
        }
    }
}

function showAlbum_slide($album_id){
    $data=executeResult("select * from photoes where album_id = '$album_id'");

    //mỗi lần show thì tăng 1 views cho albums
    $views=executeResult("select views from albums where id = '$album_id' ",true);
    $views = $views['views']+1;
    execute("update albums set views ='$views' where id='$album_id' ");

    if ($data!=null) {
        
        //mở slide
        echo '<span class="close_modal cursor" onclick="closeModal('.$album_id.')">&times;</span>';
        echo "<!-- slide start --> 
            <div id='carousel-custom' class='carousel slide' data-ride='carousel'>

            <div class='carousel-outer'>

                <!-- Wrapper for slides -->
                <div class='carousel-inner'>";

        //in ra list wrapper - ảnh phía trên
        echo "<div class='item active'>
                        <img src='".plus_path($data[0]['address'],'uploads/')."' alt='' />
                    </div>";

        if (count($data)>1) {
            for ($i=1; $i <count($data) ; $i++) { 
            
                echo "<div class='item'>
                        <img src='".plus_path($data[$i]['address'],'uploads/')."' alt='' />
                    </div>";
                
             }

        }

            echo "</div>
                    <!-- Wrapper for slides end -->
                        
                    <!-- Controls -->
                    <a class='left carousel-control' href='#carousel-custom' data-slide='prev'>
                        <span class='glyphicon glyphicon-chevron-left'></span>
                    </a>
                    <a class='right carousel-control' href='#carousel-custom' data-slide='next'>
                        <span class='glyphicon glyphicon-chevron-right'></span>
                    </a>

                </div>
                
                <!-- Indicators start -->
                <ol class='carousel-indicators mCustomScrollbar'>";

        //list các indicator - list ảnh phía dưới chân
        echo "<li id='indicator1' data-target='#carousel-custom' data-slide-to='0' class='active'>
                    <img src='".plus_path($data[0]['address'],'uploads/')."' alt='' />
                </li>";
        if (count($data)>1){

            for ($i=1; $i <count($data) ; $i++){
                echo "<li id='indicator".($i+1)."' data-target='#carousel-custom' data-slide-to='".$i."' >
                        <img src='".plus_path($data[$i]['address'],'uploads/')."' alt='' />
                    </li>";
            }
        }
        

        echo "</ol>
            <!-- Indicators end -->

        </div>
       <!-- slide end -->";


    }
};

function showAlbum_represent($album_id){
  //show ra 1-2-3 ảnh bìa làm đại diện
    $data=executeResult("select photoes.*,albums.title 'album title', albums.views from photoes join albums 
                                where photoes.album_id = albums.id and album_id = '$album_id'");
    $count = count($data);

    if ($count > 0) {
        echo '<div style="margin-bottom:2px;font-size:22px;font-weight:bold;">
                    Album: '.$data[0]['album title'].'
                    <i style="font-size:14px!important;">('.$count.' ảnh - <span id="views'.$album_id.'">'.$data[0]['views'].'</span> views)</i>
            </div>';
    }

    if ($count ==1) {
        echo '<div class="album_present" style="display: flex; width: 100% ;margin-top:20px; margin-bottom:30px;">

                <div class="colum" style="width:100%; " >
                  <img src="'.plus_path($data[0]['address'],'uploads/').'" onclick="OpenModal('.$album_id.');currentSlide(1)" style="width: 100%;">
                </div>

            </div>';
    }

    if ($count ==2) {
        echo '<div class="album_present" style="display: flex; width: 100% ; margin-bottom:20px;">

                <div class="colum" style="width:50%; margin-right: 5px;" >
                  <img src="'.plus_path($data[0]['address'],'uploads/').'" onclick="OpenModal('.$album_id.');currentSlide(1)"  style="width: 100%;">
                </div>

                <div class="colum" style="width:50%;margin-left: 5px;">

                    <img src="'.plus_path($data[1]['address'],'uploads/').'" style="width:100%;" onclick="OpenModal('.$album_id.');currentSlide(2)" >

                </div>
            </div>';
    }

    if ($count >=3) {
        echo '<div class="album_present" style="display: flex; width: 100% ; margin-bottom:20px;">

                <div class="colum" style="width:66%;margin-right: 5px;" >
                  <img src="'.plus_path($data[0]['address'],'uploads/').'" onclick="OpenModal('.$album_id.');currentSlide(1)"  style="width: 100%;height:300px!important; ">
                </div>

                <div class="colum" style="width:34%;margin-left: 10px;">

                    <img src="'.plus_path($data[1]['address'],'uploads/').'" style="width:100%;height:145px; margin-bottom: 5px;" onclick="OpenModal('.$album_id.');currentSlide(2)" >

                    <img src="'.plus_path($data[2]['address'],'uploads/').'" style="width:100%;height:145px; margin-top: 10px;" onclick="OpenModal('.$album_id.');currentSlide(3)" >

                </div>
            </div>';
    }
}


function look_for_subs($comment_id){

  $subs=executeResult("select * from sub_comments where father_id='$comment_id' order by id desc " );
  return $subs;
}

//page nào , load ra bao nhiêu , ngoại trừ cmt nào đã load riêng 
function load_comments($page_code, $limit , $exept_id ){
    $user = checkLogin();
    $check='';
    if ($user=='') {
        $check='hidden';
    }

    $comments = executeResult("select * from comments where page_code= '$page_code' and id !='$exept_id' order by created_at desc limit 0, $limit ");

   // include_once '../layout/comments_form.php';

    foreach ($comments as $comment) {
        $father_id=$comment['id'];

        load_only_comment($page_code,$comment['id']);
        
        }

}

//load riêng 1 cmt theo link thông báo 
function load_only_comment($page_code,$cmt_id){
  //dùng trong trường hợp nhấp link thông báo
   $user = checkLogin();
    $check='';
    if ($user=='') {
        $check='hidden';
    }

    $comment = executeResult("select * from comments where id = '$cmt_id'",true);

    $father_id=$cmt_id;

    if ($comment !='') {
     echo '<div >';
        //cmt cha:
        echo '<div class="comment" id="comment'.$comment['id'].'" style="margin-left: 12px;margin-right: 12px; display: flex;border-top: solid 1px #d6d6d6;">
                <div class="cmt_avatar" style="width: 60px;">
                  <img src="'.$comment['avatar'].'" style="width: 38px!important; height: 38px!important;border-radius: 50%;margin-top: 15px;">
                  
                </div>
                <div class="cmt_content" style="width:100%;">
                  <!--content-header start-->
                  <div style="font-weight: bold;font-size: 15px;color: #009EE5;margin-top: 15px;width: 100%;">
                    <div class="col-md-9" style="padding-left: 0px;">
                      '.$comment['guest_name'].'
                      <span style="color: #A3B0B9;font-weight: normal;font-size: 11px;">'.timeAgo($comment['created_at']).'</span>
                    </div>
                      
                    <div class="col-md-3" style="text-align: right;padding-right: 0px;">
                      <button onclick="del_comment('.$comment['id'].')" style="border: none;background: transparent;padding-right: 0px;text-align: right;" title="xóa bình luận" class="'.$check.'"><i class="fa fa-trash" aria-hidden="true" style="margin-right: 0px;"></i></button>
                    </div>
                  </div>
                  <!-- content header end -->
                  <div style="clear: both;" ></div>

                  <div style="margin-top:5px;">'.$comment['content'].'</div> 

                  <div style="margin-top: 10px;line-height: 19px;    font-size: 12px;color: #38aee3;">
                    <button style="border:none;background:transparent;">Thích</button>
                    <span style="padding:0 5px;margin-top: 5px!important;">.</span>
                    <button style="border:none;background:transparent;" name="rep" id="'.$comment['id'].'" onclick="rep('.$comment['id'].')" >Trả lời</button>
                    <span style="padding:0 5px;">.</span>
                    <button style="border:none;background:transparent;">Chia sẻ</button>
                  </div>                      
                </div>
              </div>';

    //list cmt con
          $subs = look_for_subs($comment['id']); //xếp theo thứ tự thời gian
          $total_sons = count($subs);

          echo '<div id="sub_comment_area_of_'.$comment['id'].'">';

          $i=1;
          foreach ($subs as $comment){
            if ($i<=3) {
              $i++;
              echo '<div class="sub_comment" id="sub_comment'.$comment['id'].'" style="margin-left: 72px;margin-right: 12px; display: flex;border-top: solid 1px #eee;">
                
                <div class="cmt_avatar" style="width: 60px;">
                  <img src="'.$comment['avatar'].'" style="width: 38px!important; height: 38px!important;border-radius: 50%;margin-top: 15px;">
                </div>

                <div class="cmt_content" style="width:100%;">
                  <!--content-header start-->
                  <div style="font-weight: bold;font-size: 15px;color: #009EE5;margin-top: 15px;width: 100%;">
                    <div class="col-md-9" style="padding-left: 0px;">
                      '.$comment['guest_name'].'
                      <span class="" style="color: #A3B0B9;font-weight: normal;font-size: 11px;">'.timeAgo($comment['created_at']).'</span>
                    </div>
                      
                    <div class="col-md-3" style="text-align: right;padding-right: 0px;">
                      <button onclick="del_sub_comment('.$comment['id'].')" style="border: none;background: transparent;padding-right: 0px;text-align: right;" title="xóa bình luận" class="'.$check.'"><i class="fa fa-trash" aria-hidden="true" style="margin-right: 0px;"></i></button>
                    </div>
                  </div>
                  <!-- content header end -->
                <div style="clear: both;" ></div>

                  <div style="margin-top:5px;">'.$comment['content'].'</div> 

                  <div style="margin-top: 10px;line-height: 19px;    font-size: 12px;color: #38aee3;">
                    <button style="border:none;background:transparent;">Thích</button>
                    <span style="padding:0 5px;margin-top: 5px!important;">.</span>

                    <button style="border:none;background:transparent;" name="rep" id="'.$father_id.'" onclick="rep('.$father_id.')">Trả lời</button>

                    <span style="padding:0 5px;">.</span>
                    <button style="border:none;background:transparent;">Chia sẻ</button>
                  </div>                         
                </div>
              </div>';
            }
              
          }

          echo '<input type="number" id="page_sub_cmt'.$father_id.'" value="1" style="display:none;">';
        //in ra chỗ để đổ form rep cmt
          echo '<span id="span_rep'.$father_id.'"></span>';

          if ( $total_sons >3 ) {
            //in ra nút xem thêm rep cmt
            echo '<button style="margin-left: 72px;margin-bottom:15px;margin-top:10px;" id="btn1" name="btn_loadmore"  onclick="loadmore_sub_cmt('.$father_id.',1)"><i class="fad fa-chevron-double-down"></i>Xem thêm page 2</button>';
          }

          echo '</div>';
          //end area sub cmt

        echo '</div>';
        //end area cmt
   
    }
    
}


function upload($FILE,$array_allowtypes){
  $alert=''; //cái này lưu lại báo cáo 

  //đường dẫn đến nơi lưu trữ
  $target_dir = '../uploads/';

  //Vị trí file lưu tạm trong server (file sẽ lưu trong uploads, với tên giống tên ban đầu)
    $file_name = basename($FILE["name"]);

  $target_file   = $target_dir . basename($FILE["name"]);

  $allowUpload   = true;

  //Lấy phần mở rộng của file (jpg, png, ...)
  $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

  // Cỡ lớn nhất được upload (bytes)
  $maxfilesize  = 1048576; //bytes
  $maxfilesize_MB = $maxfilesize/1048576; //MB


  if(isset($_POST["submit"])) {
      //Kiểm tra xem có phải là ảnh bằng hàm getimagesize
      $check = getimagesize($_FILES["fileupload"]["tmp_name"]);
      if($check !== false)
      {
          $allowUpload = true;
      }
      else
      {
         
          $allowUpload = false;
      }
  }

  // Kiểm tra nếu file đã tồn tại thì không cho phép ghi đè
  if (file_exists($target_file))
  {
      $alert= $alert.' Error: file <b>uploads/'.$file_name.'</b> đã tồn tại ,không được phép ghi đè ;<br>';   
      $allowUpload = false;
  }

  //Kiểm tra kích thước file upload cho vượt quá giới hạn cho phép
  if ($FILE["size"] > $maxfilesize)
  {     
      $alert= $alert.' Error: file <b>'.$file_name.'</b> vượt giới hạn cho phép . Hãy chọn file có dung lượng nhỏ hơn '.$maxfilesize_MB.'MB ;<br>';
      $allowUpload = false;
  }


  // Kiểm tra kiểu file
  if (!in_array($imageFileType,$array_allowtypes ))
  {
      $alert= $alert.' Error: file <b>'.$file_name.'</b> không thuộc kiểu file được cho phép upload ;<br>';
      $allowUpload = false;
  }

  if ($allowUpload)
  {
      // Xử lý di chuyển file tạm ra thư mục cần lưu trữ, dùng hàm move_uploaded_file
      move_uploaded_file($FILE["tmp_name"], $target_file) ;
  }

  return [$file_name ,$alert];

} ;


function plus_path($str,$plus){
    //kiểm tra xem chuỗi có dấu : hay không
    //nếu có -> là url -> thì để nguyên
    //nếu không có -> filename -> cộng thêm đường dẫn vào 
    // ví dụ $adress = plus_path('anh_01.jpg','../uploads/') -> $adress ='../upload/anh_01.jpg'
    // $adress = plus_path('https://sdfasdanh_01.jpg','../uploads/') 
    //                   ->$adress = https://sdfasdanh_01.jpg

    if (strpos($str, ':')=='') {
        $str=$plus.$str;
    }
    return $str;
}

function output_file($Source_File, $Download_Name, $mime_type='')
{
/*
$Source_File = path to a file to output
$Download_Name = filename that the browser will see
$mime_type = MIME type of the file (Optional)
*/
if(!is_readable($Source_File)) die('File not found or inaccessible!');
  
$size = filesize($Source_File);
$Download_Name = rawurldecode($Download_Name);
  
/* Figure out the MIME type (if not specified) */
$known_mime_types=array(
    "pdf" => "application/pdf",
    "csv" => "application/csv",
    "txt" => "text/plain",
    "html" => "text/html",
    "htm" => "text/html",
    "exe" => "application/octet-stream",
    "zip" => "application/zip",
    "doc" => "application/msword",
    "xls" => "application/vnd.ms-excel",
    "ppt" => "application/vnd.ms-powerpoint",
    "gif" => "image/gif",
    "png" => "image/png",
    "jpeg"=> "image/jpg",
    "jpg" =>  "image/jpg",
    "php" => "text/plain"
);
  
if($mime_type==''){
     $file_extension = strtolower(substr(strrchr($Source_File,"."),1));
     if(array_key_exists($file_extension, $known_mime_types)){
        $mime_type=$known_mime_types[$file_extension];
     } else {
        $mime_type="application/force-download";
     };
};
  
@ob_end_clean(); //off output buffering to decrease Server usage
  
// if IE, otherwise Content-Disposition ignored
if(ini_get('zlib.output_compression'))
  ini_set('zlib.output_compression', 'Off');
  
header('Content-Type: ' . $mime_type);
header('Content-Disposition: attachment; filename="'.$Download_Name.'"');
header("Content-Transfer-Encoding: binary");
header('Accept-Ranges: bytes');
  
header("Cache-control: private");
header('Pragma: private');
header("Expires: Thu, 26 Jul 2012 05:00:00 GMT");
  
// multipart-download and download resuming support
if(isset($_SERVER['HTTP_RANGE']))
{
    list($a, $range) = explode("=",$_SERVER['HTTP_RANGE'],2);
    list($range) = explode(",",$range,2);
    list($range, $range_end) = explode("-", $range);
    $range=intval($range);
    if(!$range_end) {
        $range_end=$size-1;
    } else {
        $range_end=intval($range_end);
    }
  
    $new_length = $range_end-$range+1;
    header("HTTP/1.1 206 Partial Content");
    header("Content-Length: $new_length");
    header("Content-Range: bytes $range-$range_end/$size");
} else {
    $new_length=$size;
    header("Content-Length: ".$size);
}
  
/* output the file itself */
$chunksize = 1*(1024*1024); //you may want to change this
$bytes_send = 0;
if ($Source_File = fopen($Source_File, 'r'))
{
    if(isset($_SERVER['HTTP_RANGE']))
    fseek($Source_File, $range);
  
    while(!feof($Source_File) &&
        (!connection_aborted()) &&
        ($bytes_send<$new_length)
          )
    {
        $buffer = fread($Source_File, $chunksize);
        print($buffer); //echo($buffer); // is also possible
        flush();
        $bytes_send += strlen($buffer);
    }
fclose($Source_File);
} else die('Error - can not open file.');
  
die();
}


