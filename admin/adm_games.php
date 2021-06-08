<?php
  require_once '../db/dbhelper.php';
  require_once '../utility/utils.php';

  $selected="adm_games";

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
  $cate_id = getPost('cate_id');
  $price = getPost('price');

  $delID= getPost('delID');

  $editID = getGet('editID');

  if ($editID !=''){
        //tránh tình trạng sửa trên url
        $edit_game = executeResult(" select * from games where id = $editID " ,true);

        if ($edit_game=='') {
          header('Location: adm_games.php');
        }
    }

  if (!empty($_POST)) {
    //delete
    if ($delID!='') {
        execute("delete from games where id = $delID");
        mess('<b>Game ID='.$delID.'</b> đã bị xóa bởi admin '.$user['fullname'],'adm_games.php','adm_games.php');
        header('Location: adm_games.php');
    }

    //add
    if ($title!='' && $editID =='') {

        execute("insert into games (title , cate_id,price , thumbnail,description ,content , created_at , updated_at , user_id) 
            values ('$title', '$cate_id', '$price','$thumbnail' ,'$description', '$content','$date','$date', '$user_id')");
        mess('<b>Game '.$title.'</b> đã được tạo mới bởi admin '.$user['fullname'],'adm_games.php');
    
        echo "<script>
          alert('Bạn đã thêm một games mới !')
          window.location.replace('adm_games.php')
        </script>";
    }
    //edit
    if ( $title!='' && $editID !=''){
        execute("update games set title='$title' ,cate_id='$cate_id',price='$price',
                    thumbnail='$thumbnail' ,description='$description' ,content= '$content',
                      updated_at='$date' where id ='$editID' ");

        mess('<b>Game '.$title.'(ID='.$editID.')</b> đã được update bởi admin '.$user['fullname'],'adm_games.php');

        header('Location: adm_games.php');
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
                    <h1 class="page-header">Admintration Games</h1>
                </div>
                <!--End Page Header -->
            </div>

            <div class="row">
                <div style="margin-left: 50px;margin-right: 50px;">

                <!-- form create -->
                <div style=" width:800px;">
                  <button id="create_btn" class="btn" style="background: #04B173;"><h5 style="color: white ;font-weight: bold;">Create / Update</h5>
                  </button>

                  <div id="create_form" class="panel panel-primary" style="display: none;">
                    <div class="panel-heading">
                      <div style="text-align:right;">
                        <button id="close" class="btn btn-primary " style="font-size: 20px;padding: 10px;">X</button>
                      </div>
                      <h3 class="text-center" style="margin-top:-30px;"><?= (isset($edit_game))?'Update this create_forms':'Create new create_forms'?></h3>
                    </div>
                    <div class="panel-body">
                      <form id="create_forms_form" method="post">
                        <span style="color: red"><?= $alert ?></span>
                        
                        <div class="form-group">
                          <label for="title">Title:</label>
                          <input required="true" type="text" class="form-control" id="title" name="title" 
                                  value="<?=(isset($edit_game))?$edit_game['title']:'' ?>" >
                        </div>

                        <div class="form-group">
                          <label for="title">Category:</label>
                          <select class="form-control" style="width: 250px;" name="cate_id">
                            <option value="">--chon danh muc game--</option>
                              <?php
                                $category=executeResult("select * from category");
                                foreach ($category as $category) {
                                    if ($category['id']!=$edit_game['cate_id']) {
                                        echo '<option value="'.$category['id'].'">'.$category['title'].'</option>';
                                    }else{
                                        echo '<option selected value="'.$category['id'].'">'.$category['title'].'</option>';
                                    }
                                }
                              ?>
                          </select>
                        </div>

                        <div class="form-group">
                          <label for="price">Price:</label>
                          <input required="true" type="number" class="form-control" id="price" name="price" 
                                  value="<?=(isset($edit_game))?$edit_game['price']:'' ?>" >
                        </div>

                        <div class="form-group">
                          <label for="thumbnail">Thumbnail:</label>
                          <input required="true" type="text" class="form-control" id="thumbnail" name="thumbnail" 
                                  value="<?=(isset($edit_game))?$edit_game['thumbnail']:'' ?>" >
                        </div>

                        <div class="form-group">
                          <label for="description">Description:</label>
                          <input required="true" type="text" class="form-control" id="description" name="description" 
                                  value="<?=(isset($edit_game))?$edit_game['description']:'' ?>" >
                        </div>

                        <div class="form-group">
                          <label for="content">Content:</label>                  
                          <textarea class="form-control" id="content" name="content"><?=(isset($edit_game))?$edit_game['content']:'' ?></textarea>
                        </div>

                        <center><button class="btn btn-warning" style="font-size: 20px;"><?= (isset($edit_game))?'Update':'Create'?></button></center>
                      </form>
                    </div>
                  </div>
                </div>
                <!-- form create end -->
                
                <!-- show games -->
                <div id="show_cate" style="margin-top: 50px;margin-bottom: 50px;">
                  <h2>List of Games</h2>

                  <table class="table table-bordered" style=" margin: 0px auto;">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Thumbnail</th>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Ticket Price</th>
                        <th>Created by</th>
                        <th></th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                        $create_forms = executeResult(" select games.id ,games.title 'game title',
                                                        category.title 'category title' ,
                                                        games.thumbnail ,games.price , users.fullname
                                                    from games ,  category , users
                                                    where games.cate_id = category.id 
                                                    and  games.user_id = users.id
                                                    ORDER by games.updated_at desc ");
                        $i=1;
                        foreach ($create_forms as $item) {
                          echo '<tr>
                                  <td>'.$i++.'</td>
                                  <td><img src="'.$item['thumbnail'].'" style="width: 150px;"></td>
                                  <td>'.$item['game title'].'</td>
                                  <td>'.$item['category title'].'</td>
                                  <td>'.$item['price'].'</td>
                                  <td>'.$item['fullname'].'</td>
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
                  $.post('adm_games.php',
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
                  window.location.replace("adm_games.php?editID="+id);
                }
              }

              $('#content').summernote();

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
        </div>
        <!-- end page-wrapper -->

    </div>
    <!-- end wrapper -->

</body>

</html>
