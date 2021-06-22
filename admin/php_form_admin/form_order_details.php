<?php

$user = checkLogin();
      if ($user=='') {
        header('Location: index.php');
        die();
      }

$id = getGET('id');
$active=$user['active'];
if ($active != 1) {
  echo '<script type="text/javascript">
          alert("Tài khoản của bạn chưa được kích hoạt")
          window.location.replace("admin.php")
        </script>';
}

if ($id=="") {
    echo '<script type="text/javascript">
        alert("Đơn hàng này không tồn tại hoặc đã bị xóa")
        window.location.replace("admin.php")
    </script>';
}

$order=executeResult("select status from orders where id = $id",true);
if ($order=="") {

    echo '<script type="text/javascript">
        alert("Đơn hàng này không tồn tại hoặc đã bị xóa")
        window.location.replace("admin.php")
    </script>';
}

$status=$order['status'];


$user_id=$user['id'];
$user_email=$user['email'];

$selected='adm_orders';


$sql = "select customers.fullname, customers.address, customers.phone ,
                                        games.title ,games.thumbnail, orders_details.quantity , 
                                        orders_details.price ,orders.created_at,(orders_details.quantity*orders_details.price)'total'
                                from orders_details ,orders , customers , games
                                where orders_details.order_id = orders.id 
                                        and orders.cus_id = customers.id
                                        and games.id = orders_details.game_id
                                and orders.id =".$id;
 $orderDetails= executeResult($sql);


$new_status=getPost('new_status');

if ($new_status !='') {
    execute("update orders set status = '$new_status' where id = $id");
    mess('<b>Đơn hàng số '.$id.'</b> được xác nhận <b>gửi thành công</b> bởi '.$user_email ,'adm_orders_details.php?id='.$id);
}