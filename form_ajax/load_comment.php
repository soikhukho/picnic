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

if (!empty($_POST)) {

  if ($table=='comments' && $content!='' &&$guest_name !='') {
    execute("insert into comments(page_code,content,created_at ,guest_name,avatar)
               values('$page_code','$content','$date','$guest_name','$avatar')" );

    //lấy ra id vừa tạo 
    $result=executeResult("select id 'id' from comments where page_code= '$page_code' and created_at='$date' and content='$content' ",true);
    $cmt_id=$result['id'];

    mess($guest_name.' đã bình luận về bài viết '.$page_code,'../'.$page_code.'&cmt='.$cmt_id);

  }


  if ($del_comment_id!='') {
    //xóa cmt con
    execute("delete from sub_comments where father_id = '$del_comment_id' ");

    //xóa cmt gốc
  	execute("delete from comments where id = '$del_comment_id'");
  }



}

$rep_cmt_id= getPost('rep_cmt_id');
$limit_each=3;
$cmt_page= getPost('cmt_page');
if ($cmt_page == '') {
  $cmt_page=1;
}

$limit= $cmt_page * $limit_each;

$total=executeResult("select count(*) 'total' from comments where page_code= '$page_code' and id !='$rep_cmt_id' ",true);
$total_page=ceil($total['total']/$limit_each);

//load cmt đang cần trả lời theo link thông báo nếu có:
    if ($rep_cmt_id!='') {
      load_only_comment($page_code,$rep_cmt_id);
    }

//load phần còn lại
load_comments($page_code,$limit,$rep_cmt_id);

echo '<input type="number" name="cmt_page" value="'.$cmt_page.'" style="display:none;">';

if ($total_page >1) {
    echo '<div style="margin-bottom:15px;margin-top:15px;">
            <center style="border-top:1px solid #d6d6d6;;" >
              <button style="margin-top:15px;" id="btn'.$cmt_page.'" class="btn btn-info" onclick="loadmore_cmt('.$cmt_page.')"><i class="fad fa-chevron-double-down"></i>Xem thêm cmt...</button>
            </center>
          </div>';

  }




