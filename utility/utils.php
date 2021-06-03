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