 total_money() ;

  //onclick btn minus
      $('[name=btn_minus]').click(function(){

          var quantity =parseInt( $(this).parent().children('input').val() );
          var min=parseInt( $(this).parent().children('input').attr('min') );

          if (quantity<=min) {
                alert('quantity must be more than '+min);
              
                return false
              
            }else{
                $(this).parent().children('input').val( quantity*1-1 )

                var price = parseFloat( $(this).parent().parent().parent().children('[name=price]').text().replace( ',', '' ) )

                var newquantity = parseFloat( $(this).parent().children('input').val() )

                $(this).parent().parent().parent().children('[class=total]').html( Comma(price*newquantity) )

                var game_id = $(this).parent().parent().parent().children('.game_id').children().val()

                update_quantity(game_id,newquantity)
                total_money()

            }

      })

  //onclick btn plus
      $('[name=btn_plus').click(function(){

          var quantity =parseInt( $(this).parent().children('input').val() );
          var max=parseInt( $(this).parent().children('input').attr('max') );

          if (quantity>=max) {
                alert('quantity must be less than '+max);
              
                return false
              
            }else{
                $(this).parent().children('input').val( quantity*1+1 )

                var price = parseFloat( $(this).parent().parent().parent().children('[name=price]').text().replace( ',', '' ) )

                var newquantity = parseFloat( $(this).parent().children('input').val() )

                $(this).parent().parent().parent().children('[class=total]').html( Comma(price*newquantity) )

                var game_id = $(this).parent().parent().parent().children('.game_id').children().val()

                update_quantity(game_id,newquantity)
                total_money()

            }

      })



  //quantity must be > min and < max
      $('.quantity_area input').change(function(){

          var price = parseFloat( $(this).parent().parent().parent().children('[name=price]').text().replace( ',', '' ) )

          var quantity =  parseInt( $(this).val() );
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

          //lay gia tri moi
          quantity =  parseInt( $(this).val() );
          var total = quantity*price ;

          $(this).parent().parent().parent().children('[class=total]').html( Comma(price*quantity) ) 

          var game_id = $(this).parent().parent().parent().children('.game_id').children().val()

          update_quantity(game_id,quantity)
          total_money()

      })

      function update_quantity(game_id,newquantity){
          $.post('form_ajax/add_to_cart.php',{game_id:game_id,quantity:newquantity},function(data){
                $('[name=total_item_in_cart]').val(data)
              })
      }

      function total_money(){
          var total_money =0 ;

          $('.total').each(function(){
              var total = $(this).text().replace( ',', '' )

              total_money+= parseFloat(total)
          })

          $('#total_money').html('Tổng tiền : '+Comma(total_money))
      }

//onclick delete icon
$('[name=delete_icon]').click(function(){

    var del_game_id = $(this).parent().parent().children('.game_id').children().val() ;

    if (confirm('Are you sure to del this item?')) {

        $(this).parent().parent().empty();

        $.post('form_ajax/add_to_cart.php',{del_game_id:del_game_id},function(data){
            $('[name=total_item_in_cart]').val(data)
        })

        total_money()
        
    };
})
