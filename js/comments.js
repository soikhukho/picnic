
 //load cmt 
  $(document).ready(function(){

    var page_code=$('[name=page_code]').val();
    var rep_comment_id = $('[name=rep_comment_id').val()
    // alert(rep_comment_id)

    $.post('form_ajax/pagination_cmt.php',{cmt_page:1,page_code:page_code,rep_comment_id:rep_comment_id},function(data){
        //load cmt
        $('#list_comment').html(data);

        //khi nhấp link , vào page sẽ focus vào ô trả lời cmt nếu có   
        $('#'+rep_comment_id).click()
    })
  })

  //function loadmore cmt
  function loadmore_cmt(page){
    //ẩn nút cũ:
    $('#btn'+page).empty()

    var page_code=$('[name=page_code]').val();
     var rep_comment_id = $('[name=rep_comment_id').val()

    $.post('form_ajax/pagination_cmt.php',{page:page*1+1,page_code:page_code,rep_comment_id:rep_comment_id},function(data){
        $('#list_comment').html(data);
    })

  } ;

  function loadmore_sub_cmt(father_id,page_sub_cmt){
    $.post('form_ajax/load_sub_comment.php',{page_sub_cmt:page_sub_cmt*1+1,father_id:father_id},function(data){
       
       // $('#sub_comment_area_of_'+father_id).empty() ;

       $('#sub_comment_area_of_'+father_id).html(data) ;
    })

  };

  //khi nhấn nút submit cmt
  $('[name=btn_submit_main_comments]').click(function(){

      var re= /^[^0-9_!¡?÷?¿/\\+=@#$%ˆ&*(){}|~<>;:[\]]{2,31}$/;

      var that=$(this).parent().parent().parent().parent() ;

      var content = that.children('textarea').val()
      var guest_name = that.children('[name=guest_name]').val()
      var avatar = that.children('[name=avatar]').val()
      var page_code = $('[name=comments_area]').attr('id');
      
      if (guest_name=='') {
        alert('Ban chưa điền tên')
        that.children('[name=guest_name]').focus()
      }

      if (content=='') {
        alert('Ban chưa viết bình luận')
        that.children('textarea').focus()
      }

      check=re.test(guest_name)
      if (check==false) {
         alert ('Tên người không có chữ số hoặc kí tự đặc biệt (_!¡?÷?¿/\\+=@#$%ˆ&*(){}|~<>;:[\])')
        that.children('[name=guest_name]').focus()
        return false;
      }

      //sau khi validate :
      if (content!='' && guest_name!='' ) {
          var admin_name= $('#admin_name').val();

          that.children('textarea').val('')
          that.children('[name=guest_name]').val(admin_name)

          var cmt_page = $('[name=cmt_page]').val();

          $.post('form_ajax/load_comment.php'
            ,{page_code:page_code,guest_name:guest_name ,
              avatar:avatar, content:content,table:'comments',
              cmt_page:cmt_page*1}
              ,function(data){
                              $('#list_comment').html(data) ;

                                //load lại số cmt
                                $.post('form_ajax/count_comments.php',{page_code:page_code},function(data){
                                  $('#count_comments').html(data)
                                })
                            })
          

                 
      }
   
})


//onclick 
  function rep(father_id){

    var admin_name= $('#admin_name').val();
    var avatar = $('#avatar').val();

    //đổ form input vào span rỗng ứng với cmt cha
    $('#span_rep'+father_id).html(`<!-- div cm start -->
                    <div class="rep_comment_div" style="border-bottom: 1px solid #e5e5e5;margin-left:72px;margin-right:12px;">

                      <div style="background:#ededed;">
                        <div method="post" style="padding: 8px;padding-bottom: 0px;">
                          
                          <input type="number" name="father_id" style="display:none;" >
                          <input type="text" name="avatar" style="display:none;" >
                          <input type="text" value="" name="guest_name_rep" style="width: 100%;border-radius: 3px;height: 30px;border: none;outline:none" placeholder="Nhập tên bạn" required="true" >

                          <textarea name="content_rep" style="width: 100%;border-radius: 3px;height: 60px;border: none;outline:none ; margin-top:3px;" placeholder="Nhập câu trả lời " required="true"></textarea>
                       

                          <div class="row" style="height:36px;margin-top:-4px!important;">
                            <div  style="background:#ededed;">
                              <div class="col-md-6" style="padding-left: 25px!important;margin-top: 8px; font-size: 15px;font-weight: bold;">
                                  
                              </div>
                              <div class="col-md-6" style="text-align: right;padding-right: 25px!important;margin-bottom: 20px;">
                                <button name="btn_submit_sub_comments" onclick="submit_sub_comments()" style="height: 28px; margin-top: 3px;   background: #6d84b4;border:1px solid #3b5998;border-radius: 2px;color: #fff;font-weight: bold;font-size: 12px;">Gủi bình luận</button>
                              </div>
                            </div>
                          </div>
                         </div>
                      </div>
                    </div>
                    <div style="clear: both;" ></div>
                    <!-- div cm end -->`);

    var that= $('#span_rep'+father_id).children().children().children() ;

    that.children('[name=father_id]').val(father_id)
    that.children('[name=avatar]').val(avatar)
    that.children('[name=guest_name_rep]').val(admin_name)

    that.children('[name=content_rep]').focus() 

  }


//khi gửi rep cmt
function submit_sub_comments(){
    var page_code = $('[name=comments_area]').attr('id');
    var father_id = $('[name=father_id]').val()
    var guest_name = $('[name=guest_name_rep]').val()
    var avatar = $('[name=avatar]').val()
    var content = $('[name=content_rep]').val()
    var page_sub_cmt = $('#page_sub_cmt'+father_id).val();

    // alert(page_sub_cmt) ;

    if (guest_name=='') {
      alert('Ban chưa điền tên')
      $('[name=guest_name_rep]').focus()
    }

    if (content=='') {
      alert('Ban chưa viết bình luận')
      $('[name=content_rep]').focus()
    }

      //không chứa số hay list các kí tự đặc biệt sau
     var re= /^[^0-9_!¡?÷?¿/\\+=@#$%ˆ&*(){}|~<>;:[\]]{2,31}$/

     check=re.test(guest_name) ;

     if (check==false) {
        alert ('Tên người không có chữ số hoặc kí tự đặc biệt (_!¡?÷?¿/\\+=@#$%ˆ&*(){}|~<>;:[\])')
        $('[name=guest_name_rep]').focus()
        return false;
      }


  if (content!='' && guest_name!='' ) {

     $.post('form_ajax/load_sub_comment.php',{page_sub_cmt:page_sub_cmt,page_code:page_code,avatar:avatar,father_id:father_id , guest_name:guest_name , content:content,table:'sub_comments'},function(data){
        
        $('#sub_comment_area_of_'+father_id).html(data) ;
      })
  }  

};


function del_comment(id){
  var page_code = $('[name=comments_area]').attr('id');

  if (confirm('Bạn có chắc chắn muốn xóa bình luận này ?')) {
    $.post('form_ajax/load_comment.php',{page_code:page_code,del_comment_id:id },function(data){

        //load lại số cmt
          $.post('form_ajax/count_comments.php',{page_code:page_code},function(data){
            $('#count_comments').html(data)
          })  
    })

    $('#comment'+id).empty()
    $('#sub_comment_area_of_'+id).empty()

     
  }
}

function del_sub_comment(id){
  var page_code = $('[name=comments_area]').attr('id');

  if (confirm('Bạn có chắc chắn muốn xóa bình luận này ?')) {
    $.post('form_ajax/load_sub_comment.php',{page_code:page_code,del_sub_comment_id:id })

    $('#sub_comment'+id).empty()
  }
}