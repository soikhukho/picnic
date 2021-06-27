<?php
  require_once 'db/dbhelper.php';
  require_once 'utility/utils.php';

  $index="places";

  $user = checkLogin();
  include_once 'login.php';

  $limit=3;
    $page=getPost('page');
    if ($page=='') {
      $page=1;
    }
    $start=($page-1)*$limit;

//for comments area
  if ($user !='') {
    $admin_name=$user['fullname'].' - admin';
    $avatar=$user['avatar'];

  }else{
    $admin_name='';
    $avatar='https://icdn.dantri.com.vn/images/no-avatar.png';
  }

$cmt=getGET('cmt');
$page_code = 'places.php?';
$comments = executeResult("select * from comments where page_code= '$page_code' order by created_at desc ");


?>

<!DOCTYPE html>
<html>
<head>
  <title>PLACES</title>
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
  <link rel="stylesheet" type="text/css" href="style/style_body.css">
</head>

<body>
  <?php
    include_once 'layout/header2.php';
    include_once 'layout/carosell_places.php';
    include_once 'layout/popup_login.php';
  ?>

   <section class="container" >

      <div class="icon">
          <button><i class="fas fa-thumbs-up"></i> Thích</button>
          <button>Chia sẻ</button>
      </div>

      <div class="content">

          <!-- Begin left -->
          <div class="content__left" >
              <div class="main-content">




              </div>
              <div style="width: 92%;">
                <!-- cmt area start -->
                <div name="comments_area" id="<?= $page_code ?>" style="margin-top: 50px;margin-bottom: 50px;">

                    <!-- form cmt -->
                    <?php include_once 'layout/comments_form.php' ?>
                    <!-- form cmt -->

                    <!-- list cm start -->
                    <input type="number" name="rep_comment_id" value="<?=$cmt ?>" style="display: none;">
                    <input type="text" id="admin_name" value="<?=$admin_name?>" style="display:none;">
                    <input type="text" id="avatar" value="<?=$avatar?>" style="display:none;">

                    <input type="text" name="page_code" value="<?=$page_code?>" style="display: none;">
                    <div id="list_comment" style="border:solid 1px #eee;margin-top:;padding-bottom: 15px;">
                      <?php
                        // load_comments($page_code);
                      ?>
                    </div>
                    <!-- list cm end -->

                </div>
                <!-- cmt area end -->
              </div>
          </div>
          <!-- End left -->

          <!-- Begin right -->
          <?php include_once 'layout/content-right.php'; ?>
          <!-- End right -->
      </div>
  </section>

  <script type="text/javascript">

       //load cmt 
      $(document).ready(function(){
        var page_code=$('[name=page_code]').val();

        $.post('form_ajax/pagination_cmt.php',{page:1,page_code:page_code},function(data){
            $('#list_comment').html(data);
        })
      })
  
      loadmore(0)
      
      function loadmore(page) {
        $('#btn'+page).hide()
        page++
        $.post('form_ajax/pagination_place.php',{page:page},function(data){
          $('.main-content').append(data);
        })
      }
    </script>

  <?php include 'layout/footer.php'; ?>

<script type="text/javascript" src="js/comments.js"> </script>
</body>
</html>
