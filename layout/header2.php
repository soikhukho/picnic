<?php
	require_once 'db/dbhelper.php';

	$category = executeResult("select * from category");
	// var_dump($category);
	if (isset($_COOKIE['cart_picnic'])) {
		$cart = json_decode($_COOKIE['cart_picnic'],true);
	} else{
		$cart = [];
	}

	$total_item_in_cart=0;
	foreach ($cart as $item) {
		$total_item_in_cart+=$item['quantity'];
	}
	
?>


<div class="header-top">
	<div class="container" style="height: 40px !important">

			<div class="col-md-6">
				<div id="contact" class="row" >

					<div class="col-md-3">
						<a  href="tel: 0866759002"><i class="fas fa-phone-alt"></i> 0866759002</a>
					</div>
					<div class="col-md-6">
						<a href="https://www.google.com/maps/place/54+L%C3%AA+Thanh+Ngh%E1%BB%8B,+B%C3%A1ch+Khoa,+Hai+B%C3%A0+Tr%C6%B0ng,+H%C3%A0+N%E1%BB%99i,+Vi%E1%BB%87t+Nam/@21.0034695,105.846929,17z/data=!3m1!4b1!4m5!3m4!1s0x3135ad58455db2ab:0x9b3550bc22fd8bb!8m2!3d21.0034695!4d105.8491177?hl=vi"><i class="fas fa-map-marker-alt"></i> 54 Lê Thanh Nghị - Hai Bà Trưng.</a>
					</div>
				</div>
			</div>
			
			<div class="col-md-6" style="text-align: right;height: 40px !important">
					<div id="login_group" >
							<ul  style="display: inline-flex; list-style-type: none;">

								  <li id="hello_user" <?=($user=='')?'style="display: none;"':'' ?> ><a href="admin/adm_message.php" >
										<button id="btn_user" class="btn" style="text-align: left;min-width: 80px; height: 32px; border-radius: 20px;padding: 2px;padding-right: 5px;">
											<img src="<?=($user!='')?$user['avatar']:'' ?>" 
													style="border-radius: 50%;height: 26px;border: 1px solid grey ">
											<span><?=($user!='')?$user['fullname']:'' ?></span>
										</button>
								  </li>

								  <li id="logout" <?=($user=='')?'style="display: none;"':'' ?>><a href="logout.php" >
							      	<span class="glyphicon glyphicon-log-in" ></span> Logout</a>
							      </li>

							      <li id="signup" <?=($user!='')?'style="display: none;"':'' ?>><a href="signup.php" >
							      	<span class="glyphicon glyphicon-user" ></span> Sign Up</a>
							      </li>

							      <li id="login" <?=($user!='' )?'style="display: none;"':'' ?> >
							      	<a id="popup"><span class="glyphicon glyphicon-log-in"></span> Log in</a>
							      </li>
						    </ul>
					</div>
				</div>

	</div>
</div>

<div class="header_body">
	<div class="container" style="">
			<nav class="row">
				<div class="logo col-md-2">
					<img src="https://hinoderoyalpark.com.vn/public/media/logo_hnd_rp.png" style="height: 80px;padding-top: 15px;">
				</div>
				<ul class="col-md-8">
					<li><a href="index.php" <?= ($index=="index")?'class="active-header"':''?> >HOME </a></li>
					<li>
						<a href="games.php" <?= ($index=="games")?'class="active-header"':''?> >GAMES</a>
						<ul >
							<?php
			            		foreach ($category as $cate) {
			            			$cate_id = $cate['id'];
			            			$games= executeResult("select * from games where cate_id = $cate_id ");
			            			echo '<li>
			            						<a style="text-transform: uppercase;" href="games.php?cate='.$cate['id'].'">'.$cate['title'].'</a>';

			            			echo "</li>";
			            		}
				              ?>
						</ul>
					</li>
					<!-- <li><a href="">NEWS</a></li> -->
					<li><a href="places.php" <?= ($index=="places")?'class="active-header"':''?> >BEAUTY PLACES</a></li>
					<li><a href="albums.php" <?= ($index=="albums")?'class="active-header"':''?>>ALBUMS</a></li>
					<li><a href="contact.php" <?= ($index=="contact")?'class="active-header"':''?>>CONTACTS</a></li>

				</ul>
				<div id="cart" class="col-md-2" style="text-align: right;padding-right: 68px;">
					<a href="cart.php">
						<i id="icon_cart" class="fas fa-shopping-cart fa-3x" ></i>
						<input readonly="true" type="text" name="total_item_in_cart" value="(<?= $total_item_in_cart?> sp)">
					</a>
				</div>

			</nav>
		</div>
	</div>


<script type="text/javascript">
	$('#popup').click(function () {
		document.getElementById("popup_login").style.display=''
		$('#email').focus()
	})
</script>
