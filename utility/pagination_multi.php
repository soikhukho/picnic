<?php
//in ra mục phân trang đánh số: include_once '../utility/pagination.php';
//cần có $limit , $start , $totalPages  ,

//tùy biến theo list những page được show trong $activePages (lùi mấy , tiến mấy)


/** coppy đoạn code này sang phần tạo data show ở mỗi page

//pagination form ?xx=&page=

$search=getGET('search');
  if ($search !='') {
    $sub_sql = " and ( albums.id like '%$search%' or albums.title like '%$search%' ) ";
  }else {$sub_sql='';}

$totalItems = executeResult("select count(*) 'count' from ??? " . $sub nếu có ,true);
  $totalItems = $totalItems['count'];

$href='?.php';

$page = getGET('page');
if($page==''){$page = 1;}

$limit  =?;
$totalPages = ceil($totalItems / $limit);
$start = ($page-1) * $limit;

$data mỗi page = executeResult("select * from ??? .sub nếu có limit $start , $limit ");

rồi nhúng ở đoạn cuối:
	
	<!-- pagination -->
	<div style="text-align: center;"> <?php include_once 'utility/pagination.php'; ?> </div>

và $i=$limit*($page-1)+1;

*/
// mở thẻ ul
echo '<div aria-label="Page navigation example" >
			  <ul class="pagination" >';


	//chon list active pages
		$activePages = [$page-2, $page-1, $page , $page + 1];

	//page 1 thi khong hien back - không phục thuộc vào list active
		if ($page >1) {
			echo '<li class="page-item">
				      <a class="page-link" href="'.$href.'page='.($page-1).'" aria-label="Previous">
				        <span aria-hidden="true">&laquo;</span>
				        <span class="sr-only">Previous</span>
				      </a>
				    </li>';
		}

	//page lon hon  3 moi hien thi -- (do list page lùi 2) -- chenh +1
		if ($page > 0+3) {
			echo '<li class="page-item" active><a  class="page-link " href="#">--</a></li>';
		}

	//cac page active
		for($i=1; $i <= $totalPages; $i++){
			if (in_array($i,$activePages)) {

	    			if ($i ==$page) {
		    			echo '<li class="page-item active" active><a  class="page-link " href="'.$href.'page='.$i.'">'.$i.'</a></li>';
		    		}else{
		    			echo '<li class="page-item"><a class="page-link" href="'.$href.'page='.$i.'">'.$i.'</a></li>';
		    		}
			}
		}

	//hien thi -- trươc hai page cuoi ( do list page hiển thi tiến 1) -- chenh 1
		if ($page <= $totalPages-2) {
			echo '<li class="page-item" active><a  class="page-link " href="#">--</a></li>';
		}

	//page cuoi thi khong hien next - không phụ thuộc vào list active
		if ($page <=$totalPages-1) {
			echo '<li>
				      <a class="page-link" href="'.$href.'page='.($page+1).'" aria-label="Next">
				        <span aria-hidden="true">&raquo;</span>
				        <span class="sr-only">Next</span>
				      </a>
			    </li>';
		}


//đóng thẻ paginaton
echo '</ul>
			</div>';