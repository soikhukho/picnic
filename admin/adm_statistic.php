<?php
  require_once '../db/dbhelper.php';
  require_once '../utility/utils.php';

$selected='adm_statistic';

$user = checkLogin();
if ($user=='') {
    header('Location: index.php');
    die();
}

$user_id=$user['id'];
$active=$user['active'];
if ($active != 1) {
  echo '<script type="text/javascript">
          alert("Tài khoản của bạn chưa được kích hoạt")
          window.location.replace("admin.php")
        </script>';
}


    
$current_month= date('m');


?>

<!DOCTYPE html>
<html>

<head>
    <title>admin</title>
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
    <!-- <link href="../assets/plugins/pace/pace-theme-big-counter.css" rel="stylesheet" /> -->
    <link href="../assets/css/style.css" rel="stylesheet" />
    <link href="../assets/css/main-style.css" rel="stylesheet" />

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.min.js"></script>
    <script type="text/javascript" src="../js/chart.js"></script>

    <style type="text/css">
        .chart-container {
            width: 100%;
            
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

            <div class="row">
                <!-- Page Header -->
                <div class="col-lg-12">
                    <h1 class="page-header">Admintration </h1>
                </div>
                <!--End Page Header -->
            </div>

            <!-- main content start-->
            <div class="row" style="margin-left: 50px;margin-right: 50px;">

                <div class="each-chart" id="status" style="padding-bottom: 30px; border-bottom: 1px solid grey; width: 80%">
                    <h2 style="margin-left: 50px;margin-bottom: 20px;">Doanh thu theo trạng thái đơn hàng </h2>

                     <!-- month and type start -->
                    <div class="row" style="margin-left: 50px;" >
                        <div class="col-md-3">
                            <select id="month" style="width: 100px;height: 30px;background: #04B173;color: white">
                            
                                <?php

                                    echo '<option value="'.$current_month.'" selected >Tháng '.$current_month.'</option>';
                                    for ($i=1; $i < $current_month ; $i++) { 
                                        echo '<option value="'.$i.'">Tháng '.$i.'</option>';
                                    }

                                ?>
                            </select>
                        </div>

                        <div class="col-md-8">
                            <input type="radio" checked="true" name="type_chart" value="bar" style = "height: 25px; width: 25px; margin-left: 10px;">Bar
                            <input type="radio" name="type_chart" value="pie" style = "height: 30px; width: 25px; margin-left: 25px;">pie
                            <input type="radio" name="type_chart" value="horizontalBar" style = "height: 25px; width: 25px; margin-left: 10px;">horizontalBar
                            <!-- <input type="radio" name="type_chart" value="line" style = "height: 25px; width: 25px; margin-left: 10px;">line -->
                            <!-- <input type="radio" name="type_chart" value="doughnut" style = "height: 25px; width: 25px; margin-left: 10px;">doughnut -->
                        </div>

                    </div>
                    <!-- month and type end -->

                    <!-- chart start -->
                    <div class ="chart-container">

                        <canvas id="revenue_moth"></canvas>
                    </div>
                    <!-- chart end -->

                </div>

                

                <div class="each-chart" style="margin-bottom: 50px; border-bottom: 1px solid grey;" >
                    <div class="row">
                        <div class="col-md-3" style="padding-left: 50px;">
                            <h2 style="margin-top: 50px;">Doanh thu theo game</h2>
                            <span>(New + Shipping + Delivered)</span>
                            <!-- row selct month start -->
                            <div class="row" style="margin-top: 30px;">

                                Từ :
                                <select class="month_start_end" id="month_start" style="width: 100px;height: 30px;background: #04B173;color: white">
                                
                                    <?php

                                        for ($i=1; $i < $current_month ; $i++) { 
                                            echo '<option value="'.$i.'">Tháng '.$i.'</option>';
                                        }
                                        echo '<option value="'.$current_month.'" selected >Tháng '.$current_month.'</option>';

                                    ?>
                                </select>
                            </div>  

                            <div class="row" style="margin-top: 20px;">
                                Đến :
                                <select class="month_start_end" id="month_end" style="width: 100px;height: 30px;background: #04B173;color: white">
                                
                                    <?php

                                        for ($i=1; $i < $current_month ; $i++) { 
                                            echo '<option value="'.$i.'">Tháng '.$i.'</option>';
                                        }
                                        echo '<option value="'.$current_month.'" selected >Tháng '.$current_month.'</option>';

                                    ?>
                                </select>
                            </div>

                            <!-- row select end -->
                            
                             <div class="row" style="margin-top: 30px;">
                                <input type="radio"  name="type_chart_game" value="bar" style = "height: 25px; width: 25px;">Bar
                            </div>
                            <div class="row">
                                <input type="radio" checked="true" name="type_chart_game" value="pie" style = "height: 30px; width: 25px;">pie
                            </div>
                            <div class="row">
                                <input type="radio" name="type_chart_game" value="horizontalBar" style = "height: 25px; width: 25px; ">horizontalBar
                            </div>
                                <!-- <input type="radio" name="type_chart" value="line" style = "height: 25px; width: 25px; margin-left: 10px;">line -->
                                <!-- <input type="radio" name="type_chart" value="doughnut" style = "height: 25px; width: 25px; margin-left: 10px;">doughnut -->

                        </div>

                        <div class="col-md-9">
                            <!-- chart start -->
                            <div class="chart-container">
                                <canvas id="revenue_game" style="max-height: 500px;width: 90%" ></canvas>
                            </div>
                            <!-- chart end -->
                        </div>
                    </div>

                </div>


                <div class="each-chart" style="margin-bottom: 50px; border-bottom: 1px solid grey;width: 80%">
                    <h2 style="margin-left: 50px;margin-bottom: 20px;">Doanh thu (đã nhận) theo từng tháng </h2>

                    <!-- chart start -->
                    <div class="chart-container">
                        <canvas id="revenue_all" style="max-height: 500px;"></canvas>
                    </div>
                    <!-- chart end -->

                </div>


            </div>
            <!-- main content end-->

        </div>
        <!-- end page-wrapper -->

    </div>
    <!-- end wrapper -->
<script>
                    $(document).ready(function () {

                        var month = $('#month').val()
                        var month_start = $('#month_start').val()
                        var month_end = $('#month_end').val()

                        push_chart_revenue_status('bar',month,'revenue_moth');

                        push_chart_revenue_received('line','revenue_all')

                        push_chart_revenue_game('pie' ,month_start,month_end, 'revenue_game')
                    });
                    

                    $('[name=type_chart]').change(function(){
                        var month = $('#month').val()
                        var type_chart = $(this).val();

                        push_chart_revenue_status(type_chart,month,'revenue_moth')

                    })

                    $('#month').change(function(){
                        var month = $('#month').val()
                        var type_chart = $('[name=type_chart]').val();

                        push_chart_revenue_status(type_chart,month,'revenue_moth')

                    })

                    $('.month_start_end').change(function(){
                        var type_chart_game=$('[name=type_chart_game]').val()
                        var month_start = $('#month_start').val()
                        var month_end = $('#month_end').val()

                        push_chart_revenue_game(type_chart_game,month_start,month_end, 'revenue_game')
                    })

                    $('[name=type_chart_game]').change(function(){
                        var type_chart_game=$(this).val()
                        var month_start = $('#month_start').val()
                        var month_end = $('#month_end').val()

                        push_chart_revenue_game(type_chart_game ,month_start,month_end, 'revenue_game')
                    })
               
                

                
              </script>
</body>

</html>
