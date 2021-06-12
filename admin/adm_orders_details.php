<?php
  require_once '../db/dbhelper.php';
  require_once '../utility/utils.php';

  require_once 'php_form_admin/form_order_details.php';

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

         .largerCheckbox {
            width: 18px !important;
            height: 18px !important;
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
                
                <?php
                        
                        $time =$orderDetails[0]['created_at'];

                        echo '<div class="row" style="padding-top:20px;padding-bottom:20px;">';

                        // h1
                        echo '<div class="row" style="width:650px;margin-left:10px;">
                                    <div style="font-weight:bold;font-size:20px;font-style:italic;color:;">
                                        Đơn hàng số : '.$id.'
                                        <i style="font-size:12px;font-weight:normal;">('.timeAgo($time).')</i>
                                    </div>                             
                              </div>';

                        //current status

                        //table customer info
                        echo '<table class="table table-bordered" style=";
                                                margin-bottom:5px;margin-top:20px;">
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

                        //table details
                        echo '<table class="table table-bordered details" style="margin-bottom:5px;">
                                <thead style="background: #84B899;">
                                    <tr style="background: #84B899">
                                        <th>No</th>
                                        <th>Game title</th>
                                        <th>Thumbnail</th>
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
                                            <td><img src="'.$detail['thumbnail'].'" style="max-width: 80px;"></td>
                                            <td>'.$detail['quantity'].'</td>
                                            <td>'.number_format($detail['price']).'</td>
                                            <td>'.number_format($detail['total']).'</td>
                                        </tr>';
                                $totalPrice+=$detail['total'];
                            }

                            echo '  <tr>
                                        <th colspan="5" style="text-align:right">Total Price : </th>
                                        <th><i>'.number_format($totalPrice).'<small>     vnđ </small></i></th>
                                    </tr>
                                  </tbody>
                                </table>';

                            echo '</div>';
                    ?>
                            
                    <div id="<?=$id ?>" class="row" style="width: 650px;">

                        <div class="col-sm-3">
                            <input  type="checkbox" <?= ($status==0)?'checked="true"':'' ?> class="largerCheckbox" name="status" value="0" >
                            <label for="status" style="<?= ($status==0)?'color:#3d4e7d;':'color:#b5bcc7;' ?>" >New !</label><br>
                        </div>

                        <div class="col-sm-3">
                            <input  type="checkbox" <?= ($status==1)?'checked="true"':'' ?> class="largerCheckbox" name="status" value="1">
                            <label for="status" style="<?= ($status==1)?'color:#3d4e7d;':'color:#b5bcc7;' ?>" >Shipping</label><br>
                        </div>

                        <div class="col-sm-3">
                            <input  type="checkbox" <?= ($status==2)?'checked="true"':'' ?> class="largerCheckbox" name="status" value="2">
                            <label for="status" style="<?= ($status==2)?'color:#3d4e7d;':'color:#b5bcc7;' ?>" >Delivered</label><br>
                        </div>

                        <div class="col-sm-3">
                            <input type="checkbox" <?= ($status==-1)?'checked="true"':'' ?> name="status" class="largerCheckbox" value="-1" >
                                <label for="del" style="<?= ($status==-1)?'color:#3d4e7d;':'color:#b5bcc7;' ?>" >Returned !!</label><br>
                        </div>

                    </div>
                    
                     <div style="margin-top: 30px;">
                        <a href="adm_orders.php"><button class="btn btn-warning">Xem đơn hàng khác</button></a>
                    </div>  

            </div>
        <!-- main content end-->
            

        </div>
        <!-- end page-wrapper -->

    </div>
    <!-- end wrapper -->

<script type="text/javascript">

    $('[name=status]').click(function(){
        if ($(this).attr('checked')=='checked' ){
            return false;
        }else{

            var new_status = $(this).val()
            var id= $(this).parent().parent().attr('id')
            
            $.post('adm_orders_details.php?id='+id,{new_status:new_status},function(data){

                window.location.reload()
            })
        }
        
    })

</script>

</body>

</html>
