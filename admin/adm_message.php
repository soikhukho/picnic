<?php
  require_once '../db/dbhelper.php';
  require_once '../utility/utils.php';

  require_once 'php_form_admin/form_mess.php';
?>
?>

<!DOCTYPE html>
<html>

<head>
    <title>Message</title>
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
        table td,th{
            height: 50px;
        }
        table a{
            color: black;
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
                    <h1 class="page-header">Your Message </h1>
                </div>
                <!--End Page Header -->
            </div>

            <div class="row" style="margin-left: 50px;margin-right: 50px;">

                <div >
                    <!-- search form start -->
                      <form method="get">
                        <div class="input-group custom-search-form" style="margin-bottom: 8px;width: 300px;">
                            <input type="text" class="form-control" name="search" placeholder="Search content..." value="<?= $search ?>">
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="submit">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                        </div>
                      </form>
                      <!-- search form end -->
                </div>

                <!-- <div><?= $sql ?></div> -->
                <table class="table  table-bordered" style="font-size: 15px;" >
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Message</th>
                            <th>Time</th>
                            <th>Readed <input type="checkbox" id="checked_all" name="checked_all"></th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            
                            $i=$limit*($page-1)+1;
                            foreach ($data as $item) {
                                if ($item['status']==0) {
                                    echo '<tr>
                                            <td>'.$i++.'</td>
                                            <td><a onclick="status_change_dont_reload('.$item['id'].')" href="'.$item['href'].'"><i>'.$item['content'].'</i></a></td>
                                            <td>'.timeAgo($item['created_at']).'</td>
                                            <td><input  type="checkbox" name="status" onclick="status_change('.$item['id'].')"></td>
                                        </tr>';
                                }else{
                                    echo '<tr>
                                            <td>'.$i++.'</td>
                                            <td><a onclick="status_change_dont_reload('.$item['id'].')" href="'.$item['href'].'">'.$item['content'].'</a></td>
                                            <td>'.timeAgo($item['created_at']).'</td>
                                            <td><input checked readonly="true" type="checkbox" name="status" onclick="return false;" ></td>
                                        </tr>';
                                }
                                
                            }
                        ?>
                    </tbody>
                </table>

                <!-- pagination -->
                <div style="text-align: center;"> <?php include_once '../utility/pagination_multi.php'; ?> </div>
            </div>
            

        </div>
        <!-- end page-wrapper -->

    </div>
    <!-- end wrapper -->
<script type="text/javascript">
    function status_change(id){
        $.post('adm_message.php',{change_id:id},function(data){
            window.location.reload()
        })
        
    }

    function status_change_dont_reload(id){
        $.post('adm_message.php',{change_id:id},function(data){
            // window.location.reload()
        })
        
    }

    $('#checked_all').click(function(){
            if (confirm('Đánh dấu toàn bộ là đã đọc?')) {
                    $.post('adm_message.php',{checked_all:1},function(data){
                        window.location.reload()
                    })
            }else{return false}
        })
</script>
</body>

</html>
