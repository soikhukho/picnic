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
							birthday date,
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
						    thumbnail varchar(200),
						    content longtext,
						    created_at datetime,
						    updated_at datetime,
						    description varchar(500),

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
						    user_id int references users(id),
						    views int default 1000
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
							game_id int references games(id),
							views int DEFAULT 1000
						)';
		execute($albums_table);

		$videos_table = 'create table if not exists videos (
							id int primary key auto_increment,
							title varchar (200) ,
							
							address varchar(200) not null,
							created_at datetime,
						    updated_at datetime,
							game_id int references games(id),
							views int DEFAULT 1000
						)';
		execute($videos_table);

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

		$comments_table = 'create table if not exists comments (
							id int primary key auto_increment ,
							page_code varchar(50) not null,
							guest_name varchar(100) default "Khuyết Danh",
							content varchar(500) not null,						
							created_at datetime,
							avatar varchar(500) DEFAULT "https://icdn.dantri.com.vn/images/no-avatar.png" )';
		execute($comments_table);

		$sub_comments_table = 'create table if not exists sub_comments (
							id int primary key auto_increment ,
							guest_name varchar(100) default "Khuyết Danh",
							content varchar(500) not null,
							father_id int references comments(id),					
							created_at datetime ,
							avatar varchar(500) DEFAULT "https://icdn.dantri.com.vn/images/no-avatar.png" )';
		execute($sub_comments_table);

		$create_first_admin= "INSERT INTO `users` (`id`, `fullname`, `email`, `birthday`, `address`, `created_at`, `updated_at`, `password`, `token`, `phone_no`, `avatar`, `active`) VALUES (NULL, 'Picnic Team', 'picnic@gmail.com', '2021-06-23 00:00:00', 'Hai Phong', '2021-06-06 15:48:50', '2021-06-06 15:48:50', '8aabc57e58ea34cf54bbc0a6c00061bb', NULL, '0865698896', 'https://scontent-hkg4-2.xx.fbcdn.net/v/t1.6435-9/54514819_2121950994761484_2297120214103359488_n.jpg?_nc_cat=109&ccb=1-3&_nc_sid=174925&_nc_ohc=Zz0gF1ubXwgAX8WE0Yn&_nc_ht=scontent-hkg4-2.xx&oh=4d0720d02591c4740153042bfb7c87f3&oe=60E34D5E', '1')";
		execute($create_first_admin);

		$sql="INSERT INTO `category` (`id`, `title`, `created_at`, `updated_at`) VALUES (NULL, 'Ngoài trời', '2021-05-25 20:46:16', '2021-05-25 20:46:16')";
		execute($sql);

		$sql="INSERT INTO `games` (`id`, `title`, `thumbnail`, `price`, `description`, `content`, `created_at`, `updated_at`, `cate_id`, `user_id`) VALUES (NULL, 'Chèo thuyền kayak', 'https://www.adventurebritain.com/wp-content/uploads/2015/09/kayaking-1.jpg', '80000', 'Bạn cần biết cách chèo thuyền, hướng dẫn cố định bàn chân, đùi khi chèo thuyền và kỹ năng giải cứu khi gặp nạn. Không chỉ riêng với chèo thuyền kayak mà với bất kỳ một hoạt động dã ngoại nào...', '<p><span style=\"color: rgb(51, 51, 51); font-family: Arial; font-size: 12px; text-align: justify;\">Việc tham khảo các hướng dẫn cơ bản trước khi bạn bắt đầu chèo thuyền kayak là điều rất quan trọng. Nếu có, hãy tham giá các lớp học chèo thuyền do những đại lý bán lẻ kayak hoặc các câu lạc bộ chèo thuyền kayak tổ chức ở địa phương bạn.</span><br style=\"font-family: Arial; color: rgb(51, 51, 51); font-size: 12px; text-align: justify;\"><br style=\"font-family: Arial; color: rgb(51, 51, 51); font-size: 12px; text-align: justify;\"><span style=\"color: rgb(51, 51, 51); font-family: Arial; font-size: 12px; text-align: justify;\">Bạn cần biết cách chèo thuyền, hướng dẫn cố định bàn chân, đùi khi chèo thuyền và kỹ năng giải cứu khi gặp nạn. Không chỉ riêng với chèo thuyền kayak mà với bất kỳ một hoạt động dã ngoại nào, bạn cũng cần phải làm quen sử dụng bộ sơ cứu y tế khẩn cấp, kỹ năng hồi sức tim phổi (CPR), cách xử lý việc bị hạ thân nhiệt.</span></p><p><img src=\"https://wetrek.vn/pic/Service/duyanh.wetrek.vn@gmail.com/images/huong-dan-cach-cheo-thuyen-kayak-wetrek_vn.jpg\" style=\"width: 746px;\"><span style=\"color: rgb(51, 51, 51); font-family: Arial; font-size: 12px; text-align: justify;\"><br></span></p><p><span style=\"color: rgb(51, 51, 51); font-family: Arial; font-size: 12px; text-align: justify;\"><br></span><strong style=\"font-family: Arial; color: rgb(51, 51, 51); font-size: 12px; text-align: justify;\">CÁCH CHÈO THUYỀN KAYAK</strong><br style=\"font-family: Arial; color: rgb(51, 51, 51); font-size: 12px; text-align: justify;\"><span style=\"color: rgb(51, 51, 51); font-family: Arial; font-size: 12px; text-align: justify;\">&nbsp;</span><br style=\"font-family: Arial; color: rgb(51, 51, 51); font-size: 12px; text-align: justify;\"><span style=\"color: rgb(51, 51, 51); font-family: Arial; font-size: 12px; text-align: justify;\">Để bắt đầu chèo thuyền kayak, hãy ngồi vào trong thuyền. Đặt lưng của bạn sát về phía sau ghế ngồi, đầu gối của bạn nên để cong thoải mái. Để tìm được điểm đặt chân phù hợp, duỗi thẳng chân ra và co lại một nấc. Nếu bạn đặt chân quá thẳng, bạn sẽ cảm nhận thấy áp lực bị đè nén lên phần lưng dưới. Nếu chân bạn cong quá nhiều thì có thể sẽ va đụng vào bộ phận cố định đầu gối của thuyền khi bạn chèo.</span><br style=\"font-family: Arial; color: rgb(51, 51, 51); font-size: 12px; text-align: justify;\"><br style=\"font-family: Arial; color: rgb(51, 51, 51); font-size: 12px; text-align: justify;\"><span style=\"color: rgb(51, 51, 51); font-family: Arial; font-size: 12px; text-align: justify;\">Để tìm được vị trí đặt tay trên mái chèo, hãy bắt đầu với hai cánh tay để song song chính giữa và rộng bằng vai. Khi bạn đưa mái chèo lên phía trên đỉnh đầu thì khuỷu tay cần tạo một góc gần bằng 90º. Độ dài phần lưỡi và phần cán của mái chèo phía ngoài vị trí cầm tay của bạn cần đều nhau.</span><br style=\"font-family: Arial; color: rgb(51, 51, 51); font-size: 12px; text-align: justify;\"><span style=\"color: rgb(51, 51, 51); font-family: Arial; font-size: 12px; text-align: justify;\">&nbsp;</span><br style=\"font-family: Arial; color: rgb(51, 51, 51); font-size: 12px; text-align: justify;\"><span style=\"color: rgb(51, 51, 51); font-family: Arial; font-size: 12px; text-align: justify;\">Mái chèo chia làm 2 loại:&nbsp;feathered&nbsp;or&nbsp;nonfeathered. Loại mài chèo “nonfeathered” được bố trí 2 lưỡi chèo nằm trên cùng một đường thẳng và mặt phẳng. Loại mài chèo “feathered” không như vậy, chúng được bố trị lệch nhau một góc nhất định.</span></p><p><span style=\"color: rgb(51, 51, 51); font-family: Arial; font-size: 12px; text-align: justify;\"><br></span><img src=\"https://wetrek.vn/pic/service/images/635648904576596702.jpg.ashx\" style=\"width: 746px;\"></p><div style=\"font-family: Arial; color: rgb(51, 51, 51); font-size: 12px; text-align: justify;\">Lợi ích chính của việc xoay lưỡi mái chèo là giảm sức cản của gió và giảm mệt mỏi cho cổ tay, bởi 1 mái lưỡi chèo quạt xuống nước thì lưỡi mái chèo còn lại sẽ lướt qua gió. Hai lưỡi mái chèo loại này thông thường xoay lệch một góc từ 30 đến 45°. Góc nhỏ hơn thì cổ tay hoạt động dễ dàng hơn; góc rộng hơn thì hiệu quả chèo thuyền lớn hơn.<br style=\"font-family: inherit !important;\">&nbsp;<br style=\"font-family: inherit !important;\">Mái chèo xoay được chế tạo sao cho có một tay luôn duy trì điều khiển. Tay điều khiển này sẽ xoay cán mái chèo ở mỗi lượt chèo sao cho lưỡi mái chèo tiếp nước ở một góc hiệu quả nhất. Phần lớn mái chèo đổ thác được điều khiển bằng tay phải. Phần lớn mái chèo du lịch có cán tháo rời cho phép thay đổi tay điều khiển, thay đổi góc lệch giữa 2 lưỡi mái chèo. Tay điểu khiển là tay nào tuỳ thuộc vào sở thích cá nhân, không cần thiết phải xác định rõ bằng việc bạn thuận tay nào.</div><div style=\"font-family: Arial; color: rgb(51, 51, 51); font-size: 12px; text-align: justify;\"><br></div><p style=\"font-family: Arial; color: rgb(51, 51, 51); font-size: 12px; text-align: justify;\">&nbsp;<iframe frameborder=\"0\" src=\"//www.youtube.com/embed/hUgDjWQPMsI\" width=\"640\" height=\"360\" class=\"note-video-clip\"></iframe></p><p style=\"font-family: Arial; color: rgb(51, 51, 51); font-size: 12px; text-align: justify;\"><br></p><p style=\"font-family: Arial; color: rgb(51, 51, 51); font-size: 12px; text-align: justify;\">Cách chèo thuyền có bản là chèo về phía trước. Đặt lưỡi chèo xuống vùng nước ngang mũi chân bạn, sau đó kéo về phía sau tới ngang hông. Nhấc lưỡi chèo lên và chèo tiếp ở bên còn lại<br>&nbsp;<br><strong>KIỂU CHÈO THUYỀN KAYAK</strong><br>&nbsp;<br>Chèo thuyền kayak góc thấp là kiểu chèo thư giãn với nhịp chèo chậm, hiệu quả cho các chuyển đi dài. Góc của lưỡi mái chèo bẹt hơn (nằm ngang hơn) khi vào nước nên lưỡi mái chèo góc thấp thường dẹt hơn và dài hơn một chút cho với lưỡi mái chèo góc cao.<br>&nbsp;<br>Chèo thuyền kayak góc cao là kiểu chèo mạnh mẽ hơn với nhịp chèo nhanh hơn, được ưa chuộng sử dụng nếu bạn thấy khả năng tăng tốc và cơ động khi di chuyển dưới nước là quan trọng. Bởi khi đó cần nhiều lực đẩy cho mỗi lần chèo. Đây cũng là một lựa chọn tốt cho việc luyện tập sức khoẻ.</p><p style=\"font-family: Arial; color: rgb(51, 51, 51); font-size: 12px; text-align: justify;\"><br></p><p style=\"font-family: Arial; color: rgb(51, 51, 51); font-size: 12px; text-align: justify;\"><img src=\"https://wetrek.vn/pic/service/images/635648904597277885.jpg.ashx\" style=\"width: 100%;\"></p><p style=\"font-family: Arial; color: rgb(51, 51, 51); font-size: 12px; text-align: justify;\"><strong><br></strong></p><p style=\"font-family: Arial; color: rgb(51, 51, 51); font-size: 12px; text-align: justify;\"><strong>LƯU Ý KHI CHÈO THUYỀN KAYAK</strong><br>&nbsp;<br>Thuyền Kayak rất dễ sử dụng. Hãy bắt đầu thử ở vùng nước lặng, bạn sẽ có thể dần thích nghi với cảm giác ngồi trên thuyền và kỹ thuật chèo thuyền, luyện tập trèo ra và vào buồng lái. Mái chèo dài sẽ cho phép bạn chèo với bước chèo dài hơn nhưng chậm hơn so với mái chèo ngắn. Khi chèo thuyền, hãy lỏng tay, không cần gồng cứng hay cầm quá chặt.<br>&nbsp;<br>Ngồi với tư thế thoải mái, giữ cho thân thẳng, chọn vị trí đặt chân sao cho đầu gối hơi cong. Để tăng hiệu quả chèo thuyền kayak, không chỉ sử dụng tay mà hãy dùng cả vai và lưng, cơ bụng. Nhưng&nbsp; người chèo thuyền có kinh nghiệm thường sử dụng mái chèo “feathered”, tuy nhiên những người mới bắt đầu chèo thuyền thường thích mái chèo có lưỡi chèo vuông.</p><p style=\"font-family: Arial; color: rgb(51, 51, 51); font-size: 12px; text-align: justify;\"><br></p><p style=\"font-family: Arial; color: rgb(51, 51, 51); font-size: 12px; text-align: justify;\"><strong style=\"text-align: right;\">Ethan Nguyen.</strong><br></p>', '2021-05-25 21:20:05', '2021-06-05 13:01:05', '1', '1')";
		execute($sql);

		$sql="INSERT INTO `places` (`id`, `title`, `content`, `created_at`, `updated_at`, `user_id`, `thumbnail`, `description`) VALUES (NULL, 'Milford Soundd', '<p style=\"font-family: Verdana, Geneva, sans-serif; font-size: 15px; line-height: 26px; margin-bottom: 26px; overflow-wrap: break-word; color: rgb(34, 34, 34);\">Milford Sound là một trong các <strong>phong cảnh đẹp nhất thế giới</strong> ở phía tây nam của Đảo Nam của New Zealand. Nó được biết đến với Đỉnh Mitre cao chót vót. Cộng với rừng nhiệt đới và thác nước như thác Stirling và thác Bowen, đổ xuống các mặt tuyệt đẹp của nó. </p><p style=\"font-family: Verdana, Geneva, sans-serif; font-size: 15px; line-height: 26px; margin-bottom: 26px; overflow-wrap: break-word; color: rgb(34, 34, 34);\"><img src=\"https://1hot.vn/wp-content/uploads/2020/10/phong-canh-dep-nhat-the-gioi-4.jpg\" style=\"width: 546px;\"><br></p><p style=\"font-family: Verdana, Geneva, sans-serif; font-size: 15px; line-height: 26px; margin-bottom: 26px; overflow-wrap: break-word; color: rgb(34, 34, 34);\">Fiord là nơi sinh sống của các đàn hải cẩu lông, chim cánh cụt và cá heo. Trung tâm Khám phá Milford và Đài quan sát dưới nước có tầm nhìn ra san hô đen quý hiếm và các sinh vật biển khác. Các chuyến tham quan bằng thuyền là một cách phổ biến để khám phá cảnh đẹp nơi đây. </p><p style=\"font-family: Verdana, Geneva, sans-serif; font-size: 15px; line-height: 26px; margin-bottom: 26px; overflow-wrap: break-word; color: rgb(34, 34, 34);\">Milford Sound thu hút từ 550.000 đến 1 triệu du khách mỗi năm. Điều này làm cho Sound trở thành một trong những điểm du lịch được ghé thăm nhiều nhất của New Zealand. Đây còn là một trong những điểm đến tốt nhất thế giới để nhảy dù. Nhiều du khách tham gia một trong những chuyến tham quan bằng thuyền thường kéo dài từ một đến hai giờ.</p><p style=\"font-family: Verdana, Geneva, sans-serif; font-size: 15px; line-height: 26px; margin-bottom: 26px; overflow-wrap: break-word; color: rgb(34, 34, 34);\">Đặc trưng:</p><ul style=\"padding: 0px; margin-bottom: 26px; color: rgb(34, 34, 34); font-family: Verdana, Geneva, sans-serif; font-size: 15px;\"><li style=\"line-height: 26px; margin-left: 21px;\">Cảnh quan: Cửa biển ở Thung lũng Gal Justice</li><li style=\"line-height: 26px; margin-left: 21px;\">Địa điểm: Fiordland, New Zealand</li><li style=\"line-height: 26px; margin-left: 21px;\">Độ cao: 1.692 mét (5.551 ft)</li><li style=\"line-height: 26px; margin-left: 21px;\">Thời gian tốt nhất để ghé thăm: tháng 11 đến tháng 3</li><li style=\"line-height: 26px; margin-left: 21px;\">Diện tích vùng vịnh: 25 km² </li></ul>', '2021-05-25 22:26:38', '2021-05-30 13:39:59', '1', 'https://1hot.vn/wp-content/uploads/2020/10/phong-canh-dep-nhat-the-gioi-4.jpg', 'Milford Sound là một trong các phong cảnh đẹp nhất thế giới ở phía tây nam của Đảo Nam của New Zealand. Nó được biết đến với Đỉnh Mitre cao chót vót. Cộng với rừng nhiệt đới và thác nước như thác Stirling và thác Bowen, đổ xuống các mặt tuyệt đẹp của nó...')
			";
		execute($sql);

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
