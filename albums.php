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

  <link rel="stylesheet" type="text/css" href="style/style_album.css">
</head>
<body>
    <?php
        include_once 'layout/header2.php';
        // include_once 'layout/carosell.php';
        include_once 'layout/popup_login.php';

     ?>
     <div class="container" style="width:700px; min-height: 500px;padding-top:30px;">
        <?php
          foreach ($data as $item) {
            showAlbum_represent($item['id']);
          }
        ?>

        <!-- modal start -->
         <div id="myModal" class="modal_box" >
            

          </div>
          <!-- modal end -->
     </div>

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
