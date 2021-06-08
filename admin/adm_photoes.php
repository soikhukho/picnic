<?php
  require_once '../db/dbhelper.php';
  require_once '../utility/utils.php';

  $selected='adm_photoes';

  $user = checkLogin();
      if ($user=='') {
        header('Location: index.php');
      }

    $alert = '';
  $date = date('Y-m-d H:i:s');
  $title = getPost('title');
  $address=getPost('address');
  $album_id=getPost('album_id');

  $delID= getPost('delID');

  $editID = getGet('editID');
  if ($editID !=''){
        $edit_photo = executeResult("select * from photoes where id = $editID ",true);
        if ($edit_photo=='') {
          header('Location: adm_photoes.php');
        }
    }

  if (!empty($_POST)) {
    //delete
    if ($delID!='') {
        execute("delete from photoes where id = $delID");

         mess('<b>Photo ID='.$delID.'</b> đã bị xóa bởi admin '.$user['fullname'],'adm_photoes.php');

        header('Location: adm_photoes.php');
    }

    //add
    if ($title!='' && $editID =='') {
        execute("insert into photoes(title ,address , album_id, created_at , updated_at)
                   values ('$title','$address' ,$album_id , '$date','$date')");

         mess('<b>Photo '.$title.'</b> đã được thêm bởi admin '.$user['fullname'],'adm_photoes.php');

        echo "<script>
          alert('Bạn đã thêm ảnh thành công')
          window.location.replace('adm_photoes.php')
        </script>";
    }
    //edit
    if ( $title!='' && $editID !=''){
        execute("update photoes set title='$title' ,address='$address' , album_id='$album_id' ,
                      updated_at='$date' where id ='$editID' ");

        mess('<b>Photo '.$title.'(ID='.$editID.')</b> đã được update bởi admin '.$user['fullname'],'adm_photoes.php');

        header('Location: adm_photoes.php');
    }
  }

//pagination form ?page=
$totalItems = executeResult("select count(*) 'count' from photoes join albums 
                                                    on photoes.album_id = albums.id ",true);
  $totalItems = $totalItems['count'];

$href='adm_photoes.php';

$page = getGET('page');
if($page==''){$page = 1;}

$limit  =5;
$totalPages = ceil($totalItems / $limit);
$start = ($page-1) * $limit;

  $data = executeResult("select photoes.id , photoes.title  ,photoes.address,
                                                         albums.title 'album title' ,photoes.created_at ,
                                                        photoes.updated_at 
                                                    from photoes join albums 
                                                    on photoes.album_id = albums.id 
                                                    order by photoes.updated_at desc    limit $start , $limit      ");
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
                          <label>Album</label>
                          <select class="form-control" style="width: 250px;" name="album_id" required="true">
                            <option value="">--chon album--</option>
                              <?php
                                $albums=executeResult("select id , title from albums ");
                                foreach ($albums as $album) {
                                    if ($album['id']!=$edit_photo['album_id']) {
                                        echo '<option value="'.$album['id'].'">'.$album['title'].'</option>';
                                    }else{
                                        echo '<option selected value="'.$album['id'].'">'.$album['title'].'</option>';
                                    }
                                }
                              ?>
                          </select>
                        </div>

                        <center><button class="btn btn-warning" style="font-size: 20px;"><?= (isset($edit_photo))?'Update':'Create'?></button></center>
                      </form>
                    </div>
                  </div>
                </div>
                
                <!-- show photoes -->
                <div id="show_cate" style=" width: 100% ;margin-top: 50px;margin-bottom: 50px;">
                  <h2>List of Photoes</h2>

                  <table class="table table-bordered" style="width: 80%;">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Title</th>
                        <th>Thumbnail</th>
                        <th>Album title</th>
                        <th>Created at</th>
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
                                  <td>'.$photo['title'].'</td>
                                  <td><img src="'.$photo['address'].'" style="width: 160px;"></td>
                                  <td>'.$photo['album title'].'</td>
                                  <td>'.$photo['created_at'].'</td>
                                  <td>'.$photo['updated_at'].'</td>
                                  <td><button class="btn btn-danger" onclick="del('.$photo['id'].')">Delete</button></td>
                                  <td><button class="btn btn-warning" onclick="edit('.$photo['id'].')">Edit</button></td>
                                </tr>';
                        }
                      ?>
                    </tbody>
                  </table>
                </div>

                <!-- pagination -->
                <div style="text-align: center;"> <?php include_once '../utility/pagination.php'; ?> </div>
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
