<?php
  require_once '../db/dbhelper.php';
  require_once '../utility/utils.php';

  require_once 'php_form_admin/form_videos.php';

?>

<!DOCTYPE html>
<html>

<head>
    <title>ADM VIDEOS</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <!-- include summernote css/js -->
    <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote.css" rel="stylesheet">
    <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote.js"></script>

    <link href="../assets/plugins/bootstrap/bootstrap.css" rel="stylesheet" />
    <link href="../assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link href="../assets/plugins/pace/pace-theme-big-counter.css" rel="stylesheet" />
    <link href="../assets/css/style.css" rel="stylesheet" />
    <link href="../assets/css/main-style.css" rel="stylesheet" />

</head>

<body>
    <div id="wrapper">
        <!-- navbar  -->
        <?php 
            include_once '../layout/admin_navbar_top.php';
            include_once '../layout/admin_navbar_side.php';
        ?>
        <!-- end navbar  -->

        <!--  page-wrapper -->
        <div id="page-wrapper">

            <div class="row">
                <!-- Page Header -->
                <div class="col-lg-12">
                    <h1 class="page-header">Admintration Videos</h1>
                </div>
                <!--End Page Header -->
            </div>

        <!-- main content start-->
            <div class="row" style="margin-left: 50px;margin-right: 50px;">
                
                <!--hidden form  -->
                <button id="create_btn" class="btn btn-warning" style="margin-right: 20px;margin-bottom: 30px;">
                  Add Videos / Update
                </button>

                <div id="create_form"  class="panel panel-primary" style=" margin-top: 20px; display:none ;">
                    <div class="panel-heading">
                      <div style="text-align:right;">
                        <button id="close" class="btn btn-primary " style="font-size: 20px;padding: 10px;">X</button>
                      </div>
                      <h3 class="text-center" style="margin-top:-30px;"><?= (isset($edit_video))?'Update this video':'Add new'?></h3>
                    </div>
                    <div class="panel-body">
                      <form method="post" enctype="multipart/form-data">
                        <span style="color: red"></span>

                        <div class="form-group">
                            <label>Chọn phương thức nhập : </label><br>

                            <input type="radio" name="option" value="url" checked style="height: 20px; width: 20px;"> Url  
                            <input type="radio" name="option" value="upload"  style = "height: 20px; width: 20px;margin-left: 20px;"> Upload file
                          
                        </div>

                        <div id="group_upload" class="form-group" >
                            <!-- đổ html khi click -->
                        </div>

                        <div id="group_url" class="form-group"  style="display: ">
                          <label for="address">URL :</label>
                          <input id="address" required="true" type="text" class="form-control" name="address" value="<?= (isset($edit_video))?$edit_video['address']:''?>">
                        </div>

                        <div class="form-group">
                          <label for="title">Title:</label>
                          <input required="true" type="text" class="form-control" id="title" name="title" value="<?= (isset($edit_video))?$edit_video['title']:''?>">
                        </div>

                        <div class="form-group">
                          <label>Game ID</label>
                          <input required="true" type="text" name="game_id" list="game_list" class="form-control" placeholder="looking for ID or Title of game" value="<?= (isset($edit_video))?$edit_video['game_id']:''?>">
                          <datalist id="game_list">

                            <?php
                              $game_list=executeResult("select id , title from games ");
                              foreach ($game_list as $game) {
                                echo '<option value="'.$game['id'].'">'.$game['title'].'</option>';
                              }
                            ?>
                          </datalist>
                        </div>
                        <span id="result"></span>

                        <center><button class="btn btn-warning" style="font-size: 20px;"><?= (isset($edit_video))?'Update':'Create'?></button></center>
                      </form>
                    </div>
                  </div>

                
                <!-- search form start -->
                  <form method="get">
                    <input type="" name="album_id" value="<?= $album_id ?>" style="display: none;">
                    <div class="input-group custom-search-form" style="margin-bottom: 8px;width: 300px;">
                        <input type="text" class="form-control" name="search" placeholder="Search id or title of video ..." value="<?= $search ?>">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="submit">
                                <i class="fa fa-search"></i>
                            </button>
                        </span>
                    </div>
                  </form>
                  <!-- search form end -->

                <span id="alert area" style="color: red;font-style: italic;padding-bottom: 10px; display: <?=($alert=='')?'none':'' ?>">
                  <?= $alert ?>
                    
                </span>

                <table class="table table-bordered" style="">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Title</th>
                            <th>ID</th>
                            
                            <th>Thumbnail</th>
                            <th>Created at</th>
                            <th>Updated at</th>
                            <th>Game ID</th>
                            <th>Game Title</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>

                    <tbody>
                       
                        <?php
                            $i=$limit*($page-1)+1;
                            if ($data !='') {
                              foreach ($data as $video) {
                                if (strpos($video['address'],':')=='' ) {
                                  echo '<tr>
                                        <td>'.$i++.'</td>
                                        <td><b>'.$video['title'].'</b></td>
                                        <td>'.$video['id'].'</td>
                                        
                                        <td><video height="80" width="100" src="../uploads/'.$video['address'].'"  controls></video></td>

                                        <td>'.$video['created_at'].'</td>
                                        <td>'.$video['updated_at'].'</td>
                                         <td>'.$video['game id'].'</td>
                                         <td><i>'.$video['game title'].'</i></td>

                                        <td><button class="btn btn-danger" onclick="del('.$video['id'].')">Delete</button></td>

                                        <td><button class="btn btn-warning" onclick="edit('.$video['id'].')">Edit</button></td>

                                    </tr>';

                                }else{
                                  echo '<tr>
                                        <td>'.$i++.'</td>
                                        <td><b>'.$video['title'].'</b></td>
                                        <td>'.$video['id'].'</td>
                                        
                                        <td><iframe height="80" width="100" src="'.$video['address'].'"></iframe></td>

                                        <td>'.$video['created_at'].'</td>
                                        <td>'.$video['updated_at'].'</td>
                                         <td>'.$video['game id'].'</td>
                                         <td>'.$video['game title'].'</td>

                                        <td><button class="btn btn-danger" onclick="del('.$video['id'].')">Delete</button></td>

                                        <td><button class="btn btn-warning" onclick="edit('.$video['id'].')">Edit</button></td>

                                    </tr>';
                                }
                                
                              }
                            }
                            
                        ?>
                        
                    </tbody>

                </table>

                


                </div>

                <!-- pagination -->
                <div style="text-align: center;">
                    <?php include_once '../utility/pagination_multi.php'; ?> 
                </div>

             </div>

            </div>
            <!-- main content end-->

        </div>
        <!-- end page-wrapper -->

    </div>
    <!-- end wrapper -->


<script type="text/javascript">
      $('[name=option]').change(function(){
        var option = $(this).val() ;

        if (option=="upload") {
          $('#group_upload').html(`<label>Chọn File video </label>
                            <input id="video_file" required="true" type="file" multiple="multiple" name="video_file[]" >(***Nếu chọn upload nhiều video thì tất cả video được lưu đều có chung một Title)`) ;
          $('#group_url').empty() ;

        }else{

          $('#group_upload').empty() ;
          $('#group_url').html(`<label for="address">URL:</label>
                          <input id="address" required="true" type="text" class="form-control" name="address" value="<?= (isset($edit_video))?$edit_video['address']:''?>">`) ;

        }
      })

      function del(id){
        if (confirm('Ban co chắc chắc muốn xóa sp này ?') ) {
          $.post('adm_videos.php',
            {
              delID:id
            }
            ,
            function(data){
              location.reload()
            }
            )
        }
      }

      function edit(id){
        if (confirm('Ban co chắc chắc muốn sửa sp này ?') ) {

          window.location.replace("adm_videos.php?editID="+id);
        }
      }


      $('#create_btn').click(function(){
        document.getElementById('create_form').style.display=""
        document.getElementById('create_btn').style.display="none"
      })

       $("#close").click(function(){
             document.getElementById('create_form').style.display="none"
             document.getElementById('create_btn').style.display=""  
      })

   $('[name=game_id]').change(function(){

      $('[name=album_id]').val('')
      var game_id=$(this).val()
      
      $.post('../form_ajax/video_form.php',{game_id:game_id},function(data){
          $('#album_list').html(data)
      })
   })

    </script>

<?php
 if ($editID!='') {
     echo '<script type="text/javascript">
            $("document").ready(function(){
              document.getElementById("create_form").style.display=""
              document.getElementById("create_btn").style.display="none"
            })
          </script>';
  }
?>

</body>

</html>

<?php
  session_destroy();
?>