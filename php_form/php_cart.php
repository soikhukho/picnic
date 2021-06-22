<?php

$index='';

  $user = checkLogin();
  include_once 'login.php';

  //lấy dữ liệu $cart
  if (isset($_COOKIE['cart_picnic'])) {
    $cart = json_decode($_COOKIE['cart_picnic'],true);
  } else{
    $cart = [];
  }

  $date= date('Y-m-d H:i:s');
  $customer_name = getPost('customer_name');
  $address = getPost('address');
  $phone_no = getPost('phone_no');

  if (!empty($_POST) &&count($cart)!=0) {
    
    //check customer by phone_no
    $list_id = executeResult("select * from customers where phone = '$phone_no' ");
    $count=count($list_id);

    if ($count==0) {
        //create new customer
        $sql=" insert into customers(fullname , phone , address , created_at) values 
                    ('$customer_name','$phone_no','$address','$date')";
                    
        execute($sql);

        $result = executeResult("select * from customers where phone = '$phone_no' ");
        $cus_id=$result[0]['id'];

    }else{

        $id=$list_id[0];
        $cus_id=$id['id'];
    }

    // have cus_id , then create an order ,then take id of that order
    $sql = "insert into orders (cus_id , created_at) values ('$cus_id' , '$date')";
    execute($sql);

    $order=executeResult("select * from orders where created_at = '$date' and cus_id ='$cus_id' ",true);

    $order_id = $order['id'];

    //create a mess
    mess('<b>Bạn có 1 đơn hàng mới ,đơn hàng số '.$order_id.'</b>','adm_orders_details.php?id='.$order_id);

    //then create order details
    $cart = json_decode($_COOKIE['cart_picnic'],true);
    foreach ($cart as $detail) {

        $game_id = $detail['game_id'];

        $game=executeResult("select * from games where id = '$game_id' " , true);
        $price = $game['price'];

        $quantity = $detail['quantity'];

        $sql="insert into orders_details(order_id,created_at , game_id , quantity ,price) 
              values ('$order_id','$date','$game_id','$quantity' , '$price')";
        execute($sql);

      //then delete cart
      setcookie('cart_picnic','',-1,'/');

      //
      header('Location: complete.php');
    }

  }