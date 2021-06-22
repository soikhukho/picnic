<?php
  require_once '../../db/dbhelper.php';
  require_once '../../utility/utils.php';

  $user = checkLogin();
      if ($user=='') {
        header('Location: index.php');
        die();
      }
    $user_id=$user['id'];

    $current_month = date('m');

    $data=[];

    for ($i=1; $i <= $current_month ; $i++) { 
    	
    	$sql= "select SUM(orders_details.quantity*orders_details.price) 'sum' 
                  from orders_details , orders where  orders_details.order_id = orders.id 
                  and orders.created_at between '2021-".$i."-00' and '2021-".$i."-31'
                  and orders.status = '2' ";

        $result = executeResult($sql , true);

        $value=$result['sum'];


        $label='Thang '.$i ;

        $data[]=[
        			'label'=>$label,
        			'value'=>$value
        		];
   
    }


	echo json_encode($data);


?>