<?php
  require_once 'db/dbhelper.php';
  require_once 'utility/utils.php';

  $user = checkLogin();
      if ($user=='') {
        header('Location: index.php');
      }
$task = getGET('task');
switch ($task) {
    case '0':
        $orderIDList = executeResult("select * from orders where status = 0 order by created_at desc");
        break;

    case 1:
        $orderIDList = executeResult("select * from orders where status = 1 order by created_at desc");
        break;

    case 2:
        $orderIDList = executeResult("select * from orders where status = 2 order by created_at desc");
        break;

    case -1:
        $orderIDList = executeResult("select * from orders where status = -1 order by created_at desc");
        break;
    
    default:
        $orderIDList = executeResult("select * from orders where status = 0 order by created_at desc");
        break;
}



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

    <link href="assets/plugins/bootstrap/bootstrap.css" rel="stylesheet" />
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/plugins/pace/pace-theme-big-counter.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet" />
    <link href="assets/css/main-style.css" rel="stylesheet" />

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
            include_once 'layout/admin_navbar_top.php';
            include_once 'layout/admin_navbar_side.php';
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
                    </select>
                </div>
                </div>
                
                <?php
                    $count=1;
                    foreach ($orderIDList as $order) {

                        $sql = "select customers.fullname, customers.address, customers.phone ,
                                        games.title , orders_details.quantity , 
                                        orders_details.price ,orders.created_at,(orders_details.quantity*orders_details.price)'total'
                                from orders_details ,orders , customers , games
                                where orders_details.order_id = orders.id 
                                        and orders.cus_id = customers.id
                                        and games.id = orders_details.game_id
                                and orders.id =".$order['id'];
                        $orderDetails= executeResult($sql);
                        
                        $time =$orderDetails[0]['created_at'];

                        echo '<div class="row" style="border-bottom:1px dotted #bfbfbf;padding-top:20px;padding-bottom:20px;">';

                        echo '<div class="row" style="width:600px;margin-left:10px;">
                                    <div style="font-weight:bold;font-size:20px;font-style:italic;color:;">
                                        '.$count++.'.Đơn hàng số : '.$order['id'].'
                                        <i style="font-size:12px;font-weight:normal;">('.timeAgo($time).')</i>
                                    </div>                             
                              </div>';

                        echo '<table class="table table-bordered" style=";
                                                margin-bottom:5px;">
                                <thead style="background: #84B899;">
                                    <tr style="color:white">
                                        <td colspan="3"><i style="color:black">Customer Name</i> : '.$orderDetails[0]['fullname'].'</td>
                                        <td colspan="2"><i style="color:black">Phone number</i> : '.$orderDetails[0]['phone'].'</td>
                                    </tr>
                                    <tr style="color:white">
                                        <td colspan="3"><i style="color:black">Address</i> : '.$orderDetails[0]['address'].'</td>
                                        <td colspan="2"><i style="color:black">Orderd at</i> : '.$time.'</td>
                                    </tr>
                                </thead>
                            </table>';

                        echo '<table class="table table-bordered details" style="margin-bottom:5px;">
                                <thead style="background: #84B899;">
                                    <tr style="background: #84B899">
                                        <th>No</th>
                                        <th>Game title</th>
                                        <th>Quantity</th>
                                        <th>Price <small>(vnđ)</small></th>
                                        <th>Total <small>(vnđ)</small></th>
                                    </tr>
                                </thead>
                                <tbody style="background: #e2fded">';

                            $totalPrice=0;
                            $i=1;
                            foreach ($orderDetails as $detail) {

                                echo '<tr>
                                            <td>'.$i++.'</td>
                                            <td>'.$detail['title'].'</td>
                                            <td>'.$detail['quantity'].'</td>
                                            <td>'.number_format($detail['price']).'</td>
                                            <td>'.number_format($detail['total']).'</td>
                                        </tr>';
                                $totalPrice+=$detail['total'];
                            }

                            echo '  <tr>
                                        <th colspan="4" style="text-align:right">Total Price : </th>
                                        <th><i>'.number_format($totalPrice).'<small>     vnđ </small></i></th>
                                    </tr>
                                  </tbody>
                                </table>';

                             if ($task==0 || $task =='') {
                                 echo '<div class="row" style="width:600px;margin:0px auto;text-align:right;">
                                        <div >
                                            <input type="checkbox" class="largerCheckbox" onclick="change_status('.$order['id'].')" name="status" value="1">
                                            <label for="status" style="color:#3d4e7d;">Gủi hàng thành công</label><br>
                                        </div>

                                        <div>
                                            <input type="checkbox" class="largerCheckbox" onclick="cancell_order('.$order['id'].')" >
                                            <label for="del" style="color:#b5bcc7">Hủy đơn</label><br>
                                        </div>
                                    </div>';
                                 }
                                 if ($task==1) {
                                 echo '<div class="row" style="width:600px;margin:0px auto;text-align:right;">
                                        <div >
                                            <input type="checkbox" class="largerCheckbox" onclick="change_sucess('.$order['id'].')" name="status" value="1">
                                            <label for="status" style="color:#3d4e7d;">Đã thanh toán</label><br>
                                        </div>

                                        <div>
                                            <input type="checkbox" class="largerCheckbox" onclick="cancell_order('.$order['id'].')" >
                                            <label for="del" style="color:#b5bcc7">Chuyển hoàn </label><br>
                                        </div>
                                    </div>';
                                 }

                        echo '</div>';
                    }
                ?>

            </div>
        <!-- main content end-->
            

        </div>
        <!-- end page-wrapper -->

    </div>
    <!-- end wrapper -->
<script type="text/javascript">
    function change_status(id) {
        if (confirm('Are you sure to checked ?')) {
            $.post('adm_orders.php',{checkedID:id},function(data){

                window.location.reload()
            })
        }else{$(this).click(function(){
            return false
        })}
    }

    function change_sucess(id) {
        if (confirm('Are you sure to checked ?')) {
            $.post('adm_orders.php',{sucessID:id},function(data){

                window.location.reload()
            })
        }else{$(this).click(function(){
            return false
        })}
    }

    function cancell_order(id) {
        if (confirm('Are you sure to cancell this order ?')) {
            $.post('adm_orders.php',{cancellID:id},function(data){

                window.location.reload()
            })
        }else{$(this).click(function(){
            return false
        })}
    }

    $('#task').change(function(){

        var task = $('#task').val()
        window.location.replace('adm_orders.php?task='+task)
    })
</script>
</body>

</html>
