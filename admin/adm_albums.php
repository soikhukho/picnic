<?php
  require_once '../db/dbhelper.php';
  require_once '../utility/utils.php';

  require_once 'php_form_admin/form_albums.php';

?>

<!DOCTYPE html>
<html>

<head>
    <title>adm albums</title>
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

    <link rel="stylesheet" type="text/css" href="../style/style_form_search.css">

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
                    <h1 class="page-header">Admintration Albums</h1>
                </div>
                <!--End Page Header -->
            </div>

            <div class="row">
                <div style="margin-left: 50px;margin-right: 50px;">
                    
                  <!-- form create start-->
                  <div style="">

                      <button id="creat_btn" class="btn btn-warning"><h4 style="color: grey ;font-weight: bold;">Add new / Update</h5>
                      </button>

                      <div id="creat_form" class="panel panel-primary" style="display:none; ;">
                        <div class="panel-heading">
                          <div style="text-align:right;">
                            <button id="close" class="btn btn-primary " style="font-size: 20px;padding: 10px;">X</button>
                          </div>
                          <h3 class="text-center" style="margin-top:-30px;"><?= (isset($edit_album))?'Update this Album':'Add a new Album'?></h3>
                        </div>
                        <div class="panel-body">
                          <form id="album_form" method="post">
                            <span style="color: red"><?= $alert ?></span>
                            
                            <div class="form-group">
                              <label for="title">Title:</label>
                              <input required="true" type="text" class="form-control" id="title" name="title" 
                                      value="<?=(isset($edit_album))?$edit_album['title']:'' ?>" >
                            </div>

                            <div class="form-group">
                              <label for="game_id">Game ID</label>
                              <input type="text" name="game_id" list="game_list" class="form-control" placeholder="tim theo ten hoac id" value="<?=(isset($edit_album))?$edit_album['game_id']:'' ?>">
                                <datalist id="game_list">

                                  <?php
                                    $game_list=executeResult("select id, title from games");
                                    foreach ($game_list as $game) {

                                      echo '<option value="'.$game['id'].'">'.$game['title'].'</option>';
                                    }
                                  ?>
                                </datalist>
                            </div>

                            <div class="form-group">
                              <label for="thumbnail">Thumbnail:</label>
                              <input required="true" type="text" class="form-control" id="thumbnail" name="thumbnail" 
                                      value="<?=(isset($edit_album))?$edit_album['thumbnail']:'' ?>" >
                            </div>

                            <div class="form-group">
                              <label for="description">Description:</label>
                              <input required="true" type="text" class="form-control" id="description" name="description" 
                                      value="<?=(isset($edit_album))?$edit_album['description']:'' ?>" >
                            </div>

                            <center><button class="btn btn-warning" style="font-size: 20px;"><?= (isset($edit_album))?'Update':'Add new'?></button></center>
                          </form>
                        </div>
                      </div>
                    </div>
                    <!-- form create end-->
        
                    <!-- show albums start -->
                    <div id="show_albums" style="margin-top: 50px;margin-bottom: 50px;">
                      <h2 >Albums List :</h2>

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

                      <table class="table table-bordered" style=" margin: 0px auto;">
                        <thead>
                          <tr>
                            <th>No</th>
                            <th>Album Title</th>
                            <th>Album ID</th>
                            <th>Thumbnail</th>
                            <th>Game Title</th>
                            <th>Game Category</th>
                            <th>Updated at</th>
                            <th>Total photoes</th>
                            <th></th>
                            <th></th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                            
                            $i=$limit*($page-1)+1;
                            foreach ($data as $album) {

                              $album_id = $album['id'] ;
                              $total = executeResult("select count(*) 'total' from photoes where album_id ='$album_id' " , true);
                              $total = $total['total'];

                              echo '<tr>
                                      <td>'.$i++.'</td>
                                      <td><a href="adm_album_details.php?album_id='.$album['id'].'"><b>'.$album['albums title'].'</b></a></td>
                                      <td>'.$album['id'].'</td>
                                      <td><img src="'.$album['thumbnail'].'" style="width: 150px;"></td>
                                      <td>'.$album['games title'].'</td>
                                      <td>'.$album['category title'].'</td>
                                      <td>'.$album['updated_at'].'</td>
                                      <td><b>'.$total.'</b></td>
                                      <td><button class="btn btn-danger" onclick="del('.$album['id'].')">Delete</button></td>
                                      <td><button class="btn btn-warning" onclick="edit('.$album['id'].')">Edit</button></td>
                                    </tr>';
                            }
                          ?>
                        </tbody>
                      </table>
                    </div>
                    <!-- show album end -->

                    <!-- pagination -->
                    <div style="text-align: ;"> <?php include_once '../utility/pagination_multi.php'; ?> </div>

                </div>


    <script type="text/javascript">
      function del(id){
        if (confirm('Ban co chắc chắc muốn xóa album này ?') ) {
          $.post('adm_albums.php',
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
        if (confirm('Ban co chắc chắc muốn sửa game này ?') ) {
          window.location.replace("adm_albums.php?editID="+id);
        }
      }

      $('#content').summernote();

      $('#creat_btn').click(function(){
        document.getElementById('creat_form').style.display=""
        document.getElementById('creat_btn').style.display="none"
      })
       $("#close").click(function(){
             document.getElementById('creat_form').style.display="none"
             document.getElementById('creat_btn').style.display=""  
          })
    </script>

    <?php if ($editID!='') {
         echo '<script type="text/javascript">
                $("document").ready(function(){
                  document.getElementById("creat_form").style.display=""
                  document.getElementById("creat_btn").style.display="none"
                })
              </script>';
    } ?>


        </div>
        <!-- end page-wrapper -->

    </div>
    <!-- end wrapper -->

</body>

</html>
