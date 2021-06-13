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
          </div>
          <!-- End left -->

          <!-- Begin right -->
          <?php include_once 'layout/content-right.php'; ?>
          <!-- End right -->
      </div>
  </section>

  <script type="text/javascript">
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
</body>
</html>
