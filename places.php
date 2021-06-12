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
  <title>Home</title>
  <meta charset="utf-8">
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

  <style type="text/css">
    #content{
      text-align: justify;
    }
    #content img{
      padding-top: 10px;
      padding-bottom: 15px;
      width: 100% !important;
    }
    a{
      text-decoration: initial;
    }
  </style>
</head>
<body>
  <?php
      include_once 'layout/header2.php';
      include_once 'layout/carosell_places.php';
      include_once 'layout/popup_login.php';
   ?>

     <div class="container" style="min-height: 500px;">

        <div style="font-size: 33px; font-weight: bold;text-align: center;margin-top: 30px;">- TOP BEAUTY PLACES -</div>

         <div class="row">
            <div class="col-md-8" id="content" style="margin-bottom: 50px;">
            
            </div>
            <div class="col-md-4">
              
            </div>
         </div>
     </div>
     
     <script type="text/javascript">
      loadmore(0)
      
      function loadmore(page) {
        $('#btn'+page).hide()
        page++
        $.post('form_ajax/pagination_place.php',{page:page},function(data){
          $('#content').append(data);
        })
      }
    </script>

<?php include 'layout/footer.php'; ?>

</body>
</html>
