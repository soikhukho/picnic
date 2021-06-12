$('[name=btn_minus]').click(function(){

          var quantity =parseInt( $(this).parent().children('input').val() );
          var min=parseInt( $(this).parent().children('input').attr('min') );

          if (quantity<=min) {
                alert('quantity must be more than 1');
              
                return false
              
            }else{
              $(this).parent().children('input').val( quantity*1-1 )
            }

      })

      $('[name=btn_add]').click(function(){

          var quantity =parseInt( $(this).parent().children('input').val() );
          var max=parseInt( $(this).parent().children('input').attr('max') );

          if (quantity>=max) {
                alert('quantity must be less than 50');
              
                return false
              
            }else{
              $(this).parent().children('input').val( quantity*1+1 )
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
      })


       $('.btn_addToCart').click(function(){
          var id= $(this).attr('id')
          var quantity=$(this).parent().parent().parent().parent().children('#price_area').children().children('.quantity_area').children('input').val()

          addToCart(id,quantity)
       })

       function addToCart(id,quantity){
        alert('Them vao gio hang thanh cong')
        $.post('form_ajax/add_to_cart.php',{game_id:id,quantity:quantity},function(data){
          $('[name=total_item_in_cart]').val(data)
        })
       }
