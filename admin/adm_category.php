<?php
  require_once '../db/dbhelper.php';
  require_once '../utility/utils.php';

  $selected='adm_category';

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
          header('Location: adm_category.php');
        }
    }

  if (!empty($_POST)) {
    //delete
    if ($delID!='') {
        execute("delete from category where id = $delID");
        mess('<b>Danh mục ID='.$delID.'</b> đã bị xóa bởi admin '.$user['fullname'],'adm_category.php');
        header('Location: adm_category.php');
    }

    //add
    if ($title!='' && $editID =='') {
        execute("insert into category(title , created_at , updated_at) values ('$title','$date','$date')");

        mess('<b>Danh mục '.$title.'</b> đã được tạo bởi admin '.$user['fullname'],'adm_category.php');
        echo "<script>
          alert('Ban da them danh muc thanh cong')
          window.location.replace('adm_category.php')
        </script>";
    }
    //edit
    if ( $title!='' && $editID !=''){
        execute("update category set title='$title' , updated_at='$date' where id ='$editID' ");
        mess('<b>Danh mục '.$title.'</b> đã được update bởi admin '.$user['fullname'],'adm_category.php');
        header('Location: adm_category.php');
    }
  }

  //pagination
  $totalItems = executeResult("select count(*) 'count' from category ",true);
  $totalItems = $totalItems['count'];

  $href='adm_category.php';

  $page = getGET('page');
  if($page==''){$page = 1;}

  $limit  =5;
  $totalPages = ceil($totalItems / $limit);
  $start = ($page-1) * $limit;

  $data = executeResult("select * from category order by updated_at desc  limit $start , $limit ");

  $cate = $data;
?>

<!DOCTYPE html>
<html>

<head>
    <title>adm category</title>
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
                    <h1 class="page-header">Admintrations Category</h1>
                </div>
                <!--End Page Header -->
            </div>

            <div  class="row">

                <!-- form create -->
                <div style=" width:500px;margin-left: 50px;">

                  <button id="create_btn" class="btn" style="background: #04B173;"><h5 style="color: white ;font-weight: bold;">Create / Update</h5>
                  </button>

                  <div id="create_form"  class="panel panel-primary" style="display: none;">
                    <div class="panel-heading">
                      <div style="text-align:right;">
                        <button id="close" class="btn btn-primary " style="font-size: 20px;padding: 10px;">X</button>
                      </div>
                      <h2 class="text-center" style="margin-top:-30px;"><?= (isset($edit_cate))?'Update this Category':'Create new Category'?></h2>
                    </div>
                    <div class="panel-body">
                      <form method="post">
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
                <!-- form creat end -->
                
                <!-- show category -->
                <div id="show_cate" style="margin: 50px;">

                  <h2 >List of Category</h2>

                  <table class="table table-bordered" style="width: 60%;">
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
                        
                        $i=$limit*($page-1)+1;
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

                  <div style="width: 60%; text-align: center;"> <?php include_once '../utility/pagination.php'; ?> </div>
                </div>
             </div>

        </div>
        <!-- end page-wrapper -->

    </div>
    <!-- end wrapper -->

    <script type="text/javascript">
      function del(id){
        if (confirm('Ban co chắc chắc muốn xóa sp này ?') ) {
          $.post('adm_category.php',
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
        if (confirm('Ban co chắc chắc muốn sửa danh mục này ?') ) {
          window.location.replace("adm_category.php?editID="+id);
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
