<?php
  require_once 'db/dbhelper.php';
  require_once 'utility/utils.php';

  $user = checkLogin();
  if ($user=='' || $user['email']!='soikhukho@gmail.com') {
    header('Location: index.php');
  }

  $active = getPost('active');
  $delID= getPost('delID');

  if (!empty($_POST)) {
    //delete
    if ($delID!='') {
        execute("delete from users where id = $delID");
        header('Location: category.php');
    }

    //add
    if ($active!='') {
      $user=executeResult("select * from users where id=$active",true);
        if ($user['active']==1) {
          execute("update users set active=0 where id= $active");
        }else{execute("update users set active=1 where id= $active");}
    }
        
  }
?>

<!DOCTYPE html>
<html>
<head>
  <title>Users</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <!-- include summernote css/js -->
  <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote.css" rel="stylesheet">
  <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote.js"></script>
  <link rel="stylesheet" type="text/css" href="style/style.css">
  <link rel="stylesheet" type="text/css" href="style/toogle_switch.css">
</head>
<body>
    <?php
        include 'layout/header.php';
     ?>
     <div class="container">
        
        <!-- show category -->
        <div id="show_cate" style="margin-top: 50px;margin-bottom: 50px;">
          <h2 style="text-align: center;">User List</h2>
          <table class="table table-bordered" style="width: 800px;margin: 0px auto;">
            <thead>
              <tr>
                <th>No</th>
                <th>Fullname</th>
                <th>Phone No</th>
                <th>Email</th>
                <th>Active</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              <?php
                $userList = executeResult("select * from users");
                $i=1;
                foreach ($userList as $user) {
                  if ($user['active']==1) {
                    echo '<tr>
                          <td>'.$i++.'</td>
                          <td>'.$user['fullname'].'</td>
                          <td>'.$user['phone_no'].'</td>
                          <td>'.$user['email'].'</td>
                          <td>
                            <label class="switch">
                            <input type="checkbox" checked onclick="active('.$user['id'].')">
                            <span class="slider round"></span>
                          </label>
                          </td>
                          <td><button class="btn btn-danger" onclick="del('.$user['id'].')">Delete</button></td>
                        </tr>';
                  }else{
                    echo '<tr>
                          <td>'.$i++.'</td>
                          <td>'.$user['fullname'].'</td>
                          <td>'.$user['phone_no'].'</td>
                          <td>'.$user['email'].'</td>
                          <td>
                            <label class="switch">
                            <input type="checkbox" onclick="active('.$user['id'].')">
                            <span class="slider round"></span>
                          </label>
                          </td>
                          <td><button class="btn btn-danger" onclick="del('.$user['id'].')">Delete</button></td>
                        </tr>';
                  }
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

      function active(id){
        $.post ('users.php',{active:id},function(data){
          location.reload()
        })
      }
    </script>
    <?php include 'layout/footer.php'; ?>
</body>
</html>
