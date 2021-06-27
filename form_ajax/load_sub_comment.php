<?php
include_once '../db/dbhelper.php';
include_once '../utility/utils.php';
include_once '../utility/utils_file.php';

$user = checkLogin();
$check='';
if ($user=='') {
    $check='hidden';
}

$page_code = getPost('page_code');

$father_id = getPost('father_id');

$page_sub_cmt = getPost('page_sub_cmt');
if ($page_sub_cmt =='') {
	$page_sub_cmt =1;
}

$limit = $page_sub_cmt*3;

$content = getPost('content');
$table = getPost('table');
$guest_name=getPost('guest_name');
$date = date('Y-m-d H:i:s');
$avatar=getPost('avatar');


$del_sub_comment_id=getPost('del_sub_comment_id');

if (!empty($_POST)) {

	if ($table =='sub_comments' && $content!= '' &&$guest_name !='') {
	    execute("insert into sub_comments(content,father_id , created_at , guest_name,avatar)
	               values('$content','$father_id' , '$date' , '$guest_name','$avatar')" );

	    mess($guest_name.' đã trả lời một bình luận trong bài viết '.$page_code,'../'.$page_code.'&cmt='.$father_id);

  	}

  	if ($del_sub_comment_id!='') {
	  	execute("delete from sub_comments where id = '$del_sub_comment_id'");
	  }


}


$subs = look_for_subs($father_id);
$total_subs = count($subs);

$i=1;
foreach ($subs as $comment){
	if ($i<=$limit) {
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
	

	//in ra chỗ để đổ form rep cmt
	echo '<span id="span_rep'.$father_id.'"></span>';

	echo '<input type="number" id="page_sub_cmt'.$father_id.'" value="'.$page_sub_cmt.'" style="display:none;">';
	if ( $total_subs >$limit ) {
            //in ra nút xem thêm rep cmt
            echo '<button style="margin-left: 72px;margin-bottom:15px;margin-top:10px;" id="btn1" name="btn_loadmore"  onclick="loadmore_sub_cmt('.$father_id.','.$page_sub_cmt.')"><i class="fad fa-chevron-double-down"></i>Xem thêm page '.($page_sub_cmt+1).'</button>';



         }
			 