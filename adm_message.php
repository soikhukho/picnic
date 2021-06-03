<?php
  require_once 'db/dbhelper.php';
  require_once 'utility/utils.php';

  $user = checkLogin();
      if ($user=='') {
        header('Location: index.php');
      }
$user_id=$user['id'];

$change_id =getPost('change_id');
$checked_all =getPost('checked_all');


if ($change_id!='' && $checked_all=='') {
    execute("update message set status = 1 where id = $change_id");
}

if ($change_id=='' && $checked_all!=''){
     execute("update message set status = 1");
}

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

    <link href="assets/plugins/bootstrap/bootstrap.css" rel="stylesheet" />
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/plugins/pace/pace-theme-big-counter.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet" />
    <link href="assets/css/main-style.css" rel="stylesheet" />
    <style type="text/css">
        table td,th{
            height: 50px;
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

            <div class="row">
                <!-- Page Header -->
                <div class="col-lg-12">
                    <h1 class="page-header">Your Message </h1>
                </div>
                <!--End Page Header -->
            </div>

            <div class="row">
                <table class="table  table-bordered" style="width: 800px;margin: 0px auto;">
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
                            $mess=executeResult("select * from message order by status asc, created_at desc");
                            $i=1;
                            foreach ($mess as $item) {
                                if ($item['status']==0) {
                                    echo '<tr>
                                            <td>'.$i++.'</td>
                                            <td>'.$item['content'].'</td>
                                            <td>'.timeAgo($item['created_at']).'</td>
                                            <td><input  type="checkbox" name="status" onclick="status_change('.$item['id'].')"></td>
                                        </tr>';
                                }else{
                                    echo '<tr>
                                            <td>'.$i++.'</td>
                                            <td>'.$item['content'].'</td>
                                            <td>'.timeAgo($item['created_at']).'</td>
                                            <td><input checked readonly="true" type="checkbox" name="status" onclick="return false;" ></td>
                                        </tr>';
                                }
                                
                            }
                        ?>
                    </tbody>
                </table>
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
