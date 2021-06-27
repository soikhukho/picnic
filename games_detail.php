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

  $views=$detail['views']+1;
  execute("update games set views  ='$views' where id = '$id' ");


  $albums_id_list = executeResult("select albums.id 'albums id' from albums where  albums.game_id = $id");

//for videos
  $videos=executeResult("select * from videos where game_id = '$id' ");

//for comment
  if ($user !='') {
    $admin_name=$user['fullname'].' - admin';
    $avatar=$user['avatar'];

  }else{
    $admin_name='';
    $avatar='https://icdn.dantri.com.vn/images/no-avatar.png';
  }
  
  $cmt=getGet('cmt');
  $page_code = 'games_detail.php?id='.$id;
  $comments = executeResult("select * from comments where page_code= '$page_code' order by created_at desc ");

  $limit_cmt=3;
  


?>

<!DOCTYPE html>
<html>
<head>
  <title>GAME DETAILS</title>
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
    include_once 'layout/carosell.php';
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
                
                <div class="main-content" >

                  <!-- push data game detail -->
                  <p><?=$detail['description'] ?></p>

                  <h2>
                    <?=$detail['title'] ?>
                    <span style="font-size: 14px; font-weight: normal;font-style: italic;">
                      ( <?=$views ?> views )
                    </span> 
                  </h2>

                  <div id="thumbnail">
                    <img src="<?=$detail['thumbnail'] ?>" style="width: 100%;">
                  </div>

                 <div id="content">
                   <?=$detail['content'] ?>
                 </div>

                 <!-- push ảnh bìa albums -->
                 <?php
                  if ($albums_id_list!=null) {
                      foreach ($albums_id_list as $item) {
                        showAlbum_represent($item['albums id']);
                      }
                    }
                 ?>

                 <!-- push video -->
                 <?php
                    foreach ($videos as $video) {
                       if (strpos($video['address'],':')=='' ){

                        echo '<video height="" width="100%" src="uploads/'.$video['address'].'"  controls></video>';

                        echo '<a href="downloads.php?file_name='.$video['address'].'">Download this video (upper) </a>';

                       } else{

                        echo '<iframe  width="687" height="360" src="'.$video['address'].'"></iframe>';
                       }
                    }
                 ?>
                 

                  <!-- cmt area start -->
                  <div name="comments_area" id="<?= $page_code ?>" style="margin-top: 50px;margin-bottom: 50px;">

                      <!-- form cmt -->
                      <?php include_once 'layout/comments_form.php' ?>
                      <!-- form cmt -->

                      <!-- ô này trung gian , để lấy được $GET['cmt'] ,dùng trong trường hợp nhấp vào link thông báo : value == id của nút repcmt  -->
                      <input type="number" name="rep_comment_id" value="<?=$cmt ?>" style="display: none;">

                      <input type="text" id="admin_name" value="<?=$admin_name?>" style="display:none;">

                      <input type="text" id="avatar" value="<?=$avatar?>" style="display:none;">

                      <!-- list cm start -->
                      <!-- chỗ này sẽ đươc load lại sau mỗi cmt thành công -->
                      <input type="text" name="page_code" value="<?=$page_code?>" style="display: none;">
                      <div id="list_comment" style="border:solid 1px #eee;margin-top:;padding-bottom: 15px;">
                        
                         
                      </div>
                      <!-- list cm end -->
                      

                  </div>
                  <!-- cmt area end -->

              </div>
              <!-- main content end -->
          </div>

          <!-- cmt start -->
          <div>
            
          </div>
          <!-- cmt end -->

          <!-- End left -->

          <!-- Begin right -->
          <?php include_once 'layout/content-right.php'; ?>
          <!-- End right -->

        <!-- modal start :show album slide -->
       <div id="myModal" class="modal_box" >                   
            <!-- chỗ này để đổ data  ajax : show album slide -->
        </div>
        <!-- modal end -->

      </div>
  </section>

  <?php include 'layout/footer.php'; ?>

<script>
 

  //for modal and slide
  function OpenModal(id) {
      $.post('form_ajax/show_album.php',{id:id},function(data){
          $('#myModal').html(data) ;
      })

      document.getElementById("myModal").style.display = "block";

    }

    function closeModal(id) {
      $('#myModal').empty() ;
      document.getElementById("myModal").style.display = "none";

      var views=parseInt( $('#views'+id).text() )*1 + 1 ;
      $('#views'+id).html(views);
    }

    $(document).ready(function() {
        $(".mCustomScrollbar").mCustomScrollbar({axis:"x"});
    });
</script>


<script type="text/javascript" src="js/comments.js">//for comments </script>
</body>
</html>
