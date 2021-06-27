<?php
  require_once '../db/dbhelper.php';
  require_once '../utility/utils.php';

  require_once 'php_form_admin/form_games.php';
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
                <div style="">
                  <button id="create_btn" class="btn" style="background: #04B173;"><h5 style="color: white ;font-weight: bold;">Add new / Update</h5>
                  </button>

                  <div id="create_form" class="panel panel-primary" style="display: none;">
                    <div class="panel-heading">
                      <div style="text-align:right;">
                        <button id="close" class="btn btn-primary " style="font-size: 20px;padding: 10px;">X</button>
                      </div>
                      <h3 class="text-center" style="margin-top:-30px;"><?= (isset($edit_game))?'Update this Game':'Add a new Game'?></h3>
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

                        <center><button class="btn btn-warning" style="font-size: 20px;"><?= (isset($edit_game))?'Update':'Add'?></button></center>
                      </form>
                    </div>
                  </div>
                </div>
                <!-- form create end -->
                
                <!-- show games -->

                <div id="show_cate" style="margin-top: 50px;margin-bottom: 50px;">
                  <div style="margin-bottom: 20px;">
                    <span style="font-weight: bold;font-size: 30px; "> List of Games : </span>
                    <select id="select_status">
                      <option value="0" <?=($game_status==0)?'selected':''?> >Game Đang hoạt động</option>
                      <option value="-1" <?=($game_status==-1)?'selected':''?> >Game tạm ẩn </option>
                    </select>
                  </div>
                  
                  <!-- search form start -->
                      <div id="search_form" method="get">
                        <div class="input-group custom-search-form" style="margin-bottom: 8px;width: 300px;">
                            <input type="text" class="form-control" name="search" placeholder="Search id or title..." value="<?= $search ?>">
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="submit" id="btn_search">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                        </div>
                      </div>
                      <!-- search form end -->

                  <table class="table table-bordered" style=" margin: 0px auto;">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Thumbnail</th>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Ticket Price</th>
                        <th>Created by</th>
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
                          if ($item['status']==0) {
                            echo '<tr>
                                    <td>'.$i++.'</td>
                                    <td><img src="'.$item['thumbnail'].'" style="width: 120px;"></td>
                                    <td><b>'.$item['game title'].'</b></td>
                                    <td>'.$item['category title'].'</td>
                                    <td><b>'.number_format($item['price']).'</b></td>
                                    <td>'.$item['fullname'].'</td>
                                    <td>'.$item['created_at'].'</td>
                                    <td>'.$item['updated_at'].'</td>
                                    
                                    <td><button class="btn btn-warning" onclick="edit('.$item['id'].')">Edit</button></td>

                                    <td><button class="btn btn-danger" onclick="trashed('.$item['id'].')">Trashed </button></td>

                                  </tr>';
                          }else{

                            echo '<tr>
                                    <td>'.$i++.'</td>
                                    <td><img src="'.$item['thumbnail'].'" style="width: 120px;"></td>
                                    <td><b>'.$item['game title'].'</b></td>
                                    <td>'.$item['category title'].'</td>
                                    <td><b>'.number_format($item['price']).'</b></td>
                                    <td>'.$item['fullname'].'</td>
                                    <td>'.$item['created_at'].'</td>
                                    <td>'.$item['updated_at'].'</td>
                                    <td><button class="btn btn-warning" onclick="restore('.$item['id'].')">Restore </button></td>
                                    <td><button class="btn btn-danger" onclick="del('.$item['id'].')">Delete</button></td>
                                    
                                  </tr>';
                          }
                          
                        }
                      ?>
                    </tbody>
                  </table>

                  <div style="text-align: ;"> <?php include_once '../utility/pagination_multi.php'; ?> </div>
                </div>
             </div>

              <input type="text" id="a_month_ago" value="<?=$a_month_ago?>" style="display: none;">

             <script type="text/javascript">
              $('#btn_search').click(function(){
                var game_status= $('#select_status').val();
                var search = $('[name=search]').val()

                 window.location.replace('adm_games.php?game_status='+game_status+'&search='+search)

              })

              $('#select_status').change(function(){
                var game_status= $(this).val();
                var search = $('[name=search]').val()

                window.location.replace('adm_games.php?game_status='+game_status+'&search='+search)
                
              })

              function trashed(id){
                var a_month_ago = $('#a_month_ago').val()

                if (confirm('Khi ẩn sản phẩm này , nó sẽ bị xóa tự động sau '+a_month_ago+' .Bạn có chắc chắn ?') ) {
                  $.post('adm_games.php',
                    {
                      trashed_id:id
                    }
                    ,
                    function(data){
                      location.reload()
                    }
                    )
                }
              }

              function restore(id){
                
                  $.post('adm_games.php',
                    {
                      restore_id:id
                    }
                    ,
                    function(data){
                      location.reload()
                    }
                    )
                
              }

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
