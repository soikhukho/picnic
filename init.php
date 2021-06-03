<?php
require_once 'db/dbhelper.php';
require_once 'utility/utils.php';

	$init = getPost('init');
	echo $init;

	if ($init==1){

		$sql = 'create database if not exists '.DATABASE;
		echo $sql;
		createDB($sql);

		$users_table = 'create table if not exists users (
							id int primary key auto_increment,
							fullname varchar(100) not null,
							email varchar(100) unique,
							phone_no varchar(20),
							birthday datetime,
							address varchar(200) ,
							created_at datetime,
						    updated_at datetime,

							password varchar(32) not null,
							token varchar(32),
							avatar varchar(500) default "https://static2.yan.vn/YanNews/2167221/202003/dan-mang-du-trend-thiet-ke-avatar-du-kieu-day-mau-sac-tu-anh-mac-dinh-b0de2bad.jpg",
							active tinyint default 0
					)';
		execute($users_table);

		$places_table = 'create table if not exists places (
						    id int primary key auto_increment,
						    title varchar(200) unique,
						    content longtext,
						    created_at datetime,
						    updated_at datetime,

						    user_id int references users(id)
						    )';
		execute($places_table);

		$category_table = 'create table if not exists category (
						    id int PRIMARY KEY AUTO_INCREMENT,
    						title varchar(100) not null,
    						created_at datetime,
						    updated_at datetime
    						)';
		execute($category_table);

		$games_table = 'create table if not exists games  (
						    id int PRIMARY KEY AUTO_INCREMENT,
    						title varchar(200) not null,
    						thumbnail varchar(200),
    						price float not null,
    						description varchar(500) not null,
    						content longtext not null,
    						created_at datetime,
						    updated_at datetime,

						    cate_id int references category(id),
						    user_id int references users(id)
    						)';
		execute($games_table);

		$customers_table = 'create table if not exists customers (
							id int primary key auto_increment,
							fullname varchar(100) not null,
							phone varchar(20) unique,
							address varchar(200) ,
							created_at datetime
							)';
		execute($customers_table);

		$orders_table = 'create table if not exists orders (
							id int primary key auto_increment,
							cus_id int references customers(id),
							created_at datetime,
							status tinyint default 0
							)';
		execute($orders_table);

		$orders_details_table = 'create table if not exists orders_details (
									id int primary key auto_increment,
									price float not null,
									quantity int not null,
									created_at datetime,
									order_id int references orders(id),
									game_id int references games(id)
									)';
		execute($orders_details_table);

		$albums_table = 'create table if not exists albums (
							id int primary key auto_increment,
							title varchar (200) ,
							thumbnail varchar (200) ,
							description varchar(500),
							created_at datetime,
						    updated_at datetime,
							game_id int references games (id)
						)';
		execute($albums_table);

		$photoes_table = 'create table if not exists photoes (
							id int primary key auto_increment,
							title varchar (200) ,
							address varchar(200) not null,
							created_at datetime,
						    updated_at datetime,
							album_id int references albums (id)
						)';
		execute($photoes_table);

		$message_table = 'create table message(
								id int PRIMARY key AUTO_INCREMENT,
							    content varchar(200) not null,
							    created_at datetime,
							    href varchar(100),
							    status tinyint default 0)';
		execute($message_table);

}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Init Database</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	<!-- include summernote css/js -->
	<link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote.css" rel="stylesheet">
	<script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote.js"></script>

</head>
<body>
	<div class="container">

		<center style="margin-top: 100px;">
			<h1>Click here to init Database </h1>
			<button class="btn btn-primary" style="height: 150px;" onclick="createDB()">INIT DATABASE for PICNIC GAMES</button>
		</center>
	</div>
	

<script type="text/javascript">
	function createDB() {
		alert('Da tao thanh cong')
		$.post('init.php',
				{
					init:1
				},
				function (data){
					// location.reload()
					window.location.replace('index.php')
				})
	}
</script>
</body>
</html>
