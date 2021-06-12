<?php
  require_once 'db/dbhelper.php';
  require_once 'utility/utils.php';

  $index ="games";

  $user = checkLogin();
  include_once 'login.php';

  $id=getGet('id');

  $sql="select * from games where id = $id";

  $detail=executeResult($sql,true);
  if ($detail==null ) {
    header('Location: games.php');
  }

  $albums_id_list = executeResult("select albums.id 'albums id' from albums where  albums.game_id = $id");


?>

<!DOCTYPE html>
<html>
<head>
  <title>game detail</title>
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

  <style type="text/css">
    #content img{
      width: 100%;
    }
    #content iframe{
      width: 100% !important;
    }
  </style>
</head>
<body>
    <?php
        include_once 'layout/header2.php';
        include_once 'layout/carosell.php';
        include_once 'layout/popup_login.php';

     ?>
     <div class="container" style="min-height: 500px;">
       <div id="main_content" class="col-md-8" style="text-align: justify;">

         <h2><?=$detail['title'] ?></h2>

          <div id="thumbnail">
            <img src="<?=$detail['thumbnail'] ?>" style="width: 100%;">
          </div>

         <div id="content">
           <?=$detail['content'] ?>
         </div>

         <?php
          if ($albums_id_list!=null) {
              foreach ($albums_id_list as $id) {
                showAlbum_represent($id['albums id']);
              }
            }
         ?>

         <!-- modal start -->
         <div id="myModal" class="modal_box" >
            

          </div>
          <!-- modal end -->

       </div>
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
