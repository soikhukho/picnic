<?php
  require_once '../db/dbhelper.php';
  require_once '../utility/utils.php';

  require_once 'php_form_admin/form_users.php';

?>

<!DOCTYPE html>
<html>

<head>
    <title>adm users</title>
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
    <link rel="stylesheet" type="text/css" href="../style/toogle_switch.css">

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
                    <h1 class="page-header">Admintrations Users</h1>
                </div>
                <!--End Page Header -->
            </div>

            <div class="row" style="margin-left: 50px;margin-right: 50px;">
                      <!-- hiden form  -->
                      <div id="update_pwd">
                        
                      </div>
                        
                        <!-- show users -->
                        <div id="show_users" style="margin-top: 50px;margin-bottom: 50px;">

                          <h2 style="">User List</h2>

                          <!-- search form start -->
                          <form method="get">
                            <div class="input-group custom-search-form" style="margin-bottom: 8px;width: 300px;">
                                <input type="text" class="form-control" name="search" placeholder="Search email or fullname..." value="<?= $search ?>">
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
                                <th>Fullname</th>
                                <th>Avatar</th>
                                <th>Phone No</th>
                                <th>Email</th>
                                <th>Last update</th>
                                <th>Total Post</th>
                                <th>Reset Pwd</th>
                                <th>Active</th>
                                <th></th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php


                                echo '<tr>
                                          <td>0</td>
                                          <td>'.$vip['fullname'].'</td>
                                          <td><img src="'.$vip['avatar'].'" style="width: 68px;"></td>
                                          <td>'.$vip['phone_no'].'</td>
                                          <td>'.$vip['email'].'</td>
                                          <td>'.$vip['updated_at'].'</td>
                                          <td><b>'.total_post(1).'</b></td>
                                          <td><button class="btn btn-warning" onclick="update_pwd('.$vip['id'].')">Reset Pass</button></td>
                                          <td>
                                              VIP
                                          </td>
                                          <td></td>
                                        </tr>';
                                
                                $i=$limit*($page-1)+1;
                                foreach ($data as $user) {

                                  $total_post = total_post($user['id']);

                                  if ($user['email']!='picnic@gmail.com') {
                                      if ($user['active']==1) {
                                    echo '<tr>
                                          <td>'.$i++.'</td>
                                          <td>'.$user['fullname'].'</td>
                                          <td><img src="'.$user['avatar'].'" style="width: 68px;"></td>
                                          <td>'.$user['phone_no'].'</td>
                                          <td>'.$user['email'].'</td>
                                          <td>'.$user['updated_at'].'</td>
                                          <td><b>'.$total_post.'</b></td>
                                          <td><button class="btn btn-warning" onclick="update_pwd('.$user['id'].')">Reset Pass</button></td>
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
                                          <td><img src="'.$user['avatar'].'" style="width: 68px;"></td>
                                          <td>'.$user['phone_no'].'</td>
                                          <td>'.$user['email'].'</td>
                                          <td>'.$user['updated_at'].'</td>
                                          <td><b>'.$total_post.'</b></td>
                                          <td><button class="btn btn-warning" onclick="update_pwd('.$user['id'].')">Reset Pass</button></td>
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
                                   
                                  }
                                  
                              ?>
                            </tbody>
                          </table>

            </div>
            <!-- pagination -->
            <div style="text-align: center;"> <?php include_once '../utility/pagination_multi.php'; ?> </div>
            
         </div>
        <!-- end page-wrapper -->

    </div>
   <script type="text/javascript">
      function del(id){
        if (confirm('Ban co chắc chắc muốn xóa admin này ?') ) {
          $.post('adm_users.php',{delID:id},
                  function(data){
                                  location.reload()
                                }
            )
        }
      }

      function update_pwd(id){
        if (confirm('Ban co chắc chắc muốn update ?') ) {
          $.post('update_pwd.php',{updateID:id},
                  function(data){
                                  $('#update_pwd').html(data)
                                  $('#pwd').focus()
                                }
            )
        }
      }

      function active(id){
        $.post ('adm_users.php',{active:id},function(data){
          location.reload()
        })
      }

      $('#update_pwd').submit(function(){
          if ($('#pwd').val() != $('#cf_pwd').val()) {
            alert('Password chua khop nhau')
            $('#pwd').val('')
            $('#cf_pwd').val('')
            $('#pwd').focus()
            return false;
          }else{
            alert('Ban da update thanh cong')
          }
      })

    </script> 
</body>

</html>
