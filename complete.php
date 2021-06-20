<?php
  require_once 'db/dbhelper.php';
  require_once 'utility/utils.php';

 $index='';

  $user = checkLogin();
  include_once 'login.php';

?>

<!DOCTYPE html>
<html>
<head>
  <title>Complete</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <!-- include summernote css/js -->
  <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote.css" rel="stylesheet">
  <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote.js"></script>

  <script src="https://kit.fontawesome.com/3e49906220.js" crossorigin="anonymous"></script>

  <link rel="stylesheet" type="text/css" href="style/style_header2.css">
</head>
<body>
    <?php
        include_once 'layout/header2.php';
        // include_once 'layout/carosell.php';
        // include_once 'layout/popup_login.php';

     ?>
     <div class="container" style="min-height: 1000px;">
       <h1 style="text-align: center;margin-top: 50px; ">
         Bạn đã đặt hàng thành công !!!
       </h1>

       <center style="margin-top: 50px;">
        <a href="games.php"><button class="btn btn-primary">Quay lại trang chủ</button></a>
       </center>
     </div>
    <?php include 'layout/footer.php'; ?>

</body>
</html>
