<?php
  require_once 'db/dbhelper.php';
  require_once 'utility/utils.php';

  require_once 'php_form/php_cart.php';

?>

<!DOCTYPE html>
<html>
<head>
  <title>CART</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <!-- include summernote css/js -->
  <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote.css" rel="stylesheet">
  <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote.js"></script>

  <script src="https://kit.fontawesome.com/3e49906220.js" crossorigin="anonymous"></script>

  <link rel="stylesheet" type="text/css" href="style/style_header2.css">
  <link rel="stylesheet" type="text/css" href="style/cart_style.css">

  <script type="text/javascript" src="js/utils.js"></script>
</head>
<body>
    <?php
        include_once 'layout/header2.php';
        // include_once '../layout/carosell.php';
        include_once 'layout/popup_login.php';

     ?>
     <div class="container" style="min-height: 1000px;">

        <div id="content" >
          <h3>Your cart :</h3>
          
              <table class="table table-bordered" style="">
                <thead >
                  <th>STT</th>
                  <th style="display: none;">Game ID</th>
                  <th>Game Title </th>
                  <th>Thumbnail</th>
                  <th>Price</th>
                  <th>Quantity</th>
                  <th>Total</th>
                  <th></th>
                </thead>
                <tbody id="test">
                  <?php
                    $i=1;
                    foreach ($cart as $detail) {
                      $id = $detail['game_id'];
                    
                      $sql = 'select * from games where id = '.$id;
                      
                      $game = executeResult($sql, true);
                      $price=$game['price'];
                      $total = $game['price'] * $detail['quantity'];
                      
                      echo '<tr class="detail">
                              <td class="no">'.$i.'</td>

                              <td class="id" style="display: none;" class="game_id"><input type="number" value="'.$detail['game_id'].'" style=" border:none;width:40px;" readonly="true" id="game_id'.$i.'" name="game_id'.$i.'"></td>

                              <td class="title">'.$game['title'].'</td>

                              <td><img src="'.$game['thumbnail'].'" style="height:80px;"></td>

                              <td class="price" name="price" id="price'.$i.'">'.number_format($price).'</td>

                              <td >
                                  <div class="quantity_area " style=" display:flex;width:150px;">
                                        <button id="btn_minus" name="btn_minus" class="btn btn-danger" style="font-size: 9px;">
                                            <i class="fa fa-minus" aria-hidden="true"></i>
                                        </button>

                                        <input class="quantity" id="quantity" type="number" value="'.$detail['quantity'].'" name="quantity" min="1" max="50">

                                        <button id="btn_plus" name="btn_plus" class="btn btn-success" style="font-size: 9px;">
                                            <i class="fa fa-plus" aria-hidden="true"></i>
                                        </button>
                                     </div>
                              </td>

                              <td class="total" id="total'.$i.'">'.number_format($total).'</td>

                              <td class="action" ><i name="delete_icon" class="fas fa-trash-alt fa fa-2x" style="color:orange"></i></td>
                          </tr>';
                          $i++;
                          
                    }

                  ?>
                </tbody>
              </table>
                
              <h3 class="row" id="total_money" style="margin-left: 550px;" > </h3>

              <div style="text-align:  center;">
                <a href="games.php"><button class="btn btn-warning ">Continue shopping</button></a>
              </div>

                <!-- form customer info start-->
              <form id="myForm" method="post" style="margin-top: 50px;">
                <center><h2>Bạn cần hoàn tất thông tin để mua hàng </h2></center>

                <div <?= (count($cart)==0)?'style="display:none"':'' ?>>
                  <div class="form-group">
                    <label for="customer_name">Full name:</label>
                    <input required="true" type="text" class="form-control" id="customer_name" name="customer_name" value="<?= $customer_name ?>" pattern="^[^0-9_!¡?÷?¿/\\+=@#$%ˆ&*(){}|~<>;:[\]]{2,31}$" title="Tên không được chứa chữ số và kí tự đặc biệt : _!¡?÷?¿/\\+=@#$%ˆ&*(){}|~<>;:[\] . ">
                  </div>

                  <div class="form-group">
                    <label for="phone_no">
                      Phone number:
                      <span style="font-size: 10px;font-weight: normal;font-style: italic;">(format: 1234-567-890 hoặc +84999-999-999)</span> 
                    </label>
                    <input required="true" type="text" class="form-control" id="phone_no" name="phone_no" value="<?= $phone_no ?>" pattern="[+0-9]{4,6}-[0-9]{3}-[0-9]{3}">
                  </div>

                  <div class="form-group">
                    <label for="address">Address:</label>
                    <input required="true" type="text" class="form-control" id="address" name="address" value="<?= $address ?>">
                  </div>
                  
                  
                </div>
                <!-- form caustomer end -->

                <div style="text-align: center;margin-top: 30px;" >
                  <a href="checkout.php" <?= (count($cart)==0)?'style="display:none"':'' ?> ><button id="btn_checkout" class="btn btn-warning">Mua hàng</button>
                  </a>
                </div>
  

            </form>
          
        </div> 

     </div>
     
  <?php include 'layout/footer.php'; ?>

<script type="text/javascript" src="js/change_quantity_cart_page.js"></script>

</body>
</html>
