<?php
	require_once 'db/dbhelper.php';
  	require_once 'utility/utils.php';
  	$user = checkLogin();
    include_once 'login.php';

    $id=getGet('id');
    $place=executeResult("select * from places where id = $id",true);
  	

?>
<!DOCTYPE html>
<html>
<head>
  <title></title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <!-- include summernote css/js -->
  <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote.css" rel="stylesheet">
  <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote.js"></script>
  <link rel="stylesheet" type="text/css" href="style/style.css">
  <style type="text/css">
  	#content{
  		text-align: justify;
  	}
  	#content img{
  		padding-top: 10px;
  		padding-bottom: 15px;
  		width: 100% !important;
  	}
  </style>
</head>
<body>
    <?php
        include 'layout/header.php';
        // include 'layout/carosell.php';
        include_once 'layout/popup_login.php';
     ?>
     <div class="container" style="min-height: 500px;">
       <div class="row">
       		<div class="col-md-8" id="content" style="margin-top: 30px;margin-bottom: 50px;">
       		<?php
       			echo '<h1 style="margin-bottom: 20px;font-weight:bold;">'.$place['title'].'</h1>
                <div>'.$place['content'].'</div>';
       		?>
       		</div>
       		<div class="col-md-4">
       			
       		</div>
       </div>
     </div>
    <?php include 'layout/footer.php'; ?>

    <script type="text/javascript">
    	function loadmore(page) {
    		$('#btn'+page).hide()
    		page++
    		$.post('pagination_place.php',{page:page},function(data){
    			$('#content').append(data);
    		})
    	}
    </script>

</body>
</html>


       			
	       			


