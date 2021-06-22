<?php
  require_once '../../db/dbhelper.php';
  require_once '../../utility/utils.php';

  $user = checkLogin();
      if ($user=='') {
        header('Location: index.php');
        die();
      }
    $user_id=$user['id'];

    $month=getPost("month");

    $sql= "select orders.status 'label',
                          SUM(orders_details.quantity*orders_details.price) 'value' 
                          from orders_details , orders where  orders_details.order_id = orders.id 
                          and orders.created_at between '2021-".$month."-00' and '2021-".$month."-31'
                          group by orders.status ";

	$data = executeResult($sql);

	for ($i=0; $i <count($data) ; $i++) { 
		if ($data[$i]['label'] =='0') {
			# code...
			$data[$i]['label']='Đơn mới nhận';
		}
		if ($data[$i]['label'] =='1') {
			# code...
			$data[$i]['label']='Đơn đang vận chuyển';
		}
		if ($data[$i]['label'] =='2') {
			# code...
			$data[$i]['label']='Đơn phát thành công';
		}
		if ($data[$i]['label'] =='-1') {
			# code...
			$data[$i]['label']='Đơn bị hủy';
		}
	}

	echo json_encode($data);


?>