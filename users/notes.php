<?php
require_once '../db/dbhelper.php';
require_once '../utility/utils.php';

$user = checkLogin();
// var_dump($user );

$fullname =$user['fullname'];
$user_id = $user['id'];

//show and pagination
	$total = executeResult("select count(*) as 'total' from notes where user_id = '$user_id' ",true);
	// var_dump($data);
	$totalItems = $total['total'];
	$href='notes.php';

	$page = getGET('page');
	if($page==''){$page = 1;}

	$limit  =6;
	$totalPages = ceil($totalItems / $limit);
	$start = ($page-1) * $limit;

	$data = executeResult("select * from notes where user_id = '$user_id' limit $start,$limit ");



$alert = '';

$date= date('Y-m-d H:i:s');

$title = getPost('title');
$content = getPost('content');
$delID = getPost('delID');
$editID = getGet('editID');
if($editID!=''){
	$editNote = executeResult("select * from notes where id='$editID' ",true);
	// var_dump($editNote);
}

//for delete
if ($delID!='') {
	execute("delete from notes where id = '$delID' and user_id = '$user_id' ");
}

//for add new
if ($editID =='' && $title!='') {
	//check title 
	if( executeResult("select * from notes where title='$title' ")!='' ){
			$alert='tên này không hợp lệ';
	}
	else{
			execute("insert into notes (title , content , user_id , created_at , updated_at )
								 values ('$title','$content',$user_id, '$date', '$date') "	);
			header('Location: notes.php');
		}
}

//for edit
if ($editID!='' && $title !='') {
	execute("update notes set title='$title',content='$content',updated_at='$date' where user_id=$user_id and id=$editID ");
	
	header('Location: notes.php');
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Notes</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	<!-- include summernote css/js -->
	<link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote.css" rel="stylesheet">
	<script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote.js"></script>
</head>
<body>
	<center>
		xin chào <?=$user['fullname'] ?>
		<button class="btn btn-danger" onclick="logout()">Đăng xuất</button>
	</center>
	<div class="container">
		<form id="form_note" method="post" style="width: 800px;margin:0px auto;margin-top: 50px;">
			<center><h2>Create a Note:</h2></center>
			<span style="color: red"><?= $alert ?></span>
			<div class="form-group">
				<label>Title</label>
				<input  class="form-control" type="text" name="title" value="<?php if($editID!=''){echo $editNote['title'];} ?>">
			</div>
			<div class="form-group">
				<label>Content</label>	
				<textarea id="content" name="content" ></textarea>
			</div>
			
			<button class="btn btn-primary">ADD</button>
		</form>
	</div>

	<div class="container" style="margin-top: 100px;">
		<table class="table table-bordered">
			<thead>
				<th>No</th>
				<th>Id</th>
				<th>Title</th>
				<th>Content</th>
				<th>--</th>
				<th>--</th>
				
			</thead>
			<tbody>
				
				<?php
					$i=$start+1;
					foreach ($data as $note) {
						echo '<tr>
								<td>'.$i++.'</td>
								<td>'.$note['id'].'</td>
								<td>'.$note['title'].'</td>
								<td>'.$note['content'].'</td>
								<td><a href="notes.php?editID='.$note['id'].'"><button class="btn btn-warning">EDIT</button></a></td>
								<td><button class="btn btn-danger" onclick="del('.$note['id'].')">DELETE</button></td>
							</tr>';
					}
				?>
			</tbody>
		</table>
		<?php
			include_once '../utility/pagination.php';
		?>
	</div>

<script type="text/javascript">
	function logout() {
		window.location.replace('logout.php');
	}

	$('#content').summernote();

	function del(id){
		if (confirm('Are you sure to delete this note ?')) {
			$.post('notes.php',
					{
						delID:id
					},
					function(data){
						location.reload()
					})
		}
	}

	
</script>
</body>
</html>