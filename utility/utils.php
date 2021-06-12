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
    if ($data!=null) {
        
        //mở slide
        echo '<span class="close_modal cursor" onclick="closeModal()">&times;</span>';
        echo "<!-- slide start --> 
            <div id='carousel-custom' class='carousel slide' data-ride='carousel'>

            <div class='carousel-outer'>

                <!-- Wrapper for slides -->
                <div class='carousel-inner'>";

        //in ra list wrapper
        echo "<div class='item active'>
                        <img src='".$data[0]['address']."' alt='' />
                    </div>";

        if (count($data)>1) {
            for ($i=1; $i <count($data) ; $i++) { 
            
                echo "<div class='item'>
                        <img src='".$data[$i]['address']."' alt='' />
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

        //list các indicator
        echo "<li id='indicator1' data-target='#carousel-custom' data-slide-to='0' class='active'>
                    <img src='".$data[0]['address']."' alt='' />
                </li>";
        if (count($data)>1){

            for ($i=1; $i <count($data) ; $i++){
                echo "<li id='indicator".($i+1)."' data-target='#carousel-custom' data-slide-to='".$i."' >
                        <img src='".$data[$i]['address']."' alt='' />
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
    $data=executeResult("select photoes.*,albums.title 'album title' from photoes join albums 
                                where photoes.album_id = albums.id and album_id = '$album_id'");
    $count = count($data);

    if ($count > 0) {
        echo '<div style="margin-bottom:2px;font-size:22px;font-weight:bold;">
                    Album: '.$data[0]['album title'].'
                    <i style="font-size:14px!important;">('.$count.' ảnh)</i>
            </div>';
    }

    if ($count ==1) {
        echo '<div class="album_present" style="display: flex; width: 100% ;margin-top:20px; margin-bottom:30px;">

                <div class="colum" style="width:100%; " >
                  <img src="'.$data[0]['address'].'" onclick="OpenModal('.$album_id.');currentSlide(1)" style="width: 100%;">
                </div>

            </div>';
    }

    if ($count ==2) {
        echo '<div class="album_present" style="display: flex; width: 100% ; margin-bottom:20px;">

                <div class="colum" style="width:50%; margin-right: 5px;" >
                  <img src="'.$data[0]['address'].'" onclick="OpenModal('.$album_id.');currentSlide(1)"  style="width: 100%;">
                </div>

                <div class="colum" style="width:50%;margin-left: 5px;">

                    <img src="'.$data[1]['address'].'" style="width:100%;" onclick="OpenModal('.$album_id.');currentSlide(2)" >

                </div>
            </div>';
    }

    if ($count >=3) {
        echo '<div class="album_present" style="display: flex; width: 100% ; margin-bottom:20px;">

                <div class="colum" style="width:66%; margin-right: 5px;" >
                  <img src="'.$data[0]['address'].'" onclick="OpenModal('.$album_id.');currentSlide(1)"  style="width: 100%;">
                </div>

                <div class="colum" style="width:34%;margin-left: 10px;">

                    <img src="'.$data[1]['address'].'" style="width:100%;margin-bottom: 5px;" onclick="OpenModal('.$album_id.');currentSlide(2)" >

                    <img src="'.$data[2]['address'].'" style="width:100%;margin-top: 10px;" onclick="OpenModal('.$album_id.');currentSlide(3)" >

                </div>
            </div>';
    }
}