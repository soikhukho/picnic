<?php
  require_once '../db/dbhelper.php';
  require_once '../utility/utils.php';

  require_once 'php_form_admin/form_album_details.php';

?>

<!DOCTYPE html>
<html>

<head>
    <title>ALBUM DETAILS</title>
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
                    <h1 class="page-header">Admintration Albums Details</h1>
                </div>
                <!--End Page Header -->
            </div>

        <!-- main content start-->
       

            <div class="row" style="margin-left: 50px;margin-right: 50px;">
                <h3>Album số : <?= $album_id ?> - Title : <?= $album_title ?></h3>

                <!-- search form start -->
                  <form method="get">
                    <input type="" name="album_id" value="<?= $album_id ?>" style="display: none;">
                    <div class="input-group custom-search-form" style="margin-bottom: 8px;width: 300px;">
                        <input type="text" class="form-control" name="search" placeholder="Search id or title of photo ..." value="<?= $search ?>">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="submit">
                                <i class="fa fa-search"></i>
                            </button>
                        </span>
                    </div>
                  </form>
                  <!-- search form end -->

                  <span style="color: red ; font-style: italic;display: <?=($alert=='')?'none':'' ?>">
                    <?= $alert ?>
                    
                  </span>

                <table class="table table-bordered" style="">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Photo Title</th>
                            <th>Photo ID</th>
                            
                            <th>Thumbnail</th>
                            <th>Updated at</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>

                    <tbody>
                       
                        <?php
                            $i=$limit*($page-1)+1;
                            foreach ($data as $photo) {
                                echo '<tr>
                                        <td>'.$i++.'</td>
                                        <td><b>'.$photo['title'].'</b></td>
                                        <td>'.$photo['id'].'</td>
                                        
                                        <td><img src="'. plus_path($photo['address'],'../uploads/').'" style="width: 120px;"></td>
                                        <td>'.$photo['updated_at'].'</td>

                                        <td><button class="btn btn-danger" onclick="del('.$photo['id'].')">Delete</button></td>

                                        <td><button class="btn btn-warning" onclick="edit('.$album_id.','.$photo['id'].')">Edit</button></td>

                                    </tr>';
                            }
                        ?>
                        
                    </tbody>

                </table>

                <button id="create_btn" class="btn btn-warning" style="margin-right: 20px;">
                    Add Photoes / Update
                  </button>

                <a href="adm_albums.php"><button class="btn btn-primary">Back to Albums List</button></a>


                <!--hidden form  -->
                <div id="create_form"  class="panel panel-primary" style=" margin-top: 20px; display:none ;">
                    <div class="panel-heading">
                      <div style="text-align:right;">
                        <button id="close" class="btn btn-primary " style="font-size: 20px;padding: 10px;">X</button>
                      </div>
                      <h3 class="text-center" style="margin-top:-30px;"><?= (isset($edit_photo))?'Update this photoes':'Add new photoes'?></h3>
                    </div>
                    <div class="panel-body">
                      <form method="post" enctype="multipart/form-data" id="my_form">
                        <span style="color: red"></span>

                        <div class="form-group">
                            <label>Chọn phương thức nhập : </label><br>

                            <input type="radio" name="option" value="url" checked style="height: 20px; width: 20px;"> Url  
                            <input type="radio" name="option" value="upload"  style = "height: 20px; width: 20px;margin-left: 20px;"> Upload (one or more files)
                          
                        </div>

                        <div id="group_upload" class="form-group" >
                            <!-- <label>Chọn File ảnh</label>
                            <input id="photo_file" required="true" type="file" multiple="multiple" name="photo_file[]" > -->
                        </div>

                        <div id="group_url" class="form-group"  style="display: ">
                          <label for="address">URL :</label>
                          <input id="address" required="true" type="text" class="form-control" name="address" value="<?= (isset($edit_photo))?$edit_photo['address']:''?>">
                        </div>

                        <div class="form-group">
                          <label for="title">Title:</label>
                          <input required="true" type="text" class="form-control" id="title" name="title" value="<?= (isset($edit_photo))?$edit_photo['title']:''?>">
                        </div>

                        <div class="form-group">
                          <label>Album ID</label>
                          <input required="true" type="text" name="album_id" list="album_list" class="form-control" placeholder="looking for ID or Title of Album" value="<?= (isset($edit_photo))?$edit_photo['album_id']:$album_id?>">
                          <datalist id="album_list">

                            <?php
                              $album_list=executeResult("select id , title from albums ");
                              foreach ($album_list as $album) {
                                echo '<option value="'.$album['id'].'">'.$album['title'].'</option>';
                              }
                            ?>
                          </datalist>
                        </div>
                        <span id="result"></span>

                        <center><button class="btn btn-warning" style="font-size: 20px;"><?= (isset($edit_photo))?'Update':'Create'?></button></center>
                      </form>
                    </div>
                  </div>


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
          $('#group_upload').html(`<label>Chọn File ảnh</label>
                            <input id="photo_file" required="true" type="file" multiple="multiple" name="photo_file[]" >(***Nếu chọn upload nhiều ảnh thì tất cả ảnh được lưu đều có chung một Title)`) ;
          $('#group_url').empty() ;

        }else{

          $('#group_upload').empty() ;
          $('#group_url').html(`<label for="address">URL:</label>
                          <input id="address" required="true" type="text" class="form-control" name="address" value="<?= (isset($edit_photo))?$edit_photo['address']:''?>">`) ;

        }
      })

      function del(id){
        if (confirm('Ban co chắc chắc muốn xóa sp này ?') ) {
          $.post('adm_photoes.php',
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

      function edit(album_id,id){
        if (confirm('Ban co chắc chắc muốn sửa sp này ?') ) {

          window.location.replace("adm_album_details.php?album_id="+ album_id +"&editID="+id);
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
      
      $.post('../form_ajax/photo_form.php',{game_id:game_id},function(data){
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