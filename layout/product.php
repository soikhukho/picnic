<?php
  require_once 'db/dbhelper.php';
  require_once 'utility/utils.php';

  $user = checkLogin();
  include_once 'login.php';

  $sql="select * from games";
  $gamesList=executeResult($sql);
?>

<!DOCTYPE html>
<html>
<head>
  <title>product</title>
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

  <link rel="stylesheet" type="text/css" href="style/game_style.css">
</head>
<body>
    <?php
        include_once 'layout/header2.php';
        include_once 'layout/carosell.php';
        include_once 'layout/popup_login.php';

     ?>
     <div class="container" style="min-height: 500px;">
        <div id="main-content" class="row">

            <!--  item start -->
            <div class="game col-md-4">
              <div class="game-inner">
                <div class="thumbnail" >
                    <img src="https://www.adventurebritain.com/wp-content/uploads/2015/09/kayaking-1.jpg" style="height:225px;width:100%;border-radius:10px 10px 0 0;">
                </div>
                <div class="content" >
                    <div id="text_area">
                        <p class="title"> Title</p>

                        <p style="text-align: justify;">
                          Description
                        </p>
                    </div>

                    <div id="price_area">

                      <div class=" col-sm-7">
                         <div class="row price">
                            <p>60,000<u>đ</u> </p>
                            <span>/ ticket</span>
                         </div>
                         <div class="row" style="display: flex;">
                           số lượng
                           <input type="number" name="quantity" min="1" style="width: 50px;">
                         </div>
                      </div>

                      <div class=" col-sm-5" style="text-align: right;
                                        padding-right: 0px !important;">
                        <button class="btn btn_addToCart" >Add To Cart</button>
                      </div>

                    </div>

                </div>
              </div>
            </div>
            <!-- item end -->
            
        </div>
     </div>
    <?php include 'layout/footer.php'; ?>

</body>
</html>



