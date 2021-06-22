<?php

$selected='adm_change_password';

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

$alert='';
$email=$user['email'];
$cr_pwd = getPost('cr_pwd');
    $cr_pwd=getMd5($cr_pwd);

$new_pwd= getPost('new_pwd');
$cf_pwd= getPost('cf_pwd');

if (!empty($_POST) && $new_pwd!='') {
    //check pass
    $check=executeResult("select * from users where email= '$email' and password= '$cr_pwd' ");

    if (count($check)!=1) {
        $alert='Mật khẩu không đúng ';
    }else{
        if ($new_pwd==$cf_pwd) {
            $new_pwd= getMd5($new_pwd);

            execute("update users set password = '$new_pwd' where email= '$email' and password ='$cr_pwd' ");
            mess('<b>Admin '.$email.'</b> đã thay đổi mật khẩu','adm_users.php');
            header('Location: adm_statistic.php');
            die();
        }
    }
}
