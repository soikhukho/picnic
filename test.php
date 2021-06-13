<?php
  require_once 'db/dbhelper.php';
  require_once 'utility/utils.php';

  $index="index";

  $user = checkLogin();
  include_once 'login.php';

  $file_name=[];
  if (isset($_FILES['photo_file']) ) {

       $files = $_FILES['photo_file'];

        $names      = $files['name'];
        $types      = $files['type'];
        $tmp_names  = $files['tmp_name'];
        $errors     = $files['error'];
        $sizes      = $files['size'];


        $numitems = count($names);
        $numfiles = 0;
        for ($i = 0; $i < $numitems; $i ++) {
            //Kiểm tra file thứ $i trong mảng file, up thành công không
            if ($errors[$i] == 0)
            {
                $numfiles++;
                
                move_uploaded_file($tmp_names[$i], 'uploads/'.$names[$i]);

                 $file_name[]=$names[$i];

            }
        } 

  }
 
  foreach ($file_name as $address) {
    echo $address;
  }



?>

<!DOCTYPE html>
<html>
<head>
  <title>test</title>
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
     <div class="container" style="min-height: 500px;">
       <form enctype="multipart/form-data" method="POST">

            <label>Chọn File ảnh</label>
            <input id="photo_file" required="true" type="file" multiple="multiple" name="photo_file[]" >

          <button class="btn btn-primary" type="submit">Upload</button>
      </form>

      <span><?php  var_dump($_FILES['photo_file']);  ?></span>

     </div>
    <?php include 'layout/footer.php'; ?>

    

</body>
</html>
