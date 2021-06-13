<?php
	require_once '../db/dbhelper.php';
  	require_once '../utility/utils.php';

  	$limit=3;
  	$page=getPost('page');
  	if ($page=='') {
  		$page=1;
  	}
  	$start=($page-1)*$limit;

  	$total=executeResult("select count(*) 'total' from places",true);
  	$total_page=ceil($total['total']/$limit);

	$place=executeResult("select * from places limit $start,$limit ");

	$i=$start+1;
	foreach ($place as $item) {
		echo '<div style="margin-top:10px;">
					<a href="places_detail.php?id='.$item['id'].'"><h2>'.$i++.'. '.$item['title'].'</h2>
	   				<div><img src="'.$item['thumbnail'].'"></div></a>
	   				<p>'.$item['description'].'</p>
	   				<a href="places_detail.php?id='.$item['id'].'">(Xem chi tiết)</a>
				</div>';
	}
	if ($page<$total_page) {
		echo '<center><button style="margin-bottom:15px;" id="btn'.$page.'" class="btn btn-info" onclick="loadmore('.$page.')"><i class="fad fa-chevron-double-down"></i>Xem thêm ...</button></center>';
	}