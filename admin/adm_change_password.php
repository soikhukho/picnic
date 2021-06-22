<?php
  require_once '../db/dbhelper.php';
  require_once '../utility/utils.php';

  require_once 'php_form_admin/form_change_pass.php';
?>

<!DOCTYPE html>
<html>

<head>
    <title>change your password</title>
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
                    <h1 class="page-header">Update your password </h1>
                </div>
                <!--End Page Header -->
            </div>

            <div class="row">
                <div style=" margin-left: 50px;margin-right: 50px;">

                    <button id="show_btn" class="btn btn-warning" ><h5 style="color: grey ;font-weight: bold;">Update your Password</h5>
                    </button>

                      <div id="myform"  class="panel panel-primary" style="display: none;">
                        <div class="panel-heading">
                          <div style="text-align:right;">
                            <button id="close" class="btn btn-primary " style="font-size: 20px;padding: 10px;">X</button>
                          </div>
                          <h3 class="text-center" style="margin-top:-30px;">Update your password</h3>
                        </div>
                        <div class="panel-body">
                          <form id="update_pass_form" method="post">
                            <span style="color: red"><?= $alert ?></span>
                            
                            <div class="form-group">
                              <label for="email">Your Email:</label>
                              <input readonly="true" required="true" type="text" class="form-control" id="email" name="email" value="<?= $user['email']?>">
                            </div>

                            <div class="form-group">
                              <label for="cr_pwd">Curent Password:</label>
                              <input required="true" type="password" class="form-control" id="cr_pwd" name="cr_pwd">
                            </div>

                            <div class="form-group">
                              <label for="new_pwd"> New Password:</label>
                              <input required="true" type="password" class="form-control" id="new_pwd" name="new_pwd" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$" title="password phải chứa ít nhât 1 kí tự thường , ít nhât một kí tự hoa ,ít nhât một chữ số , và tổng cộng từ 8 kí tự trở lên.">
                            </div>

                            <div class="form-group">
                              <label for="cf_pwd">Confirmation New Password:</label>
                              <input required="true" type="password" class="form-control" id="cf_pwd" name="cf_pwd">  
                            </div>

                            <center><button class="btn btn-warning" style="font-size: 20px;">UPDATE</button></center>
                          </form>
                        </div>
                      </div>
                    </div>
            </div>
        </div>
            

        </div>
        <!-- end page-wrapper -->

    </div>
    <!-- end wrapper -->
<script type="text/javascript">
    $('#show_btn').click(function(){
        document.getElementById('myform').style.display=""
        document.getElementById('show_btn').style.display="none"
      })

       $("#close").click(function(){
             document.getElementById('myform').style.display="none"
             document.getElementById('show_btn').style.display=""  
      })

       $('#update_pass_form').submit(function(){

        if ($('#new_pwd').val() != $('#cf_pwd').val()) {
            alert('Password chua khop nhau')
            $('#new_pwd').val('')
            $('#cf_pwd').val('')
            $('#new_pwd').focus()
            return false;
        }
    })
</script>
</body>

</html>
