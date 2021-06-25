<?php

$index="games";

  $user = checkLogin();
  include_once 'login.php';

  $cate=getGET('cate');
  $search=getGet('search');

 if ($cate !='') {
    $sub_sql1=' and cate_id ='.$cate;
 }else{ 
        $sub_sql1='';
      }

if ($search !='') {
    $sub_sql2=" and (games.id like '%$search%' or games.title like '%$search%' ) ";
 }else{ 
        $sub_sql2='';
      }

  $totalItems = executeResult("select count(*) 'count' from games join category where 
                            games.cate_id = category.id  and games.status = '0' ".$sub_sql1.$sub_sql2,true);


  $totalItems = $totalItems['count'];

  $href='games.php?cate='.$cate.'&search='.$search.'&';

  $page = getGET('page');
  if($page==''){$page = 1;}

  $limit  =6;
  $totalPages = ceil($totalItems / $limit);
  $start = ($page-1) * $limit;

  $data = executeResult("select games.*,category.title 'cate title' from games join category where 
                            games.cate_id = category.id and games.status = '0' ".$sub_sql1.$sub_sql2." order by updated_at DESC limit $start , $limit ");