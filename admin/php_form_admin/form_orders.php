<?php
$selected='adm_orders';

$user = checkLogin();
      if ($user=='') {
        header('Location: index.php');
        die();
      }
$active=$user['active'];
if ($active != 1) {
  echo '<script type="text/javascript">
          alert("Tài khoản của bạn chưa được kích hoạt")
          window.location.replace("admin.php")
        </script>';
}

$task = getGET('task');

$sql= "select orders.id,orders.status, customers.fullname,orders.created_at,sum(orders_details.quantity*orders_details.price)'total' from orders_details ,orders , customers , games where orders_details.order_id = orders.id and orders.cus_id = customers.id and games.id = orders_details.game_id ";

$search=getGET('search');
  if ($search !='') {
    $sub_sql = " and ( orders.id like '%$search%' or customers.fullname like '%$search%' ) ";
  }else {$sub_sql='';}

$sql=$sql.$sub_sql;

switch ($task) {
    case '0':
        $sql=$sql.'and orders.status=0 GROUP by orders.id ORDER by orders.created_at DESC';
        break;

    case 1:
        $sql=$sql.'and orders.status=1 GROUP by orders.id ORDER by orders.created_at DESC';
        break;

    case 2:
        $sql=$sql.'and orders.status=2 GROUP by orders.id ORDER by orders.created_at DESC';
        break;

    case -1:
       $sql=$sql.'and orders.status=-1 GROUP by orders.id ORDER by orders.created_at DESC';
        break;
    
    case 99:
        $sql= $sql.'GROUP by orders.id ORDER by orders.created_at DESC';
        break;

    default:
        $sql=$sql.'and orders.status=0 GROUP by orders.id ORDER by orders.created_at DESC';
        break;
}
$ordersList=executeResult($sql);

//pagination start


$totalItems = count($ordersList);

$href='adm_orders.php?task='.$task.'&search='.$search.'&';

$page = getGET('page');
if($page==''){$page = 1;}

$limit  =10;
$totalPages = ceil($totalItems / $limit);
$start = ($page-1) * $limit;

$sql=$sql.' limit ' .$start.','.$limit;
$data = executeResult($sql);
//pagination end


$user_id=$user['id'];
$user_email=$user['email'];



$checkedID=getPost('checkedID');
$cancellID=getPost('cancellID');
$sucessID=getPost('sucessID');

if ($checkedID != '') {
    execute("update orders set status = 1 where id = $checkedID");
    mess('<b>Đơn hàng số '.$checkedID.'</b> được xác nhận <b>gửi thành công</b> bởi '.$user_email ,'adm_orders.php');
}
if ($cancellID!='') {
    execute("update orders set status = -1 where id = $cancellID");
    mess('<b>Đơn hàng số '.$cancellID.'</b> xác nhận <b>đã hủy</b> bởi '.$user_email ,'adm_orders.php');
}

if ($sucessID != '') {
    execute("update orders set status = 2 where id = $sucessID");
    mess('<b>Đơn hàng số '.$sucessID.'</b> được xác nhận <b>đã thanh toán</b> bởi '.$user_email ,'adm_orders.php');
}