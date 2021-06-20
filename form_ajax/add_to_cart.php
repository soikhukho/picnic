<?php
include_once '../db/dbhelper.php';
include_once '../utility/utils.php';

//đồng bộ cart vs cookie
if (isset($_COOKIE['cart_picnic'])) {
	$cart = json_decode($_COOKIE['cart_picnic'],true);
} else{
	$cart = [];
}


	

//sau đó thực thi công việc add / del hay edit

	$game_id = getPOST('game_id');
	$quantity = getPOST('quantity');
	$del_game_id=getPOST('del_game_id');

	//for add to cart 
	if ($game_id!='' && $del_game_id=='') {
			
			if ($cart!='') {
				//xet ton tai , neu co thi update 
				$i=0;$j=0;
				foreach ($cart as $detail) {
					
					if ($detail['game_id'] == $game_id) {
						//nêu có cái trùng id sẽ ghi đè cái đó bằng cái mới
						$cart[$i] = array('game_id' =>$game_id ,
											'quantity' =>$quantity
							 			);
						$j++;
					}
					$i++;
				}
			}
			
			if($j==0){
					// nếu ko có cái nào trùng thì thêm một cái mới
					$cart[] =array('game_id' =>$game_id ,
									'quantity' =>$quantity
					 );
			}

			
	}

	//for del from cart 
	
	if ($del_game_id!='' && $game_id=='') {
		
			$i=0;
			foreach ($cart as $detail) {
				
				if ($detail['game_id'] == $del_game_id) {
					array_splice($cart,$i, 1);
				}
				$i++;
			}
	}


//b3 đồng bộ lên cookie
	setcookie('cart_picnic',json_encode($cart),time() +60*60*24*7,'/');

	$total_item_in_cart=0;
	foreach ($cart as $item) {
		$total_item_in_cart+=$item['quantity'];
	}

//echo để trả về result số lượng trong giỏ hàng
echo '('.$total_item_in_cart.' sp)';






