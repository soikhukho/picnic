<?php
  require_once 'db/dbhelper.php';
  require_once 'utility/utils.php';

  $user = checkLogin();
  if ($user=='') {
    header('Location: index.php');
  }

  $alert = '';
  $date = date('Y-m-d H:i:s');
  $title = getPost('title');
  $delID= getPost('delID');

  $editID = getGet('editID');
  if ($editID !=''){
        $edit_cate = executeResult("select * from category where id = $editID ",true);
        if ($edit_cate=='') {
          header('Location: category.php');
        }
    }

  if (!empty($_POST)) {
    //delete
    if ($delID!='') {
        execute("delete from category where id = $delID");
        header('Location: category.php');
    }

    //add
    if ($title!='' && $editID =='') {
        execute("insert into category(title , created_at , updated_at) values ('$title','$date','$date')");
        echo "<script>
          alert('Ban da them danh muc thanh cong')
          window.location.replace('category.php')
        </script>";
    }
    //edit
    if ( $title!='' && $editID !=''){
        execute("update category set title='$title' , updated_at='$date' where id ='$editID' ");
        header('Location: category.php');
    }
  }
?>

<!DOCTYPE html>
<html>
<head>
  <title>Category</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <!-- include summernote css/js -->
  <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote.css" rel="stylesheet">
  <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote.js"></script>
  <link rel="stylesheet" type="text/css" href="style/style.css">
</head>
<body>
    <?php
        include 'layout/header.php';
     ?>
     <div class="container">
        <!-- form create -->
        <div style=" width:600px;margin: 0px auto; margin-top: 50px;">
          <div class="panel panel-primary">
            <div class="panel-heading">
              <h2 class="text-center">Category form</h2>
            </div>
            <div class="panel-body">
              <form id="signup_form" method="post">
                <span style="color: red"><?= $alert ?></span>
                
                <div class="form-group">
                  <label for="title">Title:</label>
                  <input required="true" type="text" class="form-control" id="title" name="title" value="<?= (isset($edit_cate))?$edit_cate['title']:''?>">
                </div>

                <center><button class="btn btn-warning" style="font-size: 20px;"><?= (isset($edit_cate))?'Update':'Create'?></button></center>
              </form>
            </div>
          </div>
        </div>
        
        <!-- show category -->
        <div id="show_cate" style="margin-top: 50px;margin-bottom: 50px;">
          <h2 style="text-align: center;">List of Category</h2>
          <table class="table table-bordered" style="width: 800px;margin: 0px auto;">
            <thead>
              <tr>
                <th>No</th>
                <th>Title</th>
                <th></th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              <?php
                $cate = executeResult("select * from category order by updated_at desc          ");
                $i=1;
                foreach ($cate as $item) {
                  echo '<tr>
                          <td>'.$i++.'</td>
                          <td>'.$item['title'].'</td>
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
          $.post('category.php',
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
          window.location.replace("category.php?editID="+id);
        }
      }
    </script>
    <?php include 'layout/footer.php'; ?>
</body>
</html>
