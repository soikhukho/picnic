<?php
  require_once '../db/dbhelper.php';
  require_once '../utility/utils.php';

  require_once 'php_form_admin/form_places.php';
?>

<!DOCTYPE html>
<html>

<head>
    <title>adm places</title>
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
                    <h1 class="page-header">Admintration Places</h1>
                </div>
                <!--End Page Header -->
            </div>

            <div class="row" style="margin-left: 50px;margin-right: 50px;">

                  <!-- form create -->
                  <div >
                    <button id="create_btn" class="btn" style="background: #04B173;"><h5 style="color: white ;font-weight: bold;">Add new / Update</h5>
                    </button>

                    <div id="place" class="panel panel-primary" style="display: none;">
                      <div class="panel-heading">
                        <div style="text-align:right;">
                          <button id="close" class="btn btn-primary " style="font-size: 20px;padding: 10px;">X</button>
                        </div>
                        <h3 class="text-center" style="margin-top:-30px;"><?= (isset($edit_place))?'Update this places':'Add a new places'?></h3>
                      </div>
                      <div class="panel-body">
                        <form id="places_form" method="post">
                          <span style="color: red"><?= $alert ?></span>
                          
                          <div class="form-group">
                            <label for="title">Title:</label>
                            <input required="true" type="text" class="form-control" id="title" name="title" 
                                    value="<?=(isset($edit_place))?$edit_place['title']:'' ?>" >
                          </div>

                          <div class="form-group">
                            <label for="thumbnail">Thumbnail:</label>
                            <input required="true" type="text" class="form-control" id="thumbnail" name="thumbnail" 
                                    value="<?=(isset($edit_place))?$edit_place['thumbnail']:'' ?>" >
                          </div>

                          <div class="form-group">
                            <label for="description">Description:</label>
                            <input required="true" type="text" class="form-control" id="description" name="description" 
                                    value="<?=(isset($edit_place))?$edit_place['description']:'' ?>" >
                          </div>

                          <div class="form-group">
                            <label for="content">Content:</label>                  
                            <textarea class="form-control" id="content" name="content"><?=(isset($edit_place))?$edit_place['content']:'' ?></textarea>
                          </div>

                          <center><button class="btn btn-warning" style="font-size: 20px;"><?= (isset($edit_place))?'Update':'Add'?></button></center>
                        </form>
                      </div>
                    </div>
                  </div>
                  
                  <!-- show places -->
                  <div id="show_places" style="width: 100%; margin-top:10px;margin-bottom: 50px;">
                    <h2 >List of Beauty places</h2>

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

                    <table class="table table-bordered" >
                      <thead>
                        <tr>
                          <th>No</th>
                          <th>Title</th>
                          <th>Thumbnail</th>
                          
                          <th>Created At</th>
                          <th>Updated At</th>
                          <th></th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                          
                          $i=$limit*($page-1)+1;
                          foreach ($data as $item) {
                            echo '<tr>
                                    <td>'.$i++.'</td>
                                    <td><b><i>'.$item['title'].'</b></i></td>
                                    <td><img src="'.$item['thumbnail'].'" style="width: 150px;"></td>
                                    <td>'.$item['created_at'].'</td>
                                    <td>'.$item['updated_at'].'</td>
                                    <td><button class="btn btn-danger" onclick="del('.$item['id'].')">Delete</button></td>
                                    <td><button class="btn btn-warning" onclick="edit('.$item['id'].')">Edit</button></td>
                                  </tr>';
                          }
                        ?>
                      </tbody>
                    </table>
                  </div>

                  <!-- pagination -->
                  <div style="text-align: center;"> <?php include_once '../utility/pagination_multi.php'; ?> </div>

               <script type="text/javascript">
                function del(id){
                  if (confirm('Ban co chắc chắc muốn xóa sp này ?') ) {
                    $.post('adm_places.php',
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
                    window.location.replace("adm_places.php?editID="+id);
                  }
                }

                $('#content').summernote();

                $('#create_btn').click(function(){
                  document.getElementById('place').style.display=""
                  document.getElementById('create_btn').style.display="none"
                })
                 $("#close").click(function(){
                       document.getElementById('place').style.display="none"
                       document.getElementById('create_btn').style.display=""  
                    })
              </script>

              <?php if ($editID!='') {
                   echo '<script type="text/javascript">
                          $("document").ready(function(){
                            document.getElementById("place").style.display=""
                            document.getElementById("create_btn").style.display="none"
                          })
                        </script>';
              } ?>
        </div>
        <!-- end page-wrapper -->

    </div>
    <!-- end wrapper -->

</body>

</html>
