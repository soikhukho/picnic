<?php
  require_once 'db/dbhelper.php';
  require_once 'utility/utils.php';

  $user = checkLogin();
  include_once 'login.php';

  //lấy dữ liệu $cart
  if (isset($_COOKIE['cart_picnic'])) {
    $cart = json_decode($_COOKIE['cart_picnic'],true);
  } else{
    $cart = [];
  }
?>

<!DOCTYPE html>
<html>
<head>
  <title>cart</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <!-- include summernote css/js -->
  <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote.css" rel="stylesheet">
  <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote.js"></script>
  <link rel="stylesheet" type="text/css" href="style/style_header2.css">
  <script src="https://kit.fontawesome.com/3e49906220.js" crossorigin="anonymous"></script>
  <style type="text/css">

    #btn_minus{
      height: 28px;
      border-radius: 5px 0 0 5px;
      margin-right: -5px !important;
    }

    #btn_add{
      height: 28px;
      border-radius: 0 5px 5px 0;
      margin-left: -5px !important;
    }
    .title{
      padding-top: 25px !important;
    }
    .quantity_area{
      padding-top: 15px;
    }

    .quantity_area input{
      margin-top: 0px !important;
      width: 50px !important;
      height: 35px;
      text-align: center;
      font-weight: bold;
      font-size: 18px;
    }

    .quantity_area button{
      height: 35px !important;
      width: 35px !important;
    }

    .fas:hover{
      cursor: pointer;
    }
  </style>
</head>
<body>
    <?php
        include_once 'layout/header2.php';
        // include_once 'layout/carosell.php';
        // include_once 'layout/popup_login.php';

     ?>
     <div class="container" style="min-height: 1000px;">

        <div id="result"></div>

        <div id="" style="margin-top: 50px;">
          <h3>Your cart :</h3>
          <form id="myForm" method="post">
              <table class="table table-bordered" style="width: 80%;">
                <thead >
                  <th>STT</th>
                  <th>Game ID</th>
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
                            <td>'.$i.'</td>

                            <td class="game_id"><input type="number" value="'.$detail['game_id'].'" style=" border:none;width:40px;" readonly="true" id="game_id'.$i.'" name="game_id'.$i.'"></td>

                            <td class="title">'.$game['title'].'</td>

                            <td><img src="'.$game['thumbnail'].'" style="height:80px;"></td>

                            <td><input name="price" id="price'.$i.'" type="number"  value="'.($price).'" readonly="true" style="width:100px;border:none;"></td>

                            <td >
                                <div class="quantity_area " style=" display:flex;width:150px;">
                                      <button id="btn_minus" name="btn_minus" class="btn btn-danger" style="font-size: 9px;">
                                          <i class="fa fa-minus" aria-hidden="true"></i>
                                      </button>

                                      <input class="quantity" id="quantity" type="number" value="'.$detail['quantity'].'" name="quantity" min="1" max="50">

                                      <button id="btn_add" name="btn_add" class="btn btn-success" style="font-size: 9px;">
                                          <i class="fa fa-plus" aria-hidden="true"></i>
                                      </button>
                                   </div>
                            </td>

                            <td><input class="total" id="total'.$i.'" type="number" style=" border:none;width:100px;" readonly="true" value="'.$total.'" ></td>

                            <td><i name="delete_icon" class="fas fa-trash-alt fa fa-2x" style="color:orange"></i></td>
                          </tr>';
                          $i++;
                          
                    }

                  ?>
                </tbody>
              </table>
                
                <h3 class="row" id="total_money" style="margin-left: 600px;" > </h3>
  

            </form>
          
        </div> 

     </div>
    <?php include 'layout/footer.php'; ?>

<script type="text/javascript">

  total_money() ;

  //onclick btn minus
  $('[name=btn_minus]').click(function(){
          $('#myForm').submit(function(){return false})

          var quantity =parseInt( $(this).parent().children('input').val() );
          var min=parseInt( $(this).parent().children('input').attr('min') );

          if (quantity<=min) {
                alert('quantity must be more than '+min);
              
                return false
              
            }else{
                $(this).parent().children('input').val( quantity*1-1 )

                var price = $(this).parent().parent().parent().children().children('[name=price]').val()
                var newquantity = $(this).parent().children('input').val()

                $(this).parent().parent().parent().children().children('[class=total]').val( price*newquantity )

                var game_id = $(this).parent().parent().parent().children('.game_id').children().val()

                update_quantity(game_id,newquantity)
                total_money()

            }

      })

  //onclick btn add
  $('[name=btn_add]').click(function(){
          $('#myForm').submit(function(){return false})

          var quantity =parseInt( $(this).parent().children('input').val() );
          var max=parseInt( $(this).parent().children('input').attr('max') );

          if (quantity>=max) {
                alert('quantity must be less than '+max);
              
                return false
              
            }else{
                $(this).parent().children('input').val( quantity*1+1 )

                var price = $(this).parent().parent().parent().children().children('[name=price]').val()
                var newquantity = $(this).parent().children('input').val()

                $(this).parent().parent().parent().children().children('[class=total]').val( price*newquantity )

                var game_id = $(this).parent().parent().parent().children('.game_id').children().val()

                update_quantity(game_id,newquantity)
                total_money()

            }

      })


  //quantity must be > min and < max
      $('.quantity_area input').change(function(){

          var quantity =  $(this).val() 
          var min=parseInt( $(this).attr('min') );
          var max=parseInt( $(this).attr('max') );

          if (quantity !='' && quantity< min ) {
            alert('quantity must be >0')
            $(this).val(min)
          }

          if (quantity >max ) {
            alert('quantity must be <50')
            $(this).val(max)
          }

          $(this).blur(function(){
            if ($(this).val()=='') {
              $(this).val(min)
            }
          })

          var newquantity= $(this).val()
          var game_id = $(this).parent().parent().parent().children('.game_id').children().val()
          var price = $(this).parent().parent().parent().children().children('[name=price]').val()

          $(this).parent().parent().parent().children().children('[class=total]').val( price*newquantity )
          update_quantity(game_id,newquantity)

          total_money()

      })

      function update_quantity(game_id,newquantity){
          $.post('add_to_cart.php',{game_id:game_id,quantity:newquantity},function(data){
                $('[name=total_item_in_cart]').val(data)
              })
      }

      function total_money(){
          var total_money =0

          $('.total').each(function(){
              total_money+= parseFloat($(this).val())
          })

          $('#total_money').html('Tổng tiền : '+total_money)
  }


$('[name=delete_icon]').click(function(){

    var del_game_id = $(this).parent().parent().children('.game_id').children().val() ;

    $(this).parent().parent().empty();

    del(del_game_id) ;
})

function del(del_game_id){
  if (confirm('Are you sure to del this item?')) {
      $.post('add_to_cart.php',{del_game_id:del_game_id},function(data){
        $('[name=total_item_in_cart]').val(data)
    })
  }
}
  

</script>
</body>
</html>
