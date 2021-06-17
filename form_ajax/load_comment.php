<?php
include_once '../db/dbhelper.php';
include_once '../utility/utils.php';
include_once '../utility/utils_file.php';

$page_code = getPost('page_code');

$father_id = getPost('father_id');
$content = getPost('content');
$table = getPost('table');
$guest_name=getPost('guest_name');
$date = date('Y-m-d H:i:s');
$avatar=getPost('avatar');

$del_comment_id=getPost('del_comment_id');
$del_sub_comment_id=getPost('del_sub_comment_id');

if (!empty($_POST)) {

  if ($table=='comments' && $content!='' &&$guest_name !='') {
    execute("insert into comments(page_code,content,created_at ,guest_name,avatar)
               values('$page_code','$content','$date','$guest_name','$avatar')" );

    //lấy ra id vừa tạo 
    $result=executeResult("select id 'id' from comments where page_code= '$page_code' and created_at='$date' and content='$content' ",true);
    $cmt_id=$result['id'];

    mess($guest_name.' đã bình luận về bài viết '.$page_code,'../'.$page_code.'&cmt='.$cmt_id);

  }

  if ($table =='sub_comments' && $content!= '' &&$guest_name !='') {
    execute("insert into sub_comments(content,father_id , created_at , guest_name,avatar)
               values('$content','$father_id' , '$date' , '$guest_name','$avatar')" );

    mess($guest_name.' đã trả lời một bình luận trong bài viết '.$page_code,'../'.$page_code.'&cmt='.$father_id);

  }

  if ($del_comment_id!='') {
    //xóa cmt con
    execute("delete from sub_comments where father_id = '$del_comment_id' ");

    //xóa cmt gốc
  	execute("delete from comments where id = '$del_comment_id'");
  }

  if ($del_sub_comment_id!='') {
  	execute("delete from sub_comments where id = '$del_sub_comment_id'");
  }

}

load_comments($page_code);




