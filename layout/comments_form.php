


                    <!-- form cmt start -->
                    <div class="comment_div" style="border-bottom: 1px solid #e5e5e5;">

                      <div style="background:#ededed;">

                        <div  style="padding: 8px;padding-bottom: 0px;">

                          <input type="text" name="table" value="comments" style="display: none;">

                          <input type="text" name="guest_name" style="width: 100%;border-radius: 3px;height: 30px;border: 1px solid #e5e5e5;" pattern="/^[a-zA-Z '.-]*$/" placeholder="Nhập tên bạn" required="true" value="<?=$admin_name?>">

                          <input type="text" name="avatar" style="width: 100%;display: none;" value="<?=$avatar?>" >

                          <textarea name="content" style="width: 100%;border-radius: 3px;height: 60px;border: 1px solid #e5e5e5;" placeholder="Nhập bình luận " required="true"></textarea>
                       

                          <div class="row" style="height:36px;margin-top:!important;">
                              <div  style="background:#ededed;">
                                <div class="col-md-6" style="padding-left: 25px!important;margin-top: 8px; font-size: 15px;font-weight: bold;" id="count_comments">
                                    <?=count($comments) ?> Bình luận
                                </div>
                                
                                <div class="col-md-6" style="text-align: right;padding-right: 25px!important;margin-bottom: 20px;">
                                  <button name="btn_submit_main_comments" style="height: 28px;    background: #6d84b4;border:1px solid #3b5998;border-radius: 2px;color: #fff;font-weight: bold;font-size: 12px;">Gủi bình luận</button>
                                </div>
                              </div>
                          </div>

                         </div>

                      </div>

                    </div>
                    <!-- form cmt end -->
                    <div style="clear: both;" ></div>

                    
