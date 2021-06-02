<?php
  require_once 'db/dbhelper.php';
  require_once 'utility/utils.php';

  $user = checkLogin();
      if ($user=='') {
        header('Location: index.php');
      }
$user_id=$user['id'];

  $alert = '';
  $date = date('Y-m-d H:i:s');
  $title = getPost('title');
  $thumbnail =getPost('thumbnail');
  $description =getPost('description');
  $content =getPost('content');

  $delID= getPost('delID');

  $editID = getGet('editID');
  if ($editID !=''){
       
        $edit_place = executeResult("select * from places where id = $editID order by updated_at desc",true);
        if ($edit_place=='') {
          header('Location: adm_places.php');
        }
    }

  if (!empty($_POST)) {
    //delete
    if ($delID!='') {
        execute("delete from places where id = $delID");
        header('Location: adm_places.php');
    }

    //add
    if ($title!='' && $editID =='') {
        execute("insert into places (title , thumbnail,description ,content , created_at , updated_at , user_id) 
            values ('$title','$thumbnail' ,'$description', '$content','$date','$date', '$user_id')");
    
        echo "<script>
          alert('Bạn đã thêm một Places mới !')
          window.location.replace('adm_places.php')
        </script>";
    }
    //edit
    if ( $title!='' && $editID !=''){
        execute("update places set title='$title' ,thumbnail='$thumbnail' ,description='$description' ,content= '$content',
                      updated_at='$date' where id ='$editID' ");
        header('Location: adm_places.php');
    }
  }
?>

<!DOCTYPE html>
<html>

<head>
    <title>adm games</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <!-- include summernote css/js -->
    <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote.css" rel="stylesheet">
    <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote.js"></script>

    <link href="assets/plugins/bootstrap/bootstrap.css" rel="stylesheet" />
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/plugins/pace/pace-theme-big-counter.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet" />
    <link href="assets/css/main-style.css" rel="stylesheet" />

</head>

<body>
    <div id="wrapper">
        <!-- navbar  -->
        <?php 
            include_once 'layout/admin_navbar_top.php';
            include_once 'layout/admin_navbar_side.php';
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

            <div class="row">
                <div class="container">
        <!-- form create -->

        <div style=" width:800px;margin: 0px auto;">
          <button id="place_btn" class="btn" style="background: #04B173;"><h5 style="color: white ;font-weight: bold;">Create / Update</h5><small>(Click here)</small></button>
          <div id="place" class="panel panel-primary" style="display: none;">
            <div class="panel-heading">
              <div style="text-align:right;">
                <button id="close" class="btn btn-primary " style="font-size: 20px;padding: 10px;">X</button>
              </div>
              <h3 class="text-center" style="margin-top:-30px;"><?= (isset($edit_place))?'Update this places':'Create new places'?></h3>
            </div>
            <div class="panel-body">
              <form id="places_form" method="post">
                <span style="color: red"><?= $alert ?></span>
                
                <div class="form-group">
                  <label for="title">Title :</label>
                  <input type="text" name="id" value="<?=$id?>" hidden="true">
                  <input required="true" type="text" class="form-control" id="title" name="title" value="<?=$title?>">
                </div>
                <div class="form-group">
                  <label for="thumbnail">Thumbnail:</label>
                  <input required="true" type="text" class="form-control" id="thumbnail" name="thumbnail" value="<?=$thumbnail?>" >
                </div>
                <div class="form-group">
                  <label for="price">Price :</label>
                  <input required="true" type="number" class="form-control" id="price" name="price" value="<?=$price?>" >
                </div>
                <div class="form-group">
                  <label for="description">description :</label>
                  <input required="true" type="text" class="form-control" id="description" name="description" value="<?=$description?>" >
                </div>
                <div class="form-group">
                  <label for="cate_id"> Game Selection</label>
                  <select class="form-control" name="cate_id" id="cate_id">
                    <option>Lựa chọn thể loại</option>
      <?php
      $sql          = 'select * from category';
      $categoryList = executeResult($sql);

      foreach ($categoryList as $item) {
        if ($item['id'] == $cate_id) {
          echo '<option selected value="'.$item['id'].'">'.$item['title'].'</option>';
        } else {
          echo '<option value="'.$item['id'].'">'.$item['title'].'</option>';
        }
      }
      ?>
                  </select>
                </div>

                <div class="form-group">
                  <label for="content">Content:</label>                  
                  <textarea class="form-control" id="content" name="content"><?=(isset($edit_place))?$edit_place['content']:'' ?></textarea>
                </div>

                <center><button class="btn btn-warning" style="font-size: 20px;"><?= (isset($edit_place))?'Update':'Create'?></button></center>
              </form>
            </div>
          </div>
        </div>
        
        <!-- show places -->
        <div id="show_cate" style="margin-top: 50px;margin-bottom: 50px;">
          <h2 style="text-align: center;">List of places</h2>
          <table class="table table-bordered" style="width: 800px;margin: 0px auto;">
            <thead>
              <tr>
                <th>No</th>
                <th>Title</th>
                <th>Thumbnail</th>
                <th></th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              <?php
                $places = executeResult("select * from places order by updated_at desc ");
                $i=1;
                foreach ($places as $item) {
                  echo '<tr>
                          <td>'.$i++.'</td>
                          <td>'.$item['title'].'</td>
                          <td><img src="'.$item['thumbnail'].'" style="width: 150px;"></td>
                          <td><button class="btn btn-danger" onclick="del('.$item['id'].')">Delete</button></td>
                          <td><button class="btn btn-warning" onclick="edit('.$item['id'].')">Edit</button></td>
                        </tr>';
                }
              ?>
            </tbody>
          </table>
        </div>
     </div>


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

      $('#place_btn').click(function(){
        document.getElementById('place').style.display=""
        document.getElementById('place_btn').style.display="none"
      })
       $("#close").click(function(){
             document.getElementById('place').style.display="none"
             document.getElementById('place_btn').style.display=""  
          })
    </script>

    <?php if ($editID!='') {
         echo '<script type="text/javascript">
                $("document").ready(function(){
                  document.getElementById("place").style.display=""
                  document.getElementById("place_btn").style.display="none"
                })
              </script>';
    } ?>
        </div>
        <!-- end page-wrapper -->

    </div>
    <!-- end wrapper -->

</body>

</html>
