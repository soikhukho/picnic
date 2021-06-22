<?php
  require_once 'db/dbhelper.php';
  require_once 'utility/utils.php';

  $index="signup";

   $user = checkLogin();
   include_once 'login.php';

   if ($user!='') {
     header('Location: games.php');
     die();
   }

  $alert = '';
  $date= date('Y-m-d H:i:s');
  $email_signup = getPost('email_signup');
  $fullName_signup = getPost('fullName_signup');
  $birthday_signup = getPost('birthday_signup');
  $address_signup = getPost('address_signup');
  $phone_no_signup = getPost('phone_no_signup');
  $password_signup = getPost('password_signup');
  $cf_password_signup = getPost('cf_password_signup');
  $action=getPost('action');

  if (!empty($_POST)) {
    if ($action=='signup') {
      //check email
      $check=executeResult(" select * from users where email = '$email_signup' ");
      if (count($check)>0) {
        $alert= 'email đã được sử dụng';
      }

      //nếu email hợp lệ và pass khớp nhau
      if (count($check)==0 && $password_signup==$cf_password_signup) {
          $password= getMd5($password_signup);
          $sql = "insert into users(email , password, fullName, phone_no , address , birthday, created_at, updated_at) 
            values ('$email_signup', '$password', '$fullName_signup', '$phone_no_signup', '$address_signup','$birthday_signup', '$date','$date')";
          execute($sql);

          mess('Admin với email='.$email_signup.' đã đăng kí thành công ','adm_users.php');

          //thuc hien dang nhap luon
            $token = getMd5($email_signup.time());
            //luu token lên cookie
            setcookie("token", $token ,0, "/");
            //update lên db
            execute("update users set token = '$token' where email='$email_signup' ");


          header('Location: admin/adm_message.php');
          die();
      }
    }
      
  }
?>

<!DOCTYPE html>
<html>
<head>
  <title>Sign up</title>
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
                <input required="true" type="text" class="form-control" id="email_signup" name="email_signup" value="<?= $email_signup ?>" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" >
              </div>

              <div class="form-group">
                <label for="fullName_signup">
                  Full name:
                  <span style="font-size: 10px;font-weight: normal;font-style: italic;">(không được chứa chữ số hay các kí tự ngoài bảng chữ cái tiếng Việt)</span> 
                </label>
                <input required="true" type="text"  class="form-control" id="fullName_signup" name="fullName_signup" value="<?= $fullName_signup ?>" pattern="^[^0-9_!¡?÷?¿/\\+=@#$%ˆ&*(){}|~<>;:[\]]{2,31}$" title="Tên không được chứa chữ số và kí tự đặc biệt : _!¡?÷?¿/\\+=@#$%ˆ&*(){}|~<>;:[\] . ">
              </div>

              <div class="form-group">
                <label for="phone_no_signup">
                  Phone number: 
                  <span style="font-size: 10px;font-weight: normal;font-style: italic;">(format: 1234-567-890)</span> 
                </label>

                <input required="true" type="text" class="form-control" id="phone_no_signup" name="phone_no_signup" value="<?= $phone_no_signup ?>" pattern="[+0-9]{4,6}-[0-9]{3}-[0-9]{3}">
                
              </div>

              <div class="form-group">
                <label for="address_signup">Address:</label>
                <input required="true" type="text" class="form-control" id="address_signup" name="address_signup" value="<?= $address_signup ?>">
              </div>
              
              <div class="form-group">
                <label for="birthday_signup">
                  Bỉthday:
                  <span style="font-size: 10px;font-weight: normal;font-style: italic;">(yêu cầu trên 18 tuổi)</span> 
                </label>
                <input required="true" type="date" class="form-control" id="birthday_signup" name="birthday_signup" value="<?= $birthday_signup ?>">
              </div>
              <div class="form-group">
                <label for="password_signup">
                  Password:
                  <span style="font-size: 10px;font-weight: normal;font-style: italic;">(password phải chứa ít nhât 1 kí tự thường , ít nhât một kí tự hoa ,ít nhât một chữ số , và tổng cộng từ 8 kí tự trở lên)</span> 
                </label>
                <input required="true" type="password" class="form-control" id="password_signup" name="password_signup" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$" title="password phải chứa ít nhât 1 kí tự thường , ít nhât một kí tự hoa ,ít nhât một chữ số , và tổng cộng từ 8 kí tự trở lên.">
              </div>
              <div class="form-group">
                <label for="cf_password_signup">
                  Confirm Password:
                </label>
                <input required="true" type="password" class="form-control" id="cf_password_signup" name="cf_password_signup">  
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

<script type="text/javascript">
  //tuổi phải lớn hơn 18 (568024668 giây)
  $('#signup_form').submit(function(){
    var birthday_signup=$('[name=birthday_signup]').val() ;
    
    var limit = Date.parse(birthday_signup)
    if (limit < 568024668) {
      alert('Bạn chưa đủ 18 tuổi')
      return false;
    }
      
  }

    var password_signup = $('[name=password_signup]').val()
    var cf_password_signup = $('[name=cf_password_signup]').val()

    if (password_signup != cf_password_signup) {

      alert('Password không khớp nhau')
      $('[name=password_signup]').val('')
      $('[name=cf_password_signup]').val('')

      $('[name=password_signup]').focus()
      return false;
    }
  })
</script>
</body>
</html>
