<?php
  require_once '../../db/dbhelper.php';
  require_once '../../utility/utils.php';

  $user = checkLogin();
      if ($user=='') {
        header('Location: index.php');
        die();
      }
    $user_id=$user['id'];

    $month_start=getPost("month_start");
    $month_end=getPost("month_end");

	$data = executeResult("select SUM(orders_details.quantity*orders_details.price) 'value' , games.title 'label' 
                        from orders_details , orders , games
                        where orders_details.order_id = orders.id and orders_details.game_id = games.id
                        and orders.status in (0,1,2)
                        and orders.created_at BETWEEN '2021-".$month_start."-01' and '2021-".$month_end."-31'
                        group by games.title ");

	echo json_encode($data);


?>