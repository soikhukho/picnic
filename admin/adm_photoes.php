<?php
  require_once '../db/dbhelper.php';
  require_once '../utility/utils.php';

  require_once 'php_form_admin/form_photoes.php';

?>



<!DOCTYPE html>
<html>

<head>
    <title>adm photoes</title>
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
                    <h1 class="page-header">Admintrations Photoes</h1>
                </div>
                <!--End Page Header -->
            </div>

            <div  class="row" style="margin-left: 50px;margin-right: 50px;">

                <!-- form create -->
                <div style=" width: 600px;">

                  <button id="create_btn" class="btn" style="background: #04B173;"><h5 style="color: white ;font-weight: bold;">
                      Create / Update</h5>
                  </button>

                  <div id="create_form"  class="panel panel-primary" style="display: none;">
                    <div class="panel-heading">
                      <div style="text-align:right;">
                        <button id="close" class="btn btn-primary " style="font-size: 20px;padding: 10px;">X</button>
                      </div>
                      <h2 class="text-center" style="margin-top:-30px;"><?= (isset($edit_photo))?'Update this photoes':'Create new photoes'?></h2>
                    </div>
                    <div class="panel-body">
                      <form method="post">
                        <span style="color: red"><?= $alert ?></span>
                        
                        <div class="form-group">
                          <label for="title">Title:</label>
                          <input required="true" type="text" class="form-control" id="title" name="title" value="<?= (isset($edit_photo))?$edit_photo['title']:''?>">
                        </div>

                        <div class="form-group">
                          <label for="address">address link:</label>
                          <input required="true" type="text" class="form-control" id="address" name="address" value="<?= (isset($edit_photo))?$edit_photo['address']:''?>">
                        </div>

                        <div class="form-group">
                          <label>Album ID</label>
                          <input type="text" name="album_id" list="album_list" class="form-control" placeholder="looking for ID or Title of Album" value="<?= (isset($edit_photo))?$edit_photo['album_id']:''?>">
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

                        <div class="form-group">
                          <label>Chọn theo Game ID</label>
                          <input type="text" name="game_id" list="game_list" class="form-control" placeholder="looking for ID or Title of Game">
                          <datalist id="game_list">

                            <?php
                              foreach ($game_list as $game) {
                                echo '<option value="'.$game['id'].'">'.$game['title'].'</option>';
                              }
                            ?>
                          </datalist>
                        </div>

                        <center><button class="btn btn-warning" style="font-size: 20px;"><?= (isset($edit_photo))?'Update':'Create'?></button></center>
                      </form>
                    </div>
                  </div>
                </div>
                
                <!-- show photoes -->
                <div id="show_cate" style=" width: 100% ;margin-top: 50px;margin-bottom: 50px;">
                  <h2>List of Photoes</h2>

                  <!-- search form start -->
                      <form method="get">
                        <div class="input-group custom-search-form" style="margin-bottom: 8px;width: 300px;">
                            <input type="text" class="form-control" name="search" placeholder="Search id or title..." value="<?= $search ?>">
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="submit">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                        </div>
                      </form>
                      <!-- search form end -->

                  <table class="table table-bordered" style="">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Thumbnail</th>
                        <th>Photo Title</th>
                        <th>Album Title</th>
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
                        foreach ($data as $photo) {
                          echo '<tr>
                                  <td>'.$i++.'</td>
                                  <td><img src="'.$photo['address'].'" style="width: 100px;"></td>
                                  <td>'.$photo['title'].'</td>                               
                                  <td>'.$photo['album title'].'</td>
                                  <td>'.$photo['created_at'].'</td>
                                  <td>'.$photo['updated_at'].'</td>
                                  <td>'.$photo['game id'].'</td>
                                  <td>'.$photo['game title'].'</td>
                                  <td><button class="btn btn-danger" onclick="del('.$photo['id'].')">Delete</button></td>
                                  <td><button class="btn btn-warning" onclick="edit('.$photo['id'].')">Edit</button></td>
                                </tr>';
                        }
                      ?>
                    </tbody>
                  </table>
                </div>

                <!-- pagination -->
                <div style="text-align: center;"> <?php include_once '../utility/pagination_multi.php'; ?> </div>
             </div>

        </div>
        <!-- end page-wrapper -->

    </div>
    <!-- end wrapper -->

    <script type="text/javascript">
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

      function edit(id){
        if (confirm('Ban co chắc chắc muốn sửa sp này ?') ) {
          window.location.replace("adm_photoes.php?editID="+id);
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

    <?php if ($editID!='') {
         echo '<script type="text/javascript">
                $("document").ready(function(){
                  document.getElementById("create_form").style.display=""
                  document.getElementById("create_btn").style.display="none"
                })
              </script>';
    } ?>
</body>

</html>
