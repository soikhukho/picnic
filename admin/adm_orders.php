<?php
  require_once '../db/dbhelper.php';
  require_once '../utility/utils.php';

  $user = checkLogin();
      if ($user=='') {
        header('Location: index.php');
      }
$task = getGET('task');

$sql= "select orders.id,orders.status, customers.fullname,orders.created_at,sum(orders_details.quantity*orders_details.price)'total' from orders_details ,orders , customers , games where orders_details.order_id = orders.id and orders.cus_id = customers.id and games.id = orders_details.game_id ";

switch ($task) {
    case '0':
        $sql=$sql.'and status=0 GROUP by orders.id ORDER by orders.created_at DESC';
        break;

    case 1:
        $sql=$sql.'and status=1 GROUP by orders.id ORDER by orders.created_at DESC';
        break;

    case 2:
        $sql=$sql.'and status=2 GROUP by orders.id ORDER by orders.created_at DESC';
        break;

    case -1:
       $sql=$sql.'and status=-1 GROUP by orders.id ORDER by orders.created_at DESC';
        break;
    
    case 99:
        $sql= $sql.'GROUP by orders.id ORDER by orders.created_at DESC';
        break;

    default:
        $sql=$sql.'and status=0 GROUP by orders.id ORDER by orders.created_at DESC';
        break;
}
$ordersList=executeResult($sql);


$user_id=$user['id'];
$user_email=$user['email'];

$selected='adm_orders';

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

?>

<!DOCTYPE html>
<html>

<head>
    <title>admin orders</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <!-- include summernote css/js -->
    <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote.css" rel="stylesheet">
    <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote.js"></script>

    <link href="../assets/plugins/bootstrap/bootstrap.css" rel="stylesheet" />
    <link href="../assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link href="../assets/plugins/pace/pace-theme-big-counter.css" rel="stylesheet" />
    <link href="../assets/css/style.css" rel="stylesheet" />
    <link href="../assets/css/main-style.css" rel="stylesheet" />

    <style type="text/css">
        #showOrder table{
            width: 600px;
        }
        .info_customer{
            
        }
        .details{
            margin-top:5px;
        }
        input.largerCheckbox {
            width: 18px;
            height: 18px;
        }

    </style>

</head>

<body>
    <div id="wrapper">
        <!-- navbar  -->
        <?php 
            include_once '../layout/admin_navbar_top.php';
            include_once '../layout/admin_navbar_side.php';
        ?>
        <!-- end navbar  -->

        <!--  page-wrapper -->
        <div id="page-wrapper">

            <div class="row" >
                <!-- Page Header -->
                <div class="col-lg-12">
                    <h1 class="page-header">Admintration Orders</h1>
                </div>
                <!--End Page Header -->
            </div>
            

        <!-- main content start-->
            <div class="row" id="showOrder" style="margin-left: 50px;margin-right: 50px;">
                <div class="row">
                    <div class="form-group">
                    <label>Chọn tác vụ :</label>
                    <select id="task" class="form-control" style="height:30px;width: 200px;background: #ffcb6e;">
                        <option value="0" <?=($task==0)?'selected':''?> >Xem đơn hàng mới</option>
                        <option value="1" <?=($task==1)?'selected':''?> >Xem đơn đang gửi</option>
                        <option value="2" <?=($task==2)?'selected':''?> >Xem đơn đã thanh toán</option>
                        <option value="-1" <?=($task==-1)?'selected':''?> >Xem đơn đã hủy</option>
                        <option value="99" <?=($task==99)?'selected':''?> >Xem tất cả đơn hàng</option>
                    </select>
                    </div>
                </div>

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Order ID</th>
                            <th>Customer Name</th>
                            <th>Created At</th>
                            <th>Total Price</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                            $count=1;
                            foreach ($ordersList as $order) {

                                echo '
                                    <tr>
                                        <td>'.$count++.'</td>
                                        <td>'.$order['id'].'</td>
                                        <td>'.$order['fullname'].'</td>
                                        <td>'.$order['created_at'].'</td>
                                        <td>'.$order['total'].'</td>';

                                switch ($order['status']) {
                                    case '0':
                                        echo '<td> New </td>';
                                        break;

                                    case '1':
                                        echo '<td>Shipping</td>';
                                        break;

                                    case '2':
                                        echo '<td>Arrived</td>';
                                        break;

                                    case '-1':
                                        echo '<td>Returned</td>';
                                        break;

                                    default:
                                        # code...
                                        break;
                                }

                                    echo '      <td><a href="adm_orders_details.php?id='.$order['id'].'"><button class="btn btn-info">View details</button></a></td>
                                            </tr>';
                                        
                            }
                        ?>
                        
                    </tbody>
                </table>

            </div>
        <!-- main content end-->
            

        </div>
        <!-- end page-wrapper -->

    </div>
    <!-- end wrapper -->
<script type="text/javascript">

    $('#task').change(function(){

        var task = $('#task').val()
        window.location.replace('adm_orders.php?task='+task)
    })
</script>
</body>

</html>
