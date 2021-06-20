<?php
  require_once '../../db/dbhelper.php';
  require_once '../../utility/utils.php';

  $user = checkLogin();
      if ($user=='') {
        header('Location: index.php');
      }
    $user_id=$user['id'];

    $month=getPost("month");

	$data = executeResult("select orders.status 'label',
                          SUM(orders_details.quantity*orders_details.price) 'value' 
                          from orders_details left join orders on orders_details.order_id = orders.id 
                          and orders.created_at between '2021-".$month."-00' and '2021-".$month."-31' group by orders.status ");

	echo json_encode($data);


?>