<?php
  require_once 'db/dbhelper.php';
  require_once 'utility/utils.php';

  require_once 'php_form/php_games.php';

?>

<!DOCTYPE html>
<html>
<head>
  <title>GAMES</title>
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
<link rel="stylesheet" type="text/css" href="style/game_style.css">
<script type="text/javascript" src="js/utils"></script>
</head>
<body>
    <?php
        include_once 'layout/header2.php';
        include_once 'layout/carosell.php';
        include_once 'layout/popup_login.php';

     ?>
     <div class="container" style="min-height: 500px;">
        <span id="result"></span>

        <div style="font-size: 35px; font-weight: bold;text-align: center;margin-top: 30px;">- TOP GAMES MỚI -</div>

        <!-- search start -->
        <div style="">
          <form method="get">
            <div class="input-group custom-search-form" style="margin-bottom: 8px;">
                <input type="text" class="form-control" name="search" placeholder="Search id or title..." value="<?= $search ?>">
                <span class="input-group-btn">
                    <button class="btn btn-default" type="submit" style="margin-top: 6px;">
                        <i class="fa fa-search"></i>
                    </button>
                </span>
            </div>
          </form>
        </div>
        <!-- search form end -->

        <div id="main-content" class="row">
          <!--  item start -->
          <?php
            foreach ($data as $game) {
              echo '<div class="game col-md-4">
                      <div class="game-inner">
                        <div class="thumbnail" style="position: relative;">
                          <a href="games_detail.php?id='.$game['id'].'">
                            <div class="img-hidden"><img src="'.$game['thumbnail'].'" style=" position: absolute;bottom:0px;height:225px;width:100%;border-radius:10px 10px 0 0;"></div>
                          </a>
                        </div>

                        
                        <div class="content" >
                            <div id="text_area">

                                <p class="title">
                                    '.$game['title'].'
                                    <span style="font-size:12px;">
                                        <i> ('.$game['cate title'].')</i>
                                    </span>
                                </p>

                                <p style="text-align: justify;">
                                  '.$game['description'].'
                                </p>
                            </div>

                            <div id="price_area">
                                <div style="width:100%; height: 40px; display: flex;text-align: justify;">

                                    <div class="price col-md-6">
                                        <p>'.number_format($game['price']).'<u>đ</u></p>
                                         <span>/ ticket</span>
                                     </div>

                                     <div class="quantity_area col-md-6" style="text-align: right;padding-right: 0px;">
                                        <button id="btn_minus" name="btn_minus" class="btn btn-danger" style="font-size: 9px;">
                                            <i class="fa fa-minus" aria-hidden="true"></i>
                                        </button>

                                        <input id="quantity" type="number" value="1" name="quantity" min="1" max="50">

                                        <button id="btn_add" name="btn_add" class="btn btn-success" style="font-size: 9px;">
                                            <i class="fa fa-plus" aria-hidden="true"></i>
                                        </button>
                                     </div>
                                </div>
                            </div>
                          

                            <div id="btn-area">
                                <div style="width:100%;height: 40px; display: flex;text-align: justify;">
                                    
                                    <div class="col-sm-6" style="padding-left:0px;">
                                        <a href="games_detail.php?id='.$game['id'].'">
                                          <button class="btn btn-primary" >View detail</button>
                                        </a>
                                    </div>
                                    <div class=" col-sm-6" style="text-align: right;
                                                    padding-right: 0px !important;">
                                      <button class="btn btn_addToCart" id="'.$game['id'].'">Add To Cart</button>
                                    </div>

                                </div>

                            </div>

                        </div>
                      </div>
                    </div>';
            }
          ?>
          <!--  item end -->    
        </div>


     </div>
     <!-- pagination -->
        <div style="text-align: center;"> <?php include_once 'utility/pagination_multi.php'; ?> </div>


  <?php include 'layout/footer.php'; ?>

<script type="text/javascript" src="js/change_quantity_games_page.js"></script>

</body>
</html>
