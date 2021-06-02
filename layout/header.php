<?php
	require_once 'db/dbhelper.php';

	$category = executeResult("select * from category");
	// var_dump($category);
	$places = executeResult("select * from places");
?>
	<div id="header">
		<div class="container">
			<div class="row">

				<!--left- logo -->
				<div class="col-md-3">
					<img src="https://hinoderoyalpark.com.vn/public/media/logo_hnd_rp.png" style="height: 100px;">
				</div>

				<!--center- tìm kiếm -->
				<div class="col-md-4">
					<div class="row" style="padding-top: 50px;">
						<input type="text" name="" placeholder="Tìm kiếm" style="height: 35px;width: 300px; border:none; border-radius: 5px; outline: none;">
						<button class="btn btn-light">SEARCH</button>
					</div>
				</div>

				<!-- right - login ... -->
				<div class="col-md-5" style="text-align: right;">
						<div id="login_group" >
								<ul  style="display: inline-flex; padding-top: 5px;list-style-type: none;">
									  <li id="hello_user" <?=($user=='')?'style="display: none;"':'' ?> ><a href="admin.php" >
											<button id="btn_user" class="btn" style="text-align: left;min-width: 80px; height: 36px; border-radius: 20px;padding: 2px;padding-right: 5px;">
												<img src="<?=($user!='')?$user['avatar']:'' ?>" 
														style="border-radius: 50%;max-height: 30px;">
												<span><?=($user!='')?$user['fullname']:'' ?></span>
											</button>
									  </li>
									  <li id="logout" <?=($user=='')?'style="display: none;"':'' ?>><a href="logout.php" >
								      	<span class="glyphicon glyphicon-log-in" ></span> Logout</a>
								      </li>
								      <li id="signup" <?=($user!='')?'style="display: none;"':'' ?>><a href="signup.php" >
								      	<span class="glyphicon glyphicon-user" ></span> Sign Up</a>
								      </li>
								      <li id="login" <?=($user!='')?'style="display: none;"':'' ?> >
								      	<a id="popup"><span class="glyphicon glyphicon-log-in"></span> Log in</a>
								      </li>
							    </ul>
						</div>

						<div class="row" style="padding-bottom: 5px;">
								<div class="col-md-8" > </div>
								
								<div class="col-md-4" style="padding-bottom: 5px;text-align: left;">
									<a href="cart.php">
										<button id="cart" style="height: 50px; position: relative;background: transparent;border: none;">
											<img src="pictures/cart.jpg" style="border-radius: 50%;height: 50px; " >
											<input readonly="true" type="text" name="" style="height: 22px;width: 22px;border-radius: 50%;background:#ff8989;border: none;outline: none;text-align: center;font-size: 12px;color: white;font-weight: bold; position: absolute;top:2px;left: 40px;" value="0">
										</button>
									</a>
								</div>
						</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Menu -->
	<div id="menu">
		<nav class="container">			
	        <ul>
	            <li><a href="index.php" title="HOME">HOME</a></li>
	             
	             <li><a href="">DANH MỤC GAMES</a>
	             	<ul>
	             		<?php
		            		foreach ($category as $cate) {
		            			$cate_id = $cate['id'];
		            			$games= executeResult("select * from games where cate_id = $cate_id ");
		            			echo '<li>
		            						<a style="text-transform: uppercase;" href="games.php?cate='.$cate['title'].'">'.$cate['title'].'</a>';

		            			echo "</li>";
		            		}
			              ?>
	             	</ul>
	             </li>

	            <li><a href="">SỰ KIỆN</a>
	                <ul>
	                	
	                </ul>   
	            </li>
	            
	            <li><a href="places.php">ĐỊA ĐIỂM NỔI BẬT</a>
	                <ul>
	                	
	                </ul>   
	            </li>
	            <li><a href="">ALBUM</a>
	                <ul>
	                	
	                </ul>   
	            </li>
	            
	            <li style="border-right: none !important; "><a href="#" title="LIÊN HỆ">LIÊN HỆ</a></li>
	        </ul>
	    </nav>
	</div>
	</div>

<script type="text/javascript">
	$('#popup').click(function () {
		document.getElementById("popup_login").style.display=''
		$('#email').focus()
	})
</script>
	