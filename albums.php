<?php
  require_once 'db/dbhelper.php';
  require_once 'utility/utils.php';

  $index="albums";

  $user = checkLogin();
  include_once 'login.php';

  $data=executeResult("select id from albums");


?>

<!DOCTYPE html>
<html>
<head>
  <title>ALBUMS</title>
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
  <link rel="stylesheet" type="text/css" href="style/style_album.css">
</head>

<body>
  <?php
    include_once 'layout/header2.php';
    // include_once 'layout/carosell.php';
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
              <?php
                foreach ($data as $item) {
                  showAlbum_represent($item['id']);
                }
              ?>
      
            </div>
          </div>
          <!-- End left -->

          <!-- Begin right -->
          <?php include_once 'layout/content-right.php'; ?>
          <!-- End right -->
      </div>

      <!-- modal start -->
     <div id="myModal" class="modal_box" >
        

      </div>
      <!-- modal end -->
  </section>

  <?php include 'layout/footer.php'; ?>

<script>
  function OpenModal(id) {
      $.post('form_ajax/show_album.php',{id:id},function(data){
          $('#myModal').html(data) ;
      })

      document.getElementById("myModal").style.display = "block";

    }

    function closeModal() {
      $('#myModal').empty() ;
      document.getElementById("myModal").style.display = "none";
    }

    $(document).ready(function() {
        $(".mCustomScrollbar").mCustomScrollbar({axis:"x"});
    });
</script>

</body>
</html>
