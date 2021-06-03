<?php
  require_once 'db/dbhelper.php';
  require_once 'utility/utils.php';
  
  $selected='adm_albums';
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
  $game_id = getPost('game_id');

  $delID= getPost('delID');

  $editID = getGet('editID');

  if ($editID !=''){
        //tránh tình trạng typing vào url
        $edit_album = executeResult(" select * from albums where id = $editID " ,true);

        if ($edit_album=='') {
          header('Location: adm_albums.php');
        }
    }

  if (!empty($_POST)) {
    //delete
    if ($delID!='') {
        execute("delete from photoes where album_id = $delID");
        execute("delete from albums where id = $delID");

        mess('<b>Album có ID='.$delID.'</b> đã bị xóa bỏi admin '.$user['fullname'],'adm_albums.php');

        header('Location: adm_albums.php');
    }

    //add
    if ($title!='' && $editID =='') {

        execute("insert into albums (title , game_id , thumbnail,description ,created_at , updated_at ) 
            values ('$title', '$game_id' ,'$thumbnail' ,'$description', '$date','$date')");

        mess('<b>Album '.$title.'</b> đã được tạo bỏi admin '.$user['fullname'],'adm_albums.php');

        echo "<script>
          alert('Bạn đã thêm một albums mới !')
          window.location.replace('adm_albums.php')
        </script>";
    }
    //edit
    if ( $title!='' && $editID !=''){
        execute("update albums set title='$title' ,game_id='$game_id',
                    thumbnail='$thumbnail' ,description='$description' ,
                      updated_at='$date' where id ='$editID' ");

        mess('<b>Album '.$title.'</b> đã được update bởi admin '.$user['fullname'],'adm_albums.php');

        header('Location: adm_albums.php');
    }
  }
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
                    <h1 class="page-header">Admintration Albums</h1>
                </div>
                <!--End Page Header -->
            </div>

            <div class="row">
                <div class="">
        <!-- form create -->

        <div style=" width:800px;margin: 0px auto;">
          <button id="place_btn" class="btn" style="background: #04B173;"><h5 style="color: white ;font-weight: bold;">Create / Update</h5><small>(Click here)</small></button>
          <div id="place" class="panel panel-primary" style="display:none; ;">
            <div class="panel-heading">
              <div style="text-align:right;">
                <button id="close" class="btn btn-primary " style="font-size: 20px;padding: 10px;">X</button>
              </div>
              <h3 class="text-center" style="margin-top:-30px;"><?= (isset($edit_album))?'Update this Album':'Create a new Album'?></h3>
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
                  <label for="game_id">Game</label>
                  <select class="form-control" style="width: 250px;" name="game_id">
                    <option value="">--chon game--</option>
                      <?php
                        $games=executeResult("select id , title from games");
                        foreach ($games as $game) {
                            if ($game['id']!=$edit_album['game_id']) {
                                echo '<option value="'.$game['id'].'">'.$game['title'].'</option>';
                            }else{
                                echo '<option selected value="'.$game['id'].'">'.$game['title'].'</option>';
                            }
                        }
                      ?>
                  </select>
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

                <center><button class="btn btn-warning" style="font-size: 20px;"><?= (isset($edit_album))?'Update':'Create'?></button></center>
              </form>
            </div>
          </div>
        </div>
        
        <!-- show albums -->
        <div id="show_cate" style="margin-top: 50px;margin-bottom: 50px;">
          <h2 style="text-align: center;">List of Albums </h2>
          <table class="table table-bordered" style=" margin: 0px auto;">
            <thead>
              <tr>
                <th>No</th>
                <th>Album Title</th>
                <th>Thumbnail</th>
                <th>Game Title</th>
                <th>Category of Game </th>
                <th>Updated at</th>
                <th>Total photoes</th>
                <th></th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              <?php
                $albums = executeResult(" select albums.id ,albums.title 'albums title' ,albums.thumbnail, games.title 'games title',category.title 'category title',games.updated_at
                                          from albums , games , category
                                          where albums.game_id = games.id and games.cate_id = category.id 

                                            order by albums.updated_at desc
                                          ");
                $i=1;
                foreach ($albums as $album) {

                  $album_id = $album['id'] ;
                  $total = executeResult("select count(*) 'total' from photoes where album_id ='$album_id' " , true);
                  $total = $total['total'];

                  echo '<tr>
                          <td>'.$i++.'</td>
                          <td>'.$album['albums title'].'</td>
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
