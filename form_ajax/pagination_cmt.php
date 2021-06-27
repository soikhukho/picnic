<?php

//lúc đầu : document ready thì $post : page = 1 và page_code
//khai báo function loadmore cmt

	//load lúc đầu tiên
  // $(document).ready(function(){
  //   var page_code=$('[name=page_code]').val();

  //   $.post('form_ajax/pagination_cmt.php',{page:1,page_code:page_code},function(data){
  //       $('#list_comment').html(data);
  //   })
  // })

  // //function loadmore cmt
  // function loadmore_cmt(page){
  //   //ẩn nút cũ:
  //   $('#btn'+page).empty()

  //   var page_code=$('[name=page_code]').val();

  //   $.post('form_ajax/pagination_cmt.php',{page:page*1+1,page_code:page_code},function(data){
  //       $('#list_comment').append(data);
  //   })
  // }

	require_once '../db/dbhelper.php';
  	require_once '../utility/utils.php';

  	$limit_each=3;
  	$page_code=getPost('page_code');
  	$rep_comment_id= getPost('rep_comment_id');

  	$page=getPost('page');
  	if ($page=='') {
  		$page=1;
  	}

  	$limit=$page*$limit_each;

  	$total=executeResult("select count(*) 'total' from comments where page_code= '$page_code' and id !='$rep_comment_id' ",true);
  	$total_page=ceil($total['total']/$limit_each);

 
  	//load cmt đang cần trả lời theo link thông báo nếu có:
  	if ($rep_comment_id!='') {
  		load_only_comment($page_code,$rep_comment_id);
  	}
	
  	//load nốt phàn cmt còn lại
  	load_comments($page_code,$limit,$rep_comment_id); 

  	echo '<input type="number" name="cmt_page" value="'.$page.'" style="display: none;">';
  	
	if ($page<$total_page) {
		echo '<center><button style="margin-bottom:15px;" id="btn'.$page.'" name="btn_loadmore"  title="'.$page.'" class="btn btn-info" onclick="loadmore_cmt('.($page).')"><i class="fad fa-chevron-double-down"></i>Xem thêm cmt...</button></center>';
	}
