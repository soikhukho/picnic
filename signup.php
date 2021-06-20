<?php
  require_once 'db/dbhelper.php';
  require_once 'utility/utils.php';

  $index="";

   $user = checkLogin();
   include_once 'login.php';

  $alert = '';
  $date= date('Y-m-d H:i:s');
  $email_signup = getPost('email_signup');
  $fullName = getPost('fullName');
  $birthday = getPost('birthday');
  $address = getPost('address');
  $phone_no = getPost('phone_no');
  $singup_pwd = getPost('singup_pwd');
  $cf_pwd = getPost('cf_pwd');
  $action=getPost('action');

  if (!empty($_POST)) {
    if ($action=='signup') {
      //check email
      $check=executeResult(" select * from users where email = '$email_signup' ");
      if (count($check)>0) {
        $alert= 'email đã được sử dụng';
      }

      //nếu email hợp lệ và pass khớp nhau
      if (count($check)==0 && $singup_pwd==$cf_pwd) {
          $pass= getMd5($singup_pwd);
          $sql = "insert into users(email , password, fullname, phone_no , address , birthday, created_at, updated_at) 
            values ('$email_signup', '$pass', '$fullName', '$phone_no', '$address','$birthday', '$date','$date')";
          execute($sql);

          mess('Admin với email='.$email_signup.' đã đăng kí thành công ','adm_users.php');

          //thuc hien dang nhap luon
            $token = getMd5($email_signup.time());
            //luu token lên cookie
            setcookie("token", $token ,0, "/");
            //update lên db
            execute("update users set token = '$token' where email='$email_signup' ");


          header('Location: admin/adm_message.php');
      }
    }
      
  }
?>

<!DOCTYPE html>
<html>
<head>
  <title>Home</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <!-- include summernote css/js -->
  <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote.css" rel="stylesheet">
  <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote.js"></script>
  <link rel="stylesheet" type="text/css" href="style/style_header2.css">
  <script src="https://kit.fontawesome.com/3e49906220.js" crossorigin="anonymous"></script>
</head>
<body>
    <?php
        include_once 'layout/header2.php';
        // include_once 'layout/carosell.php';
        include_once 'layout/popup_login.php';

     ?>
     <div class="container" style="min-height: 1000px;">

        <div style=" width:600px;margin: 0px auto; margin-top: 50px;">
        <div class="panel panel-primary">
          <div class="panel-heading">
            <h2 class="text-center">Sign up form</h2>
          </div>
          <div class="panel-body">
            <form id="signup_form" method="post">
              <span style="color: red"><?= $alert ?></span>
              
              <div class="form-group">
                <label for="email_signup">Email:</label>
                <input required="true" type="email" class="form-control" id="email_signup" name="email_signup" value="<?= $email_signup ?>">
              </div>

              <div class="form-group">
                <label for="fullName">Full name:</label>
                <input required="true" type="text" class="form-control" id="fullName" name="fullName" value="<?= $fullName ?>">
              </div>

              <div class="form-group">
                <label for="phone_no">Phone number:</label>
                <input required="true" type="text" class="form-control" id="phone_no" name="phone_no" value="<?= $phone_no ?>">
              </div>

              <div class="form-group">
                <label for="address">Address:</label>
                <input required="true" type="text" class="form-control" id="address" name="address" value="<?= $address ?>">
              </div>
              
              <div class="form-group">
                <label for="birthday">Birthday:</label>
                <input required="true" type="date" class="form-control" id="birthday" name="birthday" value="<?= $birthday ?>">
              </div>
              <div class="form-group">
                <label for="pwd">Password:</label>
                <input required="true" type="password" class="form-control" id="singup_pwd" name="singup_pwd">
              </div>
              <div class="form-group">
                <label for="cf_pwd">Confirmation Password:</label>
                <input required="true" type="password" class="form-control" id="cf_pwd" name="cf_pwd">  
              </div>

              <div class="form-group" style="display: none;">
                <label for="action"></label>
                <input required="true" type="text" class="form-control" id="action" name="action" value="signup">  
              </div>
              <center><button class="btn btn-warning" style="font-size: 20px;">Sign Up</button></center>
            </form>
          </div>
        </div>
      </div>
     
     </div>
    <?php include 'layout/footer.php'; ?>

</body>
</html>
