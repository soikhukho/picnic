<?php
  require_once 'db/dbhelper.php';
  require_once 'utility/utils.php';
  require_once 'utility/utils_file.php';

  $index="index";

  $user = checkLogin();
  include_once 'login.php';

  $file_name=[];
  if (isset($_FILES['photo_file']) ) {

       $files = $_FILES['photo_file'];

        $names      = $files['name'];
        $types      = $files['type'];
        $tmp_names  = $files['tmp_name'];
        $errors     = $files['error'];
        $sizes      = $files['size'];


        $numitems = count($names);
        $numfiles = 0;
        for ($i = 0; $i < $numitems; $i ++) {
            //Kiểm tra file thứ $i trong mảng file, up thành công không
            if ($errors[$i] == 0)
            {
                $numfiles++;

                $allowtypes    = array('jpg', 'png', 'jpeg', 'gif');
                $imageFileType = pathinfo($names[$i],PATHINFO_EXTENSION);
                //nếu tên file chưa tồn tại và đúng kiểu 
                if (file_exists('uploads/'.$names[$i]) ==false && in_array($imageFileType,$allowtypes ) )
                {

                  move_uploaded_file($tmp_names[$i], 'uploads/'.$names[$i]);

                   $file_name[]=$names[$i];

                 }

            }
        } 

  }

  var_dump($file_name);




$page_code = 'games-2';
  $comments = executeResult("select * from comments where page_code= '$page_code' order by id desc ");

$father_id = getPost('father_id');
$content = getPost('content');
$table = getPost('table');
$date = date('Y-m-d H:i:s');

if (!empty($_POST)) {

  if ($table=='comments' && $content!='') {
    execute("insert into comments(page_code,content,created_at)
               values('$page_code','$content','$date')" );
    $_POST='';
    header("Refresh:0");
    die();
  }

  if ($table =='sub_comments' && $content!= '') {
    execute("insert into sub_comments(content,father_id , created_at)
               values('$content','$father_id' , '$date')" );
    $_POST='';
    header("Refresh:0");
    die();
  }

}


?>

<!DOCTYPE html>
<html>
<head>
  <title>test</title>
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

  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.min.js"></script>
</head>
<body>
    <?php
        // include_once 'layout/header2.php';
        // include_once 'layout/carosell.php';
        // include_once 'layout/popup_login.php';

     ?>
     

      
      <!-- <span >
        <form>
          <input type="text" name="full_name">
          <textarea name="content"></textarea>
          <input type="number" name="father_id" value="">
        </form>
      </span> -->

      <div id="cm" style="margin-top:20px;">

        <div>
          <button class="btn btn-warning" id="btn_cmt">Bình luận </button>
          <span></span>
        </div>

        <?php

         foreach ($comments as $comment) {
          
             echo '<div>
             <div class="row" style="border: 1px solid grey;margin-top:10px; margin-bottom:10px;">
                      <div class="col-md-2">
                        <img src="https://static2.yan.vn/YanNews/2167221/202003/dan-mang-du-trend-thiet-ke-avatar-du-kieu-day-mau-sac-tu-anh-mac-dinh-b0de2bad.jpg" style="height: 60px; width 60px;">
                      </div>
                      <div class="col-md-9">
                        <p>'.$comment['content'].'</p>
                      </div>
                      <div class="col-md-1">
                        <button name="rep" class="btn btn-warning" id="'.$comment['id'].'">trả lời</button>
                      </div>
                    </div>';

                $sons = look_for_subs($comment['id']);
                foreach ($sons as $comment) {
                  echo '<div class="row" style="border: 1px solid green;margin-top:10px; margin-bottom:10px; margin-left:50px;">
                      <div class="col-md-2">
                        <img src="https://static2.yan.vn/YanNews/2167221/202003/dan-mang-du-trend-thiet-ke-avatar-du-kieu-day-mau-sac-tu-anh-mac-dinh-b0de2bad.jpg" style="height: 60px; width 60px;">
                      </div>
                      <div class="col-md-10">
                        <p>'.$comment['content'].'</p>
                      </div>
                    </div>';
                }

                echo '<span >
                        
                      </span>';
                echo '</div>';
          
          }

        ?>


     </div>

     <a href="downloads.php?file=1"><button class="btn btn-danger">Download file 1</button></a>
     <a href="downloads.php?file=2">Download file 2</a>
     <a href="downloads.php?file=3">Download file 3</a>


     <form method="post" enctype="multipart/form-data">
       
       <label>Chọn File video</label>
            <input id="video_file" required="true" type="file" multiple="multiple" name="photo_file[]" > -->
            (***Nếu chọn upload nhiều video thì tất cả video được lưu đều có chung một Title)
            <button class="btn btn-warning">send</button>
     </form>


    <div id="chart-container">
        <canvas id="graph"></canvas>
    </div>

    <script>
        $(document).ready(function () {
            showGraph();
        });


        function showGraph(){
                $.post("admin/php_form_admin/chart.php",
                function (data){
                    console.log(data);
                    var formStatusVar = [];
                    var total = []; 

                    for (var i in data) {
                        formStatusVar.push(data[i].status);
                        total.push(data[i].size_status);
                    }

                    var options = {
                        legend: {
                            display: false
                        },
                        scales: {
                            xAxes: [{
                                display: true
                            }],
                        yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                        }
                    };

                    var myChart = {
                        labels: formStatusVar,
                        datasets: [
                            {
                                label: 'Tổng số',
                                backgroundColor: '#17cbd1',
                                borderColor: '#46d5f1',
                                hoverBackgroundColor: '#0ec2b6',
                                hoverBorderColor: '#42f5ef',
                                data: total
                            }
                        ]
                    };

                    var bar = $("#graph"); 
                    var barGraph = new Chart(bar, {
                        type: 'bar',
                        data: myChart,
                        options: options
                    });
                });
        }
        </script>


     </div>

    <?php include 'layout/footer.php'; ?>

<script type="text/javascript">

  $('#btn_cmt').click(function(){
     $(this).parent().children('span').html(`<form method = post>
                          <input type="text" name="table" value="comments">
                          <input type="text" name="full_name">
                          <textarea name="content"></textarea>
                          <button class="btn btn-warning">Reply</button>
                        </form>`) ;
     $(this).parent().children('span').children().children('[name=content]').focus()

  })


  $('[name=rep]').click(function(){
      var father_id = $(this).attr('id');

      $(this).parent().parent().parent().children('span').html(`<form method = post>
                          <input type="text" name="table" value="sub_comments">
                          <input type="text" name="full_name">
                          <textarea name="content"></textarea>
                          <input type="number" name="father_id" >
                          <button class="btn btn-warning">Reply</button>
                        </form>`);
      $(this).parent().parent().parent().children('span').children().children('[name=father_id]').val(father_id) 
      $(this).parent().parent().parent().children('span').children().children('[name=content]').focus()
  })

</script>

</body>
</html>
