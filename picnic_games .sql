-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th6 23, 2021 lúc 07:36 AM
-- Phiên bản máy phục vụ: 10.4.18-MariaDB
-- Phiên bản PHP: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `picnic_games`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `albums`
--

CREATE TABLE `albums` (
  `id` int(11) NOT NULL,
  `title` varchar(200) DEFAULT NULL,
  `thumbnail` varchar(200) DEFAULT NULL,
  `description` varchar(500) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `game_id` int(11) DEFAULT NULL,
  `views` int(11) DEFAULT 1000
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `albums`
--

INSERT INTO `albums` (`id`, `title`, `thumbnail`, `description`, `created_at`, `updated_at`, `game_id`, `views`) VALUES
(1, 'Game Kayak - Phú Quốc', 'https://phuquocxanh.com/vi/wp-content/uploads/2018/04/du-lich-phu-quoc-005.jpg', 'Chụp tại Phú Quốc', '2021-06-22 18:39:03', '2021-06-22 18:39:03', 1, 1003),
(2, 'Kayak - Hạ Long', 'https://cdn.haikayak.com/wp-content/uploads/2016/11/cheo-kayak-4.jpg', 'Chụp tại Hạ Long', '2021-06-22 18:40:27', '2021-06-22 18:40:27', 1, 1003),
(3, 'Đu dây thử thách', 'https://notimefortravel.com/wp-content/uploads/2018/01/Cu%E1%BB%99cPhi%C3%AAuL%C6%B0u%C4%90uD%C3%A2yB%C4%83ngQuaR%E1%BB%ABng.jpg', 'Đu dây thử thách', '2021-06-22 18:49:50', '2021-06-22 18:49:50', 2, 1003),
(4, 'kayak kids 01', 'https://outdoorcraving.com/wp-content/uploads/2021/05/Kayaking_with_Kids_Bay_Sports_1024x1024.jpeg', 'for kids', '2021-06-23 03:41:42', '2021-06-23 03:41:42', 5, 1000),
(5, 'kids kéo co', 'http://icdn.dantri.com.vn/zoom/1200_630/59245d4683/2015/12/03/keo-co-2-1449080334431.jpg', 'Giành cho trẻ em', '2021-06-23 03:57:06', '2021-06-23 03:57:06', 8, 1000),
(6, 'Kéo co', 'https://3.bp.blogspot.com/-RWYuKTJSUfo/WYZ5qd7MDdI/AAAAAAAAAto/Z0TgxNrBuCgoOXFvHZPAmeGQ9Ai7M7zzQCEwYBhgL/s1600/3.jpg', 'kéo co ', '2021-06-23 04:15:09', '2021-06-23 04:15:09', 4, 1000),
(7, 'Du dây trên mặt nước', 'https://thamhiemmekong.com/wp-content/uploads/2019/05/team-building-con-phung-2.jpg', 'Du dây trên mặt nước', '2021-06-23 04:22:51', '2021-06-23 04:25:26', 3, 1000),
(8, 'Đu dây thử thách - 02', 'http://songchaugroup.com/images/uploads/115.jpg', 'Đu dây 02', '2021-06-23 04:34:17', '2021-06-23 04:34:17', 6, 1000);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `category`
--

INSERT INTO `category` (`id`, `title`, `created_at`, `updated_at`) VALUES
(1, 'Outdoor', '2021-05-25 20:46:16', '2021-06-22 17:10:43'),
(2, 'Indoor', '2021-06-22 17:10:21', '2021-06-22 17:10:21'),
(3, 'Kids', '2021-06-22 17:10:29', '2021-06-22 17:10:29');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `page_code` varchar(50) NOT NULL,
  `guest_name` varchar(100) DEFAULT NULL,
  `content` varchar(500) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `avatar` varchar(500) DEFAULT 'https://icdn.dantri.com.vn/images/no-avatar.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `comments`
--

INSERT INTO `comments` (`id`, `page_code`, `guest_name`, `content`, `created_at`, `avatar`) VALUES
(1, 'games_detail.php?id=1', 'Supper Man', 'game này hay lắm nè các bạn ơi', '2021-06-22 19:00:15', 'https://icdn.dantri.com.vn/images/no-avatar.png'),
(2, 'games_detail.php?id=2', 'John Wick', 'Nhìn ghê quá ,mình không dám chơi đâu', '2021-06-23 06:09:48', 'https://icdn.dantri.com.vn/images/no-avatar.png'),
(3, 'games_detail.php?id=5', 'Ka ka', 'Các cháu nhà mình thích chơi trò này lắm', '2021-06-23 06:10:59', 'https://icdn.dantri.com.vn/images/no-avatar.png'),
(4, 'games_detail.php?id=6', 'Bá Kiến', 'Game hay nhưng hơi đắt . Giảm giá 50% thì mình chơi', '2021-06-23 06:11:57', 'https://icdn.dantri.com.vn/images/no-avatar.png'),
(5, 'games_detail.php?id=3', 'Aqua Man', 'Hôm nọ mình chơi bị uống no nước hồ luôn :)) ', '2021-06-23 06:12:43', 'https://icdn.dantri.com.vn/images/no-avatar.png'),
(6, 'games_detail.php?id=4', 'Cụ Già', 'Các cháu nhìn đáng yêu quá ', '2021-06-23 06:13:18', 'https://icdn.dantri.com.vn/images/no-avatar.png'),
(7, 'games_detail.php?id=4', 'Picnic Team - admin', 'Hi', '2021-06-23 06:17:54', 'https://scontent-hkg4-2.xx.fbcdn.net/v/t1.6435-9/54514819_2121950994761484_2297120214103359488_n.jpg?_nc_cat=109&ccb=1-3&_nc_sid=174925&_nc_ohc=Zz0gF1ubXwgAX8WE0Yn&_nc_ht=scontent-hkg4-2.xx&oh=4d0720d02591c4740153042bfb7c87f3&oe=60E34D5E'),
(8, 'albums.php?', 'Picnic Team - admin', 'Rất mong nhận được sự đóng góp ý kiến của các bạn !', '2021-06-23 07:16:47', 'https://scontent-hkg4-2.xx.fbcdn.net/v/t1.6435-9/54514819_2121950994761484_2297120214103359488_n.jpg?_nc_cat=109&ccb=1-3&_nc_sid=174925&_nc_ohc=Zz0gF1ubXwgAX8WE0Yn&_nc_ht=scontent-hkg4-2.xx&oh=4d0720d02591c4740153042bfb7c87f3&oe=60E34D5E'),
(9, 'places.php?', 'Messi', 'Tuyệt vời !', '2021-06-23 07:18:08', 'https://icdn.dantri.com.vn/images/no-avatar.png');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `address` varchar(200) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `customers`
--

INSERT INTO `customers` (`id`, `fullname`, `phone`, `address`, `created_at`) VALUES
(1, 'Khách 1', '0911111111', 'Hà Nội', '2021-01-20 00:00:00'),
(2, 'Khách 2', '0911111112', 'Hà Nội', '2021-02-20 00:00:00'),
(3, 'Khách 3', '0911111113', 'Hà Nội', '2021-03-20 00:00:00'),
(4, 'Khách 4', '0911111114', 'Hà Nội', '2021-04-20 00:00:00'),
(5, 'Khách 5', '0911111115', 'Hà Nội', '2021-05-20 00:00:00'),
(6, 'Khách 6', '0911111116', 'Hà Nội', '2021-06-20 00:00:00'),
(7, 'Lâm Sung', '0987-333-333', 'Hà Nội', '2021-06-22 18:22:49'),
(8, 'Chí Phèo', '0986-345-234', 'Hải Phòng', '2021-06-22 18:24:15'),
(9, 'Nam Cao', '0865-234-532', 'Hải Dương', '2021-06-22 18:24:59'),
(10, 'Lão Hạc', '0988-888-888', 'Nam Định', '2021-06-22 18:31:07'),
(11, 'Hoàng Su Phì', '0986-353-234', 'Hà Giang', '2021-06-22 19:02:25'),
(12, 'Lâm Hùng', '0765-234-244', 'HCM', '2021-06-22 19:06:14');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `games`
--

CREATE TABLE `games` (
  `id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `thumbnail` varchar(200) DEFAULT NULL,
  `price` float NOT NULL,
  `description` varchar(500) NOT NULL,
  `content` longtext NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `cate_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `views` int(11) DEFAULT 1000
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `games`
--

INSERT INTO `games` (`id`, `title`, `thumbnail`, `price`, `description`, `content`, `created_at`, `updated_at`, `cate_id`, `user_id`, `views`) VALUES
(1, 'Chèo thuyền kayak', 'https://www.adventurebritain.com/wp-content/uploads/2015/09/kayaking-1.jpg', 80000, 'Bạn cần biết cách chèo thuyền, hướng dẫn cố định bàn chân, đùi khi chèo thuyền và kỹ năng giải cứu khi gặp nạn. Không chỉ riêng với chèo thuyền kayak mà với bất kỳ một hoạt động dã ngoại nào...', '<p><span style=\"color: rgb(51, 51, 51); font-family: Arial; font-size: 12px; text-align: justify;\">Việc tham khảo các hướng dẫn cơ bản trước khi bạn bắt đầu chèo thuyền kayak là điều rất quan trọng. Nếu có, hãy tham giá các lớp học chèo thuyền do những đại lý bán lẻ kayak hoặc các câu lạc bộ chèo thuyền kayak tổ chức ở địa phương bạn.</span><br style=\"font-family: Arial; color: rgb(51, 51, 51); font-size: 12px; text-align: justify;\"><br style=\"font-family: Arial; color: rgb(51, 51, 51); font-size: 12px; text-align: justify;\"><span style=\"color: rgb(51, 51, 51); font-family: Arial; font-size: 12px; text-align: justify;\">Bạn cần biết cách chèo thuyền, hướng dẫn cố định bàn chân, đùi khi chèo thuyền và kỹ năng giải cứu khi gặp nạn. Không chỉ riêng với chèo thuyền kayak mà với bất kỳ một hoạt động dã ngoại nào, bạn cũng cần phải làm quen sử dụng bộ sơ cứu y tế khẩn cấp, kỹ năng hồi sức tim phổi (CPR), cách xử lý việc bị hạ thân nhiệt.</span></p><p><span style=\"color: rgb(51, 51, 51); font-family: Arial; font-size: 12px; text-align: justify;\"><br></span><strong style=\"font-family: Arial; color: rgb(51, 51, 51); font-size: 12px; text-align: justify;\">CÁCH CHÈO THUYỀN KAYAK</strong><br style=\"font-family: Arial; color: rgb(51, 51, 51); font-size: 12px; text-align: justify;\"><span style=\"color: rgb(51, 51, 51); font-family: Arial; font-size: 12px; text-align: justify;\"> </span><br style=\"font-family: Arial; color: rgb(51, 51, 51); font-size: 12px; text-align: justify;\"><span style=\"color: rgb(51, 51, 51); font-family: Arial; font-size: 12px; text-align: justify;\">Để bắt đầu chèo thuyền kayak, hãy ngồi vào trong thuyền. Đặt lưng của bạn sát về phía sau ghế ngồi, đầu gối của bạn nên để cong thoải mái. Để tìm được điểm đặt chân phù hợp, duỗi thẳng chân ra và co lại một nấc. Nếu bạn đặt chân quá thẳng, bạn sẽ cảm nhận thấy áp lực bị đè nén lên phần lưng dưới. Nếu chân bạn cong quá nhiều thì có thể sẽ va đụng vào bộ phận cố định đầu gối của thuyền khi bạn chèo.</span><br style=\"font-family: Arial; color: rgb(51, 51, 51); font-size: 12px; text-align: justify;\"><br style=\"font-family: Arial; color: rgb(51, 51, 51); font-size: 12px; text-align: justify;\"><span style=\"color: rgb(51, 51, 51); font-family: Arial; font-size: 12px; text-align: justify;\">Để tìm được vị trí đặt tay trên mái chèo, hãy bắt đầu với hai cánh tay để song song chính giữa và rộng bằng vai. Khi bạn đưa mái chèo lên phía trên đỉnh đầu thì khuỷu tay cần tạo một góc gần bằng 90º. Độ dài phần lưỡi và phần cán của mái chèo phía ngoài vị trí cầm tay của bạn cần đều nhau.</span><br style=\"font-family: Arial; color: rgb(51, 51, 51); font-size: 12px; text-align: justify;\"><span style=\"color: rgb(51, 51, 51); font-family: Arial; font-size: 12px; text-align: justify;\"> </span><br style=\"font-family: Arial; color: rgb(51, 51, 51); font-size: 12px; text-align: justify;\"><span style=\"color: rgb(51, 51, 51); font-family: Arial; font-size: 12px; text-align: justify;\">Mái chèo chia làm 2 loại: feathered or nonfeathered. Loại mài chèo “nonfeathered” được bố trí 2 lưỡi chèo nằm trên cùng một đường thẳng và mặt phẳng. Loại mài chèo “feathered” không như vậy, chúng được bố trị lệch nhau một góc nhất định.</span></p><p><span style=\"color: rgb(51, 51, 51); font-family: Arial; font-size: 12px; text-align: justify;\"><br></span><img src=\"https://wetrek.vn/pic/service/images/635648904576596702.jpg.ashx\" style=\"width: 746px;\"></p><div style=\"font-family: Arial; color: rgb(51, 51, 51); font-size: 12px; text-align: justify;\">Lợi ích chính của việc xoay lưỡi mái chèo là giảm sức cản của gió và giảm mệt mỏi cho cổ tay, bởi 1 mái lưỡi chèo quạt xuống nước thì lưỡi mái chèo còn lại sẽ lướt qua gió. Hai lưỡi mái chèo loại này thông thường xoay lệch một góc từ 30 đến 45°. Góc nhỏ hơn thì cổ tay hoạt động dễ dàng hơn; góc rộng hơn thì hiệu quả chèo thuyền lớn hơn.<br style=\"font-family: inherit !important;\"> <br style=\"font-family: inherit !important;\">Mái chèo xoay được chế tạo sao cho có một tay luôn duy trì điều khiển. Tay điều khiển này sẽ xoay cán mái chèo ở mỗi lượt chèo sao cho lưỡi mái chèo tiếp nước ở một góc hiệu quả nhất. Phần lớn mái chèo đổ thác được điều khiển bằng tay phải. Phần lớn mái chèo du lịch có cán tháo rời cho phép thay đổi tay điều khiển, thay đổi góc lệch giữa 2 lưỡi mái chèo. Tay điểu khiển là tay nào tuỳ thuộc vào sở thích cá nhân, không cần thiết phải xác định rõ bằng việc bạn thuận tay nào.</div><div style=\"font-family: Arial; color: rgb(51, 51, 51); font-size: 12px; text-align: justify;\"><br></div><p style=\"font-family: Arial; color: rgb(51, 51, 51); font-size: 12px; text-align: justify;\"> </p><p style=\"font-family: Arial; color: rgb(51, 51, 51); font-size: 12px; text-align: justify;\"><br></p><p style=\"font-family: Arial; color: rgb(51, 51, 51); font-size: 12px; text-align: justify;\">Cách chèo thuyền có bản là chèo về phía trước. Đặt lưỡi chèo xuống vùng nước ngang mũi chân bạn, sau đó kéo về phía sau tới ngang hông. Nhấc lưỡi chèo lên và chèo tiếp ở bên còn lại<br> <br><strong>KIỂU CHÈO THUYỀN KAYAK</strong><br> <br>Chèo thuyền kayak góc thấp là kiểu chèo thư giãn với nhịp chèo chậm, hiệu quả cho các chuyển đi dài. Góc của lưỡi mái chèo bẹt hơn (nằm ngang hơn) khi vào nước nên lưỡi mái chèo góc thấp thường dẹt hơn và dài hơn một chút cho với lưỡi mái chèo góc cao.<br> <br>Chèo thuyền kayak góc cao là kiểu chèo mạnh mẽ hơn với nhịp chèo nhanh hơn, được ưa chuộng sử dụng nếu bạn thấy khả năng tăng tốc và cơ động khi di chuyển dưới nước là quan trọng. Bởi khi đó cần nhiều lực đẩy cho mỗi lần chèo. Đây cũng là một lựa chọn tốt cho việc luyện tập sức khoẻ.</p><p style=\"font-family: Arial; color: rgb(51, 51, 51); font-size: 12px; text-align: justify;\"><br></p><p style=\"font-family: Arial; color: rgb(51, 51, 51); font-size: 12px; text-align: justify;\"><img src=\"https://wetrek.vn/pic/service/images/635648904597277885.jpg.ashx\" style=\"width: 100%;\"></p><p style=\"font-family: Arial; color: rgb(51, 51, 51); font-size: 12px; text-align: justify;\"><strong><br></strong></p><p style=\"font-family: Arial; color: rgb(51, 51, 51); font-size: 12px; text-align: justify;\"><strong>LƯU Ý KHI CHÈO THUYỀN KAYAK</strong><br> <br>Thuyền Kayak rất dễ sử dụng. Hãy bắt đầu thử ở vùng nước lặng, bạn sẽ có thể dần thích nghi với cảm giác ngồi trên thuyền và kỹ thuật chèo thuyền, luyện tập trèo ra và vào buồng lái. Mái chèo dài sẽ cho phép bạn chèo với bước chèo dài hơn nhưng chậm hơn so với mái chèo ngắn. Khi chèo thuyền, hãy lỏng tay, không cần gồng cứng hay cầm quá chặt.<br> <br>Ngồi với tư thế thoải mái, giữ cho thân thẳng, chọn vị trí đặt chân sao cho đầu gối hơi cong. Để tăng hiệu quả chèo thuyền kayak, không chỉ sử dụng tay mà hãy dùng cả vai và lưng, cơ bụng. Nhưng  người chèo thuyền có kinh nghiệm thường sử dụng mái chèo “feathered”, tuy nhiên những người mới bắt đầu chèo thuyền thường thích mái chèo có lưỡi chèo vuông.</p><p style=\"font-family: Arial; color: rgb(51, 51, 51); font-size: 12px; text-align: justify;\"><br></p><p style=\"font-family: Arial; color: rgb(51, 51, 51); font-size: 12px; text-align: justify;\"><strong style=\"text-align: right;\">Ethan Nguyen.</strong><br></p>', '2021-05-25 21:20:05', '2021-06-23 04:39:08', 1, 1, 1014),
(2, 'Game đu dây vượt qua thử thách', 'https://www.notimefortravel.com/wp-content/uploads/2018/01/Cu%E1%BB%99cPhi%C3%AAuL%C6%B0u%C4%90uD%C3%A2yB%C4%83ngQuaR%E1%BB%ABng.jpg', 90000, 'Đây là một trong những trò chơi cắm trại yêu cầu rất cao về thể lực của người chơi. Bạn phải lần lượt vượt qua các thử thách của trò chơi do ban tổ chức đưa ra...', '<p style=\"font-family: Verdana, Geneva, sans-serif; font-size: 15px; line-height: 26px; margin-bottom: 26px; overflow-wrap: break-word; color: rgb(34, 34, 34);\">Đây là một trong những trò chơi cắm trại yêu cầu rất cao về thể lực của người chơi. Bạn phải lần lượt vượt qua các thử thách của trò chơi do ban tổ chức đưa ra. Ngoài thể lực là yếu tố chính thì sự khéo léo trong từng bước di chuyển sẽ giúp bạn dễ dàng vượt qua thử thách một cách dễ dàng nhất.</p><p style=\"font-family: Verdana, Geneva, sans-serif; font-size: 15px; line-height: 26px; margin-bottom: 26px; overflow-wrap: break-word; color: rgb(34, 34, 34);\">Với trò chơi này các bạn có thể tham gia cá nhân hoặc tham gia theo nhóm. Tuy nhiên, nếu đi cắm trại cùng tập thể thì cả nhóm sẽ được chia thành các đội chơi nhỏ, mỗi đội chơi có khoảng 5-7 thành viên. Mỗi đội chơi sẽ cử lần lượt cử các thành viên để tham gia. Một thành viên của đội A sẽ thi đấu với một thành viên của đội B. Đội nào có số thành viên về đích trong thời gian nhanh nhất sẽ là đội dành chiến thắng.</p>', '2021-06-22 17:12:11', '2021-06-23 04:39:00', 1, 1, 1007),
(3, 'Game đu dây dưới nước', 'https://thamhiemmekong.com/wp-content/uploads/2019/05/team-building-con-phung-2.jpg', 50000, 'Tương tự như game đu dây qua cầu, tuy nhiên trò chơi này được thực hiện dưới nước. Tuy nhiên nếu bạn là người sợ nước thì cũng có thể cân nhắc trước khi tham gia trò chơi này.', '<p><span style=\"color: rgb(34, 34, 34); font-family: Verdana, Geneva, sans-serif; font-size: 15px;\">Tương tự như game đu dây qua cầu, tuy nhiên trò chơi này được thực hiện dưới nước. Nhiệm vụ của bạn là băng qua sông trong thời gian nhanh nhất mà không để bị té xuống nước, khi tham gia trò chơi này sẽ có những người bảo hộ phía dưới để cứu bạn khi bạn bị té. Tuy nhiên nếu bạn là người sợ nước thì cũng có thể cân nhắc trước khi tham gia trò chơi này.</span><br></p>', '2021-06-22 17:14:35', '2021-06-23 04:26:01', 1, 1, 1010),
(4, 'Trò chơi kéo co', 'https://thuthuatchoi.com/media/photos/shares/trochoidangian/keoco/C__ch_ch__i_k__o_co.jpg', 60000, ' Mặc dù đây là một trong những trò chơi cắm trại dân gian mà ai cũng biết nhưng với mình thì kéo co là một trong những trò chơi tập thể ngoài trời khá thú vị', '<p style=\"font-family: Verdana, Geneva, sans-serif; font-size: 15px; line-height: 26px; margin-bottom: 26px; overflow-wrap: break-word; color: rgb(34, 34, 34);\">Bạn nghĩ sao về trò chơi này? Mặc dù đây là một trong những <a href=\"https://notimefortravel.com/tro-choi-cam-trai/\" style=\"color: rgb(57, 153, 152);\">trò chơi cắm trại</a> dân gian mà ai cũng biết nhưng với mình thì kéo co là một trong những trò chơi tập thể ngoài trời khá thú vị. Cách chơi không khó, dụng cụ chơi cũng không cần phải chuẩn bị nhiều thứ nhưng điều mang lại cho chúng ta chính là sự kết nối, tinh thần đoàn kết, thể hiện được sức mạnh của tập thể. “Một cây làm chẳng lên non, ba cây chụm lại nên hòn núi cao”</p><p style=\"font-family: Verdana, Geneva, sans-serif; font-size: 15px; line-height: 26px; margin-bottom: 26px; overflow-wrap: break-word; color: rgb(34, 34, 34);\">Thể lệ trò chơi như sau, các bạn sẽ chia các thành viên trong đoàn của mình thành 2 nhóm, mỗi nhóm tối thiểu là 10 người. Chuẩn bị sẵn một sợ dây thừng chắc chắn, vẽ một vạch ngăn ở giữa, đồng thời buộc một sợ dây đỏ vào chính giữa sợi dây thừng. 2 đội cầm 2 đầu dây, đứng về 2 phía, khi đội trưởng thổi còi hô trận đấu bắt đầu cũng là lúc 2 đội dồn toàn sức lực làm sao để có thể kéo được đội bạn giẫm chân qua vạch kẻ ban đầu thì đó là đội chơi dành chiến thắng.</p><p style=\"font-family: Verdana, Geneva, sans-serif; font-size: 15px; line-height: 26px; margin-bottom: 26px; overflow-wrap: break-word; color: rgb(34, 34, 34);\">Tham gia trò chơi tập thể ngoài trời này các bạn sẽ được hô hò, tinh thần đồng đội lên cao giúp các thành viên trở nên đoàn kết và thân thiết với nhau hơn.</p>', '2021-06-22 17:18:08', '2021-06-22 18:00:32', 3, 1, 1010),
(5, 'Chèo thuyền kayak 02', 'https://previews.123rf.com/images/famveldman/famveldman2006/famveldman200600015/149827489-kids-kayaking-in-ocean-children-in-kayak-in-tropical-sea-active-vacation-with-young-kid-parents-litt.jpg', 80000, 'Bạn cần biết cách chèo thuyền, hướng dẫn cố định bàn chân, đùi khi chèo thuyền và kỹ năng giải cứu khi gặp nạn. Không chỉ riêng với chèo thuyền kayak mà với bất kỳ một hoạt động dã ngoại nào...', '<p><span style=\"color: rgb(51, 51, 51); font-family: Arial; font-size: 12px; text-align: justify;\">Việc tham khảo các hướng dẫn cơ bản trước khi bạn bắt đầu chèo thuyền kayak là điều rất quan trọng. Nếu có, hãy tham giá các lớp học chèo thuyền do những đại lý bán lẻ kayak hoặc các câu lạc bộ chèo thuyền kayak tổ chức ở địa phương bạn.</span><br style=\"font-family: Arial; color: rgb(51, 51, 51); font-size: 12px; text-align: justify;\"><br style=\"font-family: Arial; color: rgb(51, 51, 51); font-size: 12px; text-align: justify;\"><span style=\"color: rgb(51, 51, 51); font-family: Arial; font-size: 12px; text-align: justify;\">Bạn cần biết cách chèo thuyền, hướng dẫn cố định bàn chân, đùi khi chèo thuyền và kỹ năng giải cứu khi gặp nạn. Không chỉ riêng với chèo thuyền kayak mà với bất kỳ một hoạt động dã ngoại nào, bạn cũng cần phải làm quen sử dụng bộ sơ cứu y tế khẩn cấp, kỹ năng hồi sức tim phổi (CPR), cách xử lý việc bị hạ thân nhiệt.</span></p><p><br></p><p><strong style=\"font-family: Arial; color: rgb(51, 51, 51); font-size: 12px; text-align: justify;\">CÁCH CHÈO THUYỀN KAYAK</strong><br style=\"font-family: Arial; color: rgb(51, 51, 51); font-size: 12px; text-align: justify;\"><span style=\"color: rgb(51, 51, 51); font-family: Arial; font-size: 12px; text-align: justify;\"> </span><br style=\"font-family: Arial; color: rgb(51, 51, 51); font-size: 12px; text-align: justify;\"><span style=\"color: rgb(51, 51, 51); font-family: Arial; font-size: 12px; text-align: justify;\">Để bắt đầu chèo thuyền kayak, hãy ngồi vào trong thuyền. Đặt lưng của bạn sát về phía sau ghế ngồi, đầu gối của bạn nên để cong thoải mái. Để tìm được điểm đặt chân phù hợp, duỗi thẳng chân ra và co lại một nấc. Nếu bạn đặt chân quá thẳng, bạn sẽ cảm nhận thấy áp lực bị đè nén lên phần lưng dưới. Nếu chân bạn cong quá nhiều thì có thể sẽ va đụng vào bộ phận cố định đầu gối của thuyền khi bạn chèo.</span><br style=\"font-family: Arial; color: rgb(51, 51, 51); font-size: 12px; text-align: justify;\"><br style=\"font-family: Arial; color: rgb(51, 51, 51); font-size: 12px; text-align: justify;\"><span style=\"color: rgb(51, 51, 51); font-family: Arial; font-size: 12px; text-align: justify;\">Để tìm được vị trí đặt tay trên mái chèo, hãy bắt đầu với hai cánh tay để song song chính giữa và rộng bằng vai. Khi bạn đưa mái chèo lên phía trên đỉnh đầu thì khuỷu tay cần tạo một góc gần bằng 90º. Độ dài phần lưỡi và phần cán của mái chèo phía ngoài vị trí cầm tay của bạn cần đều nhau.</span><br style=\"font-family: Arial; color: rgb(51, 51, 51); font-size: 12px; text-align: justify;\"><span style=\"color: rgb(51, 51, 51); font-family: Arial; font-size: 12px; text-align: justify;\"> </span><br style=\"font-family: Arial; color: rgb(51, 51, 51); font-size: 12px; text-align: justify;\"><span style=\"color: rgb(51, 51, 51); font-family: Arial; font-size: 12px; text-align: justify;\">Mái chèo chia làm 2 loại: feathered or nonfeathered. Loại mài chèo “nonfeathered” được bố trí 2 lưỡi chèo nằm trên cùng một đường thẳng và mặt phẳng. Loại mài chèo “feathered” không như vậy, chúng được bố trị lệch nhau một góc nhất định.</span></p><p><span style=\"color: rgb(51, 51, 51); font-family: Arial; font-size: 12px; text-align: justify;\"><br></span><img src=\"https://wetrek.vn/pic/service/images/635648904576596702.jpg.ashx\" style=\"width: 746px;\"></p><div style=\"font-family: Arial; color: rgb(51, 51, 51); font-size: 12px; text-align: justify;\">Lợi ích chính của việc xoay lưỡi mái chèo là giảm sức cản của gió và giảm mệt mỏi cho cổ tay, bởi 1 mái lưỡi chèo quạt xuống nước thì lưỡi mái chèo còn lại sẽ lướt qua gió. Hai lưỡi mái chèo loại này thông thường xoay lệch một góc từ 30 đến 45°. Góc nhỏ hơn thì cổ tay hoạt động dễ dàng hơn; góc rộng hơn thì hiệu quả chèo thuyền lớn hơn.<br style=\"font-family: inherit !important;\"> <br style=\"font-family: inherit !important;\">Mái chèo xoay được chế tạo sao cho có một tay luôn duy trì điều khiển. Tay điều khiển này sẽ xoay cán mái chèo ở mỗi lượt chèo sao cho lưỡi mái chèo tiếp nước ở một góc hiệu quả nhất. Phần lớn mái chèo đổ thác được điều khiển bằng tay phải. Phần lớn mái chèo du lịch có cán tháo rời cho phép thay đổi tay điều khiển, thay đổi góc lệch giữa 2 lưỡi mái chèo. Tay điểu khiển là tay nào tuỳ thuộc vào sở thích cá nhân, không cần thiết phải xác định rõ bằng việc bạn thuận tay nào.</div><div style=\"font-family: Arial; color: rgb(51, 51, 51); font-size: 12px; text-align: justify;\"><br></div><p style=\"font-family: Arial; color: rgb(51, 51, 51); font-size: 12px; text-align: justify;\"> </p><p style=\"font-family: Arial; color: rgb(51, 51, 51); font-size: 12px; text-align: justify;\"><br></p><p style=\"font-family: Arial; color: rgb(51, 51, 51); font-size: 12px; text-align: justify;\">Cách chèo thuyền có bản là chèo về phía trước. Đặt lưỡi chèo xuống vùng nước ngang mũi chân bạn, sau đó kéo về phía sau tới ngang hông. Nhấc lưỡi chèo lên và chèo tiếp ở bên còn lại<br> <br><strong>KIỂU CHÈO THUYỀN KAYAK</strong><br> <br>Chèo thuyền kayak góc thấp là kiểu chèo thư giãn với nhịp chèo chậm, hiệu quả cho các chuyển đi dài. Góc của lưỡi mái chèo bẹt hơn (nằm ngang hơn) khi vào nước nên lưỡi mái chèo góc thấp thường dẹt hơn và dài hơn một chút cho với lưỡi mái chèo góc cao.<br> <br>Chèo thuyền kayak góc cao là kiểu chèo mạnh mẽ hơn với nhịp chèo nhanh hơn, được ưa chuộng sử dụng nếu bạn thấy khả năng tăng tốc và cơ động khi di chuyển dưới nước là quan trọng. Bởi khi đó cần nhiều lực đẩy cho mỗi lần chèo. Đây cũng là một lựa chọn tốt cho việc luyện tập sức khoẻ.</p><p style=\"font-family: Arial; color: rgb(51, 51, 51); font-size: 12px; text-align: justify;\"><br></p><p style=\"font-family: Arial; color: rgb(51, 51, 51); font-size: 12px; text-align: justify;\"><img src=\"https://wetrek.vn/pic/service/images/635648904597277885.jpg.ashx\" style=\"width: 100%;\"></p><p style=\"font-family: Arial; color: rgb(51, 51, 51); font-size: 12px; text-align: justify;\"><strong><br></strong></p><p style=\"font-family: Arial; color: rgb(51, 51, 51); font-size: 12px; text-align: justify;\"><strong>LƯU Ý KHI CHÈO THUYỀN KAYAK</strong><br> <br>Thuyền Kayak rất dễ sử dụng. Hãy bắt đầu thử ở vùng nước lặng, bạn sẽ có thể dần thích nghi với cảm giác ngồi trên thuyền và kỹ thuật chèo thuyền, luyện tập trèo ra và vào buồng lái. Mái chèo dài sẽ cho phép bạn chèo với bước chèo dài hơn nhưng chậm hơn so với mái chèo ngắn. Khi chèo thuyền, hãy lỏng tay, không cần gồng cứng hay cầm quá chặt.<br> <br>Ngồi với tư thế thoải mái, giữ cho thân thẳng, chọn vị trí đặt chân sao cho đầu gối hơi cong. Để tăng hiệu quả chèo thuyền kayak, không chỉ sử dụng tay mà hãy dùng cả vai và lưng, cơ bụng. Nhưng  người chèo thuyền có kinh nghiệm thường sử dụng mái chèo “feathered”, tuy nhiên những người mới bắt đầu chèo thuyền thường thích mái chèo có lưỡi chèo vuông.</p><p style=\"font-family: Arial; color: rgb(51, 51, 51); font-size: 12px; text-align: justify;\"><br></p><p style=\"font-family: Arial; color: rgb(51, 51, 51); font-size: 12px; text-align: justify;\"><strong style=\"text-align: right;\">Ethan Nguyen.</strong><br></p>', '2021-05-25 21:20:05', '2021-06-23 04:38:54', 3, 1, 1008),
(6, 'Game đu dây vượt qua thử thách 02', 'http://songchaugroup.com/images/uploads/115.jpg', 90000, 'Đây là một trong những trò chơi cắm trại yêu cầu rất cao về thể lực của người chơi. Bạn phải lần lượt vượt qua các thử thách của trò chơi do ban tổ chức đưa ra...', '<p style=\"font-family: Verdana, Geneva, sans-serif; font-size: 15px; line-height: 26px; margin-bottom: 26px; overflow-wrap: break-word; color: rgb(34, 34, 34);\">Đây là một trong những trò chơi cắm trại yêu cầu rất cao về thể lực của người chơi. Bạn phải lần lượt vượt qua các thử thách của trò chơi do ban tổ chức đưa ra. Ngoài thể lực là yếu tố chính thì sự khéo léo trong từng bước di chuyển sẽ giúp bạn dễ dàng vượt qua thử thách một cách dễ dàng nhất.</p><p style=\"font-family: Verdana, Geneva, sans-serif; font-size: 15px; line-height: 26px; margin-bottom: 26px; overflow-wrap: break-word; color: rgb(34, 34, 34);\">Với trò chơi này các bạn có thể tham gia cá nhân hoặc tham gia theo nhóm. Tuy nhiên, nếu đi cắm trại cùng tập thể thì cả nhóm sẽ được chia thành các đội chơi nhỏ, mỗi đội chơi có khoảng 5-7 thành viên. Mỗi đội chơi sẽ cử lần lượt cử các thành viên để tham gia. Một thành viên của đội A sẽ thi đấu với một thành viên của đội B. Đội nào có số thành viên về đích trong thời gian nhanh nhất sẽ là đội dành chiến thắng.</p>', '2021-06-22 17:12:11', '2021-06-23 04:33:31', 1, 1, 1005),
(7, 'Game đu dây dưới nước 02', 'https://www.notimefortravel.com/wp-content/uploads/2018/01/du-d%C3%A2y.jpg', 50000, 'Tương tự như game đu dây qua cầu, tuy nhiên trò chơi này được thực hiện dưới nước. Tuy nhiên nếu bạn là người sợ nước thì cũng có thể cân nhắc trước khi tham gia trò chơi này.', '<p><span style=\"color: rgb(34, 34, 34); font-family: Verdana, Geneva, sans-serif; font-size: 15px;\">Tương tự như game đu dây qua cầu, tuy nhiên trò chơi này được thực hiện dưới nước. Nhiệm vụ của bạn là băng qua sông trong thời gian nhanh nhất mà không để bị té xuống nước, khi tham gia trò chơi này sẽ có những người bảo hộ phía dưới để cứu bạn khi bạn bị té. Tuy nhiên nếu bạn là người sợ nước thì cũng có thể cân nhắc trước khi tham gia trò chơi này.</span><br></p>', '2021-06-22 17:14:35', '2021-06-22 17:25:28', 1, 1, 1000),
(8, 'Trò chơi kéo co 02', 'https://upload.wikimedia.org/wikipedia/commons/4/49/Animatiewerk.nl_touwtrekken.jpg', 60000, ' Mặc dù đây là một trong những trò chơi cắm trại dân gian mà ai cũng biết nhưng với mình thì kéo co là một trong những trò chơi tập thể ngoài trời khá thú vị', '<p style=\"font-family: Verdana, Geneva, sans-serif; font-size: 15px; line-height: 26px; margin-bottom: 26px; overflow-wrap: break-word; color: rgb(34, 34, 34);\">Bạn nghĩ sao về trò chơi này? Mặc dù đây là một trong những <a href=\"https://notimefortravel.com/tro-choi-cam-trai/\" style=\"color: rgb(57, 153, 152);\">trò chơi cắm trại</a> dân gian mà ai cũng biết nhưng với mình thì kéo co là một trong những trò chơi tập thể ngoài trời khá thú vị. Cách chơi không khó, dụng cụ chơi cũng không cần phải chuẩn bị nhiều thứ nhưng điều mang lại cho chúng ta chính là sự kết nối, tinh thần đoàn kết, thể hiện được sức mạnh của tập thể. “Một cây làm chẳng lên non, ba cây chụm lại nên hòn núi cao”</p><p style=\"font-family: Verdana, Geneva, sans-serif; font-size: 15px; line-height: 26px; margin-bottom: 26px; overflow-wrap: break-word; color: rgb(34, 34, 34);\">Thể lệ trò chơi như sau, các bạn sẽ chia các thành viên trong đoàn của mình thành 2 nhóm, mỗi nhóm tối thiểu là 10 người. Chuẩn bị sẵn một sợ dây thừng chắc chắn, vẽ một vạch ngăn ở giữa, đồng thời buộc một sợ dây đỏ vào chính giữa sợi dây thừng. 2 đội cầm 2 đầu dây, đứng về 2 phía, khi đội trưởng thổi còi hô trận đấu bắt đầu cũng là lúc 2 đội dồn toàn sức lực làm sao để có thể kéo được đội bạn giẫm chân qua vạch kẻ ban đầu thì đó là đội chơi dành chiến thắng.</p><p style=\"font-family: Verdana, Geneva, sans-serif; font-size: 15px; line-height: 26px; margin-bottom: 26px; overflow-wrap: break-word; color: rgb(34, 34, 34);\">Tham gia trò chơi tập thể ngoài trời này các bạn sẽ được hô hò, tinh thần đồng đội lên cao giúp các thành viên trở nên đoàn kết và thân thiết với nhau hơn.</p>', '2021-06-22 17:18:08', '2021-06-22 17:42:41', 1, 1, 1003),
(9, 'Chèo thuyền kayak 03', 'https://cdn-thethao247.com/upload/thanhtung/2019/08/14/cheo-kayak-vinh-ha-long.jpg', 80000, 'Bạn cần biết cách chèo thuyền, hướng dẫn cố định bàn chân, đùi khi chèo thuyền và kỹ năng giải cứu khi gặp nạn. Không chỉ riêng với chèo thuyền kayak mà với bất kỳ một hoạt động dã ngoại nào...', '<p><span style=\"color: rgb(51, 51, 51); font-family: Arial; font-size: 12px; text-align: justify;\">Việc tham khảo các hướng dẫn cơ bản trước khi bạn bắt đầu chèo thuyền kayak là điều rất quan trọng. Nếu có, hãy tham giá các lớp học chèo thuyền do những đại lý bán lẻ kayak hoặc các câu lạc bộ chèo thuyền kayak tổ chức ở địa phương bạn.</span><br style=\"font-family: Arial; color: rgb(51, 51, 51); font-size: 12px; text-align: justify;\"><br style=\"font-family: Arial; color: rgb(51, 51, 51); font-size: 12px; text-align: justify;\"><span style=\"color: rgb(51, 51, 51); font-family: Arial; font-size: 12px; text-align: justify;\">Bạn cần biết cách chèo thuyền, hướng dẫn cố định bàn chân, đùi khi chèo thuyền và kỹ năng giải cứu khi gặp nạn. Không chỉ riêng với chèo thuyền kayak mà với bất kỳ một hoạt động dã ngoại nào, bạn cũng cần phải làm quen sử dụng bộ sơ cứu y tế khẩn cấp, kỹ năng hồi sức tim phổi (CPR), cách xử lý việc bị hạ thân nhiệt.</span></p><p><img src=\"https://wetrek.vn/pic/Service/duyanh.wetrek.vn@gmail.com/images/huong-dan-cach-cheo-thuyen-kayak-wetrek_vn.jpg\" style=\"width: 746px;\"><span style=\"color: rgb(51, 51, 51); font-family: Arial; font-size: 12px; text-align: justify;\"><br></span></p><p><span style=\"color: rgb(51, 51, 51); font-family: Arial; font-size: 12px; text-align: justify;\"><br></span><strong style=\"font-family: Arial; color: rgb(51, 51, 51); font-size: 12px; text-align: justify;\">CÁCH CHÈO THUYỀN KAYAK</strong><br style=\"font-family: Arial; color: rgb(51, 51, 51); font-size: 12px; text-align: justify;\"><span style=\"color: rgb(51, 51, 51); font-family: Arial; font-size: 12px; text-align: justify;\"> </span><br style=\"font-family: Arial; color: rgb(51, 51, 51); font-size: 12px; text-align: justify;\"><span style=\"color: rgb(51, 51, 51); font-family: Arial; font-size: 12px; text-align: justify;\">Để bắt đầu chèo thuyền kayak, hãy ngồi vào trong thuyền. Đặt lưng của bạn sát về phía sau ghế ngồi, đầu gối của bạn nên để cong thoải mái. Để tìm được điểm đặt chân phù hợp, duỗi thẳng chân ra và co lại một nấc. Nếu bạn đặt chân quá thẳng, bạn sẽ cảm nhận thấy áp lực bị đè nén lên phần lưng dưới. Nếu chân bạn cong quá nhiều thì có thể sẽ va đụng vào bộ phận cố định đầu gối của thuyền khi bạn chèo.</span><br style=\"font-family: Arial; color: rgb(51, 51, 51); font-size: 12px; text-align: justify;\"><br style=\"font-family: Arial; color: rgb(51, 51, 51); font-size: 12px; text-align: justify;\"><span style=\"color: rgb(51, 51, 51); font-family: Arial; font-size: 12px; text-align: justify;\">Để tìm được vị trí đặt tay trên mái chèo, hãy bắt đầu với hai cánh tay để song song chính giữa và rộng bằng vai. Khi bạn đưa mái chèo lên phía trên đỉnh đầu thì khuỷu tay cần tạo một góc gần bằng 90º. Độ dài phần lưỡi và phần cán của mái chèo phía ngoài vị trí cầm tay của bạn cần đều nhau.</span><br style=\"font-family: Arial; color: rgb(51, 51, 51); font-size: 12px; text-align: justify;\"><span style=\"color: rgb(51, 51, 51); font-family: Arial; font-size: 12px; text-align: justify;\"> </span><br style=\"font-family: Arial; color: rgb(51, 51, 51); font-size: 12px; text-align: justify;\"><span style=\"color: rgb(51, 51, 51); font-family: Arial; font-size: 12px; text-align: justify;\">Mái chèo chia làm 2 loại: feathered or nonfeathered. Loại mài chèo “nonfeathered” được bố trí 2 lưỡi chèo nằm trên cùng một đường thẳng và mặt phẳng. Loại mài chèo “feathered” không như vậy, chúng được bố trị lệch nhau một góc nhất định.</span></p><p><span style=\"color: rgb(51, 51, 51); font-family: Arial; font-size: 12px; text-align: justify;\"><br></span><img src=\"https://wetrek.vn/pic/service/images/635648904576596702.jpg.ashx\" style=\"width: 746px;\"></p><div style=\"font-family: Arial; color: rgb(51, 51, 51); font-size: 12px; text-align: justify;\">Lợi ích chính của việc xoay lưỡi mái chèo là giảm sức cản của gió và giảm mệt mỏi cho cổ tay, bởi 1 mái lưỡi chèo quạt xuống nước thì lưỡi mái chèo còn lại sẽ lướt qua gió. Hai lưỡi mái chèo loại này thông thường xoay lệch một góc từ 30 đến 45°. Góc nhỏ hơn thì cổ tay hoạt động dễ dàng hơn; góc rộng hơn thì hiệu quả chèo thuyền lớn hơn.<br style=\"font-family: inherit !important;\"> <br style=\"font-family: inherit !important;\">Mái chèo xoay được chế tạo sao cho có một tay luôn duy trì điều khiển. Tay điều khiển này sẽ xoay cán mái chèo ở mỗi lượt chèo sao cho lưỡi mái chèo tiếp nước ở một góc hiệu quả nhất. Phần lớn mái chèo đổ thác được điều khiển bằng tay phải. Phần lớn mái chèo du lịch có cán tháo rời cho phép thay đổi tay điều khiển, thay đổi góc lệch giữa 2 lưỡi mái chèo. Tay điểu khiển là tay nào tuỳ thuộc vào sở thích cá nhân, không cần thiết phải xác định rõ bằng việc bạn thuận tay nào.</div><div style=\"font-family: Arial; color: rgb(51, 51, 51); font-size: 12px; text-align: justify;\"><br></div><p style=\"font-family: Arial; color: rgb(51, 51, 51); font-size: 12px; text-align: justify;\"> </p><p style=\"font-family: Arial; color: rgb(51, 51, 51); font-size: 12px; text-align: justify;\"><br></p><p style=\"font-family: Arial; color: rgb(51, 51, 51); font-size: 12px; text-align: justify;\">Cách chèo thuyền có bản là chèo về phía trước. Đặt lưỡi chèo xuống vùng nước ngang mũi chân bạn, sau đó kéo về phía sau tới ngang hông. Nhấc lưỡi chèo lên và chèo tiếp ở bên còn lại<br> <br><strong>KIỂU CHÈO THUYỀN KAYAK</strong><br> <br>Chèo thuyền kayak góc thấp là kiểu chèo thư giãn với nhịp chèo chậm, hiệu quả cho các chuyển đi dài. Góc của lưỡi mái chèo bẹt hơn (nằm ngang hơn) khi vào nước nên lưỡi mái chèo góc thấp thường dẹt hơn và dài hơn một chút cho với lưỡi mái chèo góc cao.<br> <br>Chèo thuyền kayak góc cao là kiểu chèo mạnh mẽ hơn với nhịp chèo nhanh hơn, được ưa chuộng sử dụng nếu bạn thấy khả năng tăng tốc và cơ động khi di chuyển dưới nước là quan trọng. Bởi khi đó cần nhiều lực đẩy cho mỗi lần chèo. Đây cũng là một lựa chọn tốt cho việc luyện tập sức khoẻ.</p><p style=\"font-family: Arial; color: rgb(51, 51, 51); font-size: 12px; text-align: justify;\"><br></p><p style=\"font-family: Arial; color: rgb(51, 51, 51); font-size: 12px; text-align: justify;\"><img src=\"https://wetrek.vn/pic/service/images/635648904597277885.jpg.ashx\" style=\"width: 100%;\"></p><p style=\"font-family: Arial; color: rgb(51, 51, 51); font-size: 12px; text-align: justify;\"><strong><br></strong></p><p style=\"font-family: Arial; color: rgb(51, 51, 51); font-size: 12px; text-align: justify;\"><strong>LƯU Ý KHI CHÈO THUYỀN KAYAK</strong><br> <br>Thuyền Kayak rất dễ sử dụng. Hãy bắt đầu thử ở vùng nước lặng, bạn sẽ có thể dần thích nghi với cảm giác ngồi trên thuyền và kỹ thuật chèo thuyền, luyện tập trèo ra và vào buồng lái. Mái chèo dài sẽ cho phép bạn chèo với bước chèo dài hơn nhưng chậm hơn so với mái chèo ngắn. Khi chèo thuyền, hãy lỏng tay, không cần gồng cứng hay cầm quá chặt.<br> <br>Ngồi với tư thế thoải mái, giữ cho thân thẳng, chọn vị trí đặt chân sao cho đầu gối hơi cong. Để tăng hiệu quả chèo thuyền kayak, không chỉ sử dụng tay mà hãy dùng cả vai và lưng, cơ bụng. Nhưng  người chèo thuyền có kinh nghiệm thường sử dụng mái chèo “feathered”, tuy nhiên những người mới bắt đầu chèo thuyền thường thích mái chèo có lưỡi chèo vuông.</p><p style=\"font-family: Arial; color: rgb(51, 51, 51); font-size: 12px; text-align: justify;\"><br></p><p style=\"font-family: Arial; color: rgb(51, 51, 51); font-size: 12px; text-align: justify;\"><strong style=\"text-align: right;\">Ethan Nguyen.</strong><br></p>', '2021-05-25 21:20:05', '2021-06-22 17:36:32', 1, 1, 1000),
(10, 'Game đu dây vượt qua thử thách 03', 'https://notimefortravel.com/wp-content/uploads/2018/01/phat-hien-khu-tro-choi-tren-cay-moi-toanh-dang-hot-ran-ran-o-da-lat-1fb876ad636135233226007692.jpg', 90000, 'Đây là một trong những trò chơi cắm trại yêu cầu rất cao về thể lực của người chơi. Bạn phải lần lượt vượt qua các thử thách của trò chơi do ban tổ chức đưa ra...', '<p style=\"font-family: Verdana, Geneva, sans-serif; font-size: 15px; line-height: 26px; margin-bottom: 26px; overflow-wrap: break-word; color: rgb(34, 34, 34);\">Đây là một trong những trò chơi cắm trại yêu cầu rất cao về thể lực của người chơi. Bạn phải lần lượt vượt qua các thử thách của trò chơi do ban tổ chức đưa ra. Ngoài thể lực là yếu tố chính thì sự khéo léo trong từng bước di chuyển sẽ giúp bạn dễ dàng vượt qua thử thách một cách dễ dàng nhất.</p><p style=\"font-family: Verdana, Geneva, sans-serif; font-size: 15px; line-height: 26px; margin-bottom: 26px; overflow-wrap: break-word; color: rgb(34, 34, 34);\">Với trò chơi này các bạn có thể tham gia cá nhân hoặc tham gia theo nhóm. Tuy nhiên, nếu đi cắm trại cùng tập thể thì cả nhóm sẽ được chia thành các đội chơi nhỏ, mỗi đội chơi có khoảng 5-7 thành viên. Mỗi đội chơi sẽ cử lần lượt cử các thành viên để tham gia. Một thành viên của đội A sẽ thi đấu với một thành viên của đội B. Đội nào có số thành viên về đích trong thời gian nhanh nhất sẽ là đội dành chiến thắng.</p>', '2021-06-22 17:12:11', '2021-06-22 17:44:55', 1, 1, 1000),
(11, 'Game đu dây dưới nước 03', 'https://lh3.googleusercontent.com/proxy/jDcTdLjC-DxzD2H_RKYoFfTc6Ts_BXalL5kwK0ZAZ-zJtlhwtdeFQQjjEQf-KDjqoBM6_B4lKQh5n-VvSk5cG1CfwNZ7e9jdldUFgJ_e4xmJbH2ZCinlR-JxvBrmw8e2Ki4KsEYlF7GrI16ocsJtgRNz', 50000, 'Tương tự như game đu dây qua cầu, tuy nhiên trò chơi này được thực hiện dưới nước. Tuy nhiên nếu bạn là người sợ nước thì cũng có thể cân nhắc trước khi tham gia trò chơi này.', '<p><span style=\"color: rgb(34, 34, 34); font-family: Verdana, Geneva, sans-serif; font-size: 15px;\">Tương tự như game đu dây qua cầu, tuy nhiên trò chơi này được thực hiện dưới nước. Nhiệm vụ của bạn là băng qua sông trong thời gian nhanh nhất mà không để bị té xuống nước, khi tham gia trò chơi này sẽ có những người bảo hộ phía dưới để cứu bạn khi bạn bị té. Tuy nhiên nếu bạn là người sợ nước thì cũng có thể cân nhắc trước khi tham gia trò chơi này.</span><br></p>', '2021-06-22 17:14:35', '2021-06-22 17:54:35', 1, 1, 1000),
(12, 'Trò chơi kéo co 03', 'https://thuthuatchoi.com/media/photos/shares/trochoidangian/keoco/C__ch_ch__i_k__o_co.jpg', 60000, ' Mặc dù đây là một trong những trò chơi cắm trại dân gian mà ai cũng biết nhưng với mình thì kéo co là một trong những trò chơi tập thể ngoài trời khá thú vị', '<p style=\"font-family: Verdana, Geneva, sans-serif; font-size: 15px; line-height: 26px; margin-bottom: 26px; overflow-wrap: break-word; color: rgb(34, 34, 34);\">Bạn nghĩ sao về trò chơi này? Mặc dù đây là một trong những <a href=\"https://notimefortravel.com/tro-choi-cam-trai/\" style=\"color: rgb(57, 153, 152);\">trò chơi cắm trại</a> dân gian mà ai cũng biết nhưng với mình thì kéo co là một trong những trò chơi tập thể ngoài trời khá thú vị. Cách chơi không khó, dụng cụ chơi cũng không cần phải chuẩn bị nhiều thứ nhưng điều mang lại cho chúng ta chính là sự kết nối, tinh thần đoàn kết, thể hiện được sức mạnh của tập thể. “Một cây làm chẳng lên non, ba cây chụm lại nên hòn núi cao”</p><p style=\"font-family: Verdana, Geneva, sans-serif; font-size: 15px; line-height: 26px; margin-bottom: 26px; overflow-wrap: break-word; color: rgb(34, 34, 34);\">Thể lệ trò chơi như sau, các bạn sẽ chia các thành viên trong đoàn của mình thành 2 nhóm, mỗi nhóm tối thiểu là 10 người. Chuẩn bị sẵn một sợ dây thừng chắc chắn, vẽ một vạch ngăn ở giữa, đồng thời buộc một sợ dây đỏ vào chính giữa sợi dây thừng. 2 đội cầm 2 đầu dây, đứng về 2 phía, khi đội trưởng thổi còi hô trận đấu bắt đầu cũng là lúc 2 đội dồn toàn sức lực làm sao để có thể kéo được đội bạn giẫm chân qua vạch kẻ ban đầu thì đó là đội chơi dành chiến thắng.</p><p style=\"font-family: Verdana, Geneva, sans-serif; font-size: 15px; line-height: 26px; margin-bottom: 26px; overflow-wrap: break-word; color: rgb(34, 34, 34);\">Tham gia trò chơi tập thể ngoài trời này các bạn sẽ được hô hò, tinh thần đồng đội lên cao giúp các thành viên trở nên đoàn kết và thân thiết với nhau hơn.</p>', '2021-06-22 17:18:08', '2021-06-22 17:35:03', 1, 1, 1000);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `message`
--

CREATE TABLE `message` (
  `id` int(11) NOT NULL,
  `content` varchar(200) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `href` varchar(100) DEFAULT NULL,
  `status` tinyint(4) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `message`
--

INSERT INTO `message` (`id`, `content`, `created_at`, `href`, `status`) VALUES
(1, '<b>Danh mục Outdoor</b> đã được update bởi admin Picnic Team', '2021-06-22 17:10:15', 'adm_category.php', 0),
(2, '<b>Danh mục Indoor</b> đã được tạo bởi admin Picnic Team', '2021-06-22 17:10:21', 'adm_category.php', 0),
(3, '<b>Danh mục Kids</b> đã được tạo bởi admin Picnic Team', '2021-06-22 17:10:29', 'adm_category.php', 0),
(4, '<b>Danh mục Outdoor</b> đã được update bởi admin Picnic Team', '2021-06-22 17:10:43', 'adm_category.php', 0),
(5, '<b>Game Game đu dây vượt qua thử thách</b> đã được tạo mới bởi admin Picnic Team', '2021-06-22 17:12:11', 'adm_games.php', 0),
(6, '<b>Game Game đu dây dưới nước</b> đã được tạo mới bởi admin Picnic Team', '2021-06-22 17:14:35', 'adm_games.php', 0),
(7, '<b>Game Trò chơi kéo co</b> đã được tạo mới bởi admin Picnic Team', '2021-06-22 17:18:08', 'adm_games.php', 0),
(8, '<b>Game Game đu dây dưới nước(ID=3)</b> đã được update bởi admin Picnic Team', '2021-06-22 17:23:27', 'adm_games.php', 0),
(9, '<b>Game Game đu dây vượt qua thử thách(ID=2)</b> đã được update bởi admin Picnic Team', '2021-06-22 17:24:40', 'adm_games.php', 0),
(10, '<b>Game Game đu dây dưới nước(ID=3)</b> đã được update bởi admin Picnic Team', '2021-06-22 17:25:28', 'adm_games.php', 0),
(11, '<b>Game Chèo thuyền kayak(ID=1)</b> đã được update bởi admin Picnic Team', '2021-06-22 17:26:25', 'adm_games.php', 0),
(12, '<b>Game Trò chơi kéo co(ID=4)</b> đã được update bởi admin Picnic Team', '2021-06-22 17:32:00', 'adm_games.php', 0),
(13, '<b>Game Chèo thuyền kayak 02(ID=5)</b> đã được update bởi admin Picnic Team', '2021-06-22 17:32:12', 'adm_games.php', 0),
(14, '<b>Game Game đu dây dưới nước 03(ID=11)</b> đã được update bởi admin Picnic Team', '2021-06-22 17:32:19', 'adm_games.php', 0),
(15, '<b>Game Game đu dây vượt qua thử thách(ID=2)</b> đã được update bởi admin Picnic Team', '2021-06-22 17:32:30', 'adm_games.php', 0),
(16, '<b>Game Game đu dây dưới nước(ID=3)</b> đã được update bởi admin Picnic Team', '2021-06-22 17:32:46', 'adm_games.php', 0),
(17, '<b>Game Game đu dây vượt qua thử thách 03(ID=10)</b> đã được update bởi admin Picnic Team', '2021-06-22 17:32:55', 'adm_games.php', 0),
(18, '<b>Game Trò chơi kéo co 02(ID=8)</b> đã được update bởi admin Picnic Team', '2021-06-22 17:33:09', 'adm_games.php', 0),
(19, '<b>Game Chèo thuyền kayak 03(ID=9)</b> đã được update bởi admin Picnic Team', '2021-06-22 17:33:20', 'adm_games.php', 0),
(20, '<b>Game Game đu dây vượt qua thử thách(ID=2)</b> đã được update bởi admin Picnic Team', '2021-06-22 17:33:34', 'adm_games.php', 0),
(21, '<b>Game Game đu dây dưới nước 03(ID=11)</b> đã được update bởi admin Picnic Team', '2021-06-22 17:34:36', 'adm_games.php', 0),
(22, '<b>Game Trò chơi kéo co 03(ID=12)</b> đã được update bởi admin Picnic Team', '2021-06-22 17:35:03', 'adm_games.php', 0),
(23, '<b>Game Chèo thuyền kayak 03(ID=9)</b> đã được update bởi admin Picnic Team', '2021-06-22 17:36:32', 'adm_games.php', 0),
(24, '<b>Game Chèo thuyền kayak 02(ID=5)</b> đã được update bởi admin Picnic Team', '2021-06-22 17:41:43', 'adm_games.php', 0),
(25, '<b>Game Trò chơi kéo co 02(ID=8)</b> đã được update bởi admin Picnic Team', '2021-06-22 17:42:41', 'adm_games.php', 0),
(26, '<b>Game Game đu dây dưới nước 03(ID=11)</b> đã được update bởi admin Picnic Team', '2021-06-22 17:44:02', 'adm_games.php', 0),
(27, '<b>Game Game đu dây vượt qua thử thách 03(ID=10)</b> đã được update bởi admin Picnic Team', '2021-06-22 17:44:55', 'adm_games.php', 0),
(28, '<b>Game Trò chơi kéo co(ID=4)</b> đã được update bởi admin Picnic Team', '2021-06-22 17:52:05', 'adm_games.php', 0),
(29, '<b>Game Chèo thuyền kayak(ID=1)</b> đã được update bởi admin Picnic Team', '2021-06-22 17:52:32', 'adm_games.php', 0),
(30, '<b>Game Game đu dây dưới nước 03(ID=11)</b> đã được update bởi admin Picnic Team', '2021-06-22 17:54:35', 'adm_games.php', 0),
(31, '<b>Game Chèo thuyền kayak(ID=1)</b> đã được update bởi admin Picnic Team', '2021-06-22 17:55:20', 'adm_games.php', 0),
(32, '<b>Game Game đu dây vượt qua thử thách 02(ID=6)</b> đã được update bởi admin Picnic Team', '2021-06-22 17:56:24', 'adm_games.php', 0),
(33, '<b>Game Game đu dây dưới nước(ID=3)</b> đã được update bởi admin Picnic Team', '2021-06-22 17:58:27', 'adm_games.php', 0),
(34, '<b>Game Trò chơi kéo co(ID=4)</b> đã được update bởi admin Picnic Team', '2021-06-22 18:00:32', 'adm_games.php', 0),
(35, '<b>Game Chèo thuyền kayak 02(ID=5)</b> đã được update bởi admin Picnic Team', '2021-06-22 18:00:52', 'adm_games.php', 0),
(36, '<b>Địa điểm Vách đá Moher</b> đã được thêm bởi admin Picnic Team', '2021-06-22 18:11:50', 'adm_places.php', 0),
(37, '<b>Địa điểm Vườn quốc gia Banff (Hồ Louise)</b> đã được thêm bởi admin Picnic Team', '2021-06-22 18:13:33', 'adm_places.php', 0),
(38, '<b>Địa điểm Vườn quốc gia Plitvice Lakes</b> đã được thêm bởi admin Picnic Team', '2021-06-22 18:14:54', 'adm_places.php', 0),
(39, '<b>Địa điểm Hẻm núi Grand Canyon</b> đã được thêm bởi admin Picnic Team', '2021-06-22 18:15:41', 'adm_places.php', 0),
(40, '<b>Địa điểm Rạn san hô Great Barrier</b> đã được thêm bởi admin Picnic Team', '2021-06-22 18:16:25', 'adm_places.php', 0),
(41, '<b>Địa điểm Cánh đồng muối Uyuni Flat (Salar de Uyuni)</b> đã được thêm bởi admin Picnic Team', '2021-06-22 18:17:12', 'adm_places.php', 0),
(42, '<b>Địa điểm Thác Iguazu (Thác Iguacu)</b> đã được thêm bởi admin Picnic Team', '2021-06-22 18:17:53', 'adm_places.php', 0),
(43, '<b>Địa điểm Vịnh Hạ Long – Cảnh đẹp núi non</b> đã được thêm bởi admin Picnic Team', '2021-06-22 18:19:15', 'adm_places.php', 0),
(44, '<b>Địa điểm Vách đá Moher</b> đã được update bởi admin Picnic Team', '2021-06-22 18:19:29', 'adm_places.php', 0),
(45, '<b>Địa điểm Vườn quốc gia Banff (Hồ Louise)</b> đã được update bởi admin Picnic Team', '2021-06-22 18:19:37', 'adm_places.php', 0),
(46, '<b>Địa điểm Milford Soundd</b> đã được update bởi admin Picnic Team', '2021-06-22 18:19:54', 'adm_places.php', 0),
(47, '<b>Địa điểm Hẻm núi Grand Canyon</b> đã được update bởi admin Picnic Team', '2021-06-22 18:20:08', 'adm_places.php', 0),
(48, '<b>Địa điểm Vách đá Moher</b> đã được update bởi admin Picnic Team', '2021-06-22 18:20:14', 'adm_places.php', 0),
(49, '<b>Bạn có 1 đơn hàng mới ,đơn hàng số 7</b>', '2021-06-22 18:22:49', 'adm_orders_details.php?id=7', 1),
(50, '<b>Đơn hàng số 7</b> được xác nhận <b>gửi thành công</b> bởi picnic@gmail.com', '2021-06-22 18:23:03', 'adm_orders_details.php?id=7', 0),
(51, '<b>Bạn có 1 đơn hàng mới ,đơn hàng số 8</b>', '2021-06-22 18:24:15', 'adm_orders_details.php?id=8', 0),
(52, '<b>Bạn có 1 đơn hàng mới ,đơn hàng số 9</b>', '2021-06-22 18:24:59', 'adm_orders_details.php?id=9', 1),
(53, '<b>Đơn hàng số 9</b> được xác nhận <b>gửi thành công</b> bởi picnic@gmail.com', '2021-06-22 18:25:08', 'adm_orders_details.php?id=9', 0),
(54, '<b>Bạn có 1 đơn hàng mới ,đơn hàng số 10</b>', '2021-06-22 18:31:07', 'adm_orders_details.php?id=10', 0),
(55, '<b>Album Game Kayak - Phú Quốc</b> đã được tạo bỏi admin Picnic Team', '2021-06-22 18:39:03', 'adm_albums.php', 0),
(56, '<b>Album Kayak - Hạ Long</b> đã được tạo bỏi admin Picnic Team', '2021-06-22 18:40:27', 'adm_albums.php', 0),
(57, '<b>Photo hl01</b> đã được thêm bởi admin Picnic Team', '2021-06-22 18:41:06', 'adm_photoes.php', 0),
(58, '<b>Photo hl02</b> đã được thêm bởi admin Picnic Team', '2021-06-22 18:42:02', 'adm_photoes.php', 0),
(59, '<b>Photo hl03</b> đã được thêm bởi admin Picnic Team', '2021-06-22 18:42:33', 'adm_photoes.php', 0),
(60, '<b>Photo hl04</b> đã được thêm bởi admin Picnic Team', '2021-06-22 18:43:05', 'adm_photoes.php', 0),
(61, '<b>Photo hl05</b> đã được thêm bởi admin Picnic Team', '2021-06-22 18:43:34', 'adm_photoes.php', 0),
(62, '<b>Photo pq01</b> đã được thêm bởi admin Picnic Team', '2021-06-22 18:44:33', 'adm_photoes.php', 0),
(63, '<b>Photo pq02</b> đã được thêm bởi admin Picnic Team', '2021-06-22 18:45:00', 'adm_photoes.php', 0),
(64, '<b>Photo pq03</b> đã được thêm bởi admin Picnic Team', '2021-06-22 18:45:26', 'adm_photoes.php', 0),
(65, '<b>Album Đu dây thử thách</b> đã được tạo bỏi admin Picnic Team', '2021-06-22 18:49:50', 'adm_albums.php', 0),
(66, '<b>Photo đu dây 01</b> đã được thêm bởi admin Picnic Team', '2021-06-22 18:50:46', 'adm_photoes.php', 0),
(67, '<b>Photo đu dây 01(ID=9)</b> đã được update bởi admin Picnic Team', '2021-06-22 18:51:21', 'adm_photoes.php', 0),
(68, '<b>Photo dây 02</b> đã được thêm bởi admin Picnic Team', '2021-06-22 18:52:02', 'adm_photoes.php', 0),
(69, '<b>Photo dây 04</b> đã được thêm bởi admin Picnic Team', '2021-06-22 18:52:51', 'adm_photoes.php', 0),
(70, '<b>Game Game đu dây vượt qua thử thách(ID=2)</b> đã được update bởi admin Picnic Team', '2021-06-22 18:53:39', 'adm_games.php', 0),
(71, '<b>Game Chèo thuyền kayak(ID=1)</b> đã được update bởi admin Picnic Team', '2021-06-22 18:53:52', 'adm_games.php', 0),
(72, '<b>Video hướng dẫn chèo thuyền</b> đã được thêm bởi admin Picnic Team', '2021-06-22 18:58:11', 'adm_videos.php', 0),
(73, 'Supper Man đã bình luận về bài viết games_detail.php?id=1', '2021-06-22 19:00:15', '../games_detail.php?id=1&cmt=1', 0),
(74, 'Iron Man đã trả lời một bình luận trong bài viết games_detail.php?id=1', '2021-06-22 19:00:41', '../games_detail.php?id=1&cmt=1', 0),
(75, '<b>Bạn có 1 đơn hàng mới ,đơn hàng số 11</b>', '2021-06-22 19:02:25', 'adm_orders_details.php?id=11', 0),
(76, 'Admin với email=picnic1@gmail.com đã đăng kí thành công ', '2021-06-22 19:04:19', 'adm_users.php', 0),
(77, '<b>Bạn có 1 đơn hàng mới ,đơn hàng số 12</b>', '2021-06-22 19:06:14', 'adm_orders_details.php?id=12', 0),
(78, '<b>Đơn hàng số 12</b> được xác nhận <b>gửi thành công</b> bởi picnic@gmail.com', '2021-06-22 19:06:58', 'adm_orders_details.php?id=12', 0),
(79, 'Admin với email=soikhukho@gmail.com đã đăng kí thành công ', '2021-06-22 19:10:12', 'adm_users.php', 0),
(80, '<b>Album kayak kids 01</b> đã được tạo bỏi admin Picnic Team', '2021-06-23 03:41:42', 'adm_albums.php', 0),
(81, '<b>Photo 01</b> đã được thêm bởi admin Picnic Team', '2021-06-23 03:42:07', 'adm_photoes.php', 0),
(82, '<b>Photo 02</b> đã được thêm bởi admin Picnic Team', '2021-06-23 03:42:34', 'adm_photoes.php', 0),
(83, '<b>Photo 03</b> đã được thêm bởi admin Picnic Team', '2021-06-23 03:43:05', 'adm_photoes.php', 0),
(84, '<b>Photo 04</b> đã được thêm bởi admin Picnic Team', '2021-06-23 03:43:37', 'adm_photoes.php', 0),
(85, '<b>Photo 05</b> đã được thêm bởi admin Picnic Team', '2021-06-23 03:44:39', 'adm_photoes.php', 0),
(86, '<b>Photo 06</b> đã được thêm bởi admin Picnic Team', '2021-06-23 03:45:43', 'adm_photoes.php', 0),
(87, '<b>Photo 07</b> đã được thêm bởi admin Picnic Team', '2021-06-23 03:46:06', 'adm_photoes.php', 0),
(88, '<b>Photo 08</b> đã được thêm bởi admin Picnic Team', '2021-06-23 03:46:27', 'adm_photoes.php', 0),
(89, '<b>Game Chèo thuyền kayak(ID=1)</b> đã được update bởi admin Picnic Team', '2021-06-23 03:48:40', 'adm_games.php', 0),
(90, '<b>Game Chèo thuyền kayak 02(ID=5)</b> đã được update bởi admin Picnic Team', '2021-06-23 03:49:16', 'adm_games.php', 0),
(91, '<b>Game Game đu dây vượt qua thử thách(ID=2)</b> đã được update bởi admin Picnic Team', '2021-06-23 03:49:50', 'adm_games.php', 0),
(92, '<b>Game Chèo thuyền kayak(ID=1)</b> đã được update bởi admin Picnic Team', '2021-06-23 03:50:07', 'adm_games.php', 0),
(93, '<b>Album kids kéo co</b> đã được tạo bỏi admin Picnic Team', '2021-06-23 03:57:06', 'adm_albums.php', 0),
(94, '<b>Photo 01</b> đã được thêm bởi admin Picnic Team', '2021-06-23 03:57:24', 'adm_photoes.php', 0),
(95, '<b>Photo 02</b> đã được thêm bởi admin Picnic Team', '2021-06-23 03:57:57', 'adm_photoes.php', 0),
(96, '<b>Photo 03</b> đã được thêm bởi admin Picnic Team', '2021-06-23 03:58:45', 'adm_photoes.php', 0),
(97, '<b>Video kéo co mầm non</b> đã được thêm bởi admin Picnic Team', '2021-06-23 04:03:07', 'adm_videos.php', 0),
(98, '<b>Album Kéo co</b> đã được tạo bỏi admin Picnic Team', '2021-06-23 04:15:09', 'adm_albums.php', 0),
(99, '<b>Photo 01</b> đã được thêm bởi admin Picnic Team', '2021-06-23 04:15:42', 'adm_photoes.php', 0),
(100, '<b>Photo 02</b> đã được thêm bởi admin Picnic Team', '2021-06-23 04:16:03', 'adm_photoes.php', 0),
(101, '<b>Photo 04</b> đã được thêm bởi admin Picnic Team', '2021-06-23 04:19:31', 'adm_photoes.php', 0),
(102, '<b>Photo dfdfgdas</b> đã được thêm bởi admin Picnic Team', '2021-06-23 04:20:41', 'adm_photoes.php', 0),
(103, '<b>Album Du dây trên mặt nước</b> đã được tạo bỏi admin Picnic Team', '2021-06-23 04:22:51', 'adm_albums.php', 0),
(104, '<b>Album Du dây trên mặt nước</b> đã được update bởi admin Picnic Team', '2021-06-23 04:25:26', 'adm_albums.php', 0),
(105, '<b>Photo dsff</b> đã được thêm bởi admin Picnic Team', '2021-06-23 04:25:46', 'adm_photoes.php', 0),
(106, '<b>Game Game đu dây dưới nước(ID=3)</b> đã được update bởi admin Picnic Team', '2021-06-23 04:26:01', 'adm_games.php', 0),
(107, '<b>Photo sdfsdf</b> đã được thêm bởi admin Picnic Team', '2021-06-23 04:27:28', 'adm_photoes.php', 0),
(108, '<b>Photo fasdf</b> đã được thêm bởi admin Picnic Team', '2021-06-23 04:28:03', 'adm_photoes.php', 0),
(109, '<b>Photo fafsd</b> đã được thêm bởi admin Picnic Team', '2021-06-23 04:28:42', 'adm_photoes.php', 0),
(110, '<b>Photo fasdf</b> đã được thêm bởi admin Picnic Team', '2021-06-23 04:29:04', 'adm_photoes.php', 0),
(111, '<b>Photo fafsd(ID=30)</b> đã được update bởi admin Picnic Team', '2021-06-23 04:30:25', 'adm_photoes.php', 0),
(112, '<b>Game Game đu dây vượt qua thử thách 02(ID=6)</b> đã được update bởi admin Picnic Team', '2021-06-23 04:33:31', 'adm_games.php', 0),
(113, '<b>Album Đu dây thử thách - 02</b> đã được tạo bỏi admin Picnic Team', '2021-06-23 04:34:17', 'adm_albums.php', 0),
(114, '<b>Photo sdf</b> đã được thêm bởi admin Picnic Team', '2021-06-23 04:34:28', 'adm_photoes.php', 0),
(115, '<b>Photo fsadf</b> đã được thêm bởi admin Picnic Team', '2021-06-23 04:34:46', 'adm_photoes.php', 0),
(116, '<b>Photo sdf(ID=32)</b> đã được update bởi admin Picnic Team', '2021-06-23 04:35:25', 'adm_photoes.php', 0),
(117, '<b>Photo fsadf(ID=33)</b> đã được update bởi admin Picnic Team', '2021-06-23 04:35:54', 'adm_photoes.php', 0),
(118, '<b>Photo fasdf</b> đã được thêm bởi admin Picnic Team', '2021-06-23 04:36:41', 'adm_photoes.php', 0),
(119, '<b>Photo gsdfgdf</b> đã được thêm bởi admin Picnic Team', '2021-06-23 04:36:57', 'adm_photoes.php', 0),
(120, '<b>Photo hfsdg</b> đã được thêm bởi admin Picnic Team', '2021-06-23 04:37:17', 'adm_photoes.php', 0),
(121, '<b>Game Chèo thuyền kayak 02(ID=5)</b> đã được update bởi admin Picnic Team', '2021-06-23 04:38:54', 'adm_games.php', 0),
(122, '<b>Game Game đu dây vượt qua thử thách(ID=2)</b> đã được update bởi admin Picnic Team', '2021-06-23 04:39:00', 'adm_games.php', 0),
(123, '<b>Game Chèo thuyền kayak(ID=1)</b> đã được update bởi admin Picnic Team', '2021-06-23 04:39:08', 'adm_games.php', 0),
(124, '<b>Video keo co 240p</b> đã được thêm bởi admin Picnic Team', '2021-06-23 05:38:19', 'adm_videos.php', 0),
(125, '<b>Video dfsdf</b> đã được thêm bởi admin Picnic Team', '2021-06-23 05:43:43', 'adm_videos.php', 0),
(126, '<b>Video kayak kid</b> đã được thêm bởi admin Picnic Team', '2021-06-23 05:48:17', 'adm_videos.php', 0),
(127, 'John Wick đã bình luận về bài viết games_detail.php?id=2', '2021-06-23 06:09:48', '../games_detail.php?id=2&cmt=2', 0),
(128, 'Ka ka đã bình luận về bài viết games_detail.php?id=5', '2021-06-23 06:10:59', '../games_detail.php?id=5&cmt=3', 0),
(129, 'Bá Kiến đã bình luận về bài viết games_detail.php?id=6', '2021-06-23 06:11:57', '../games_detail.php?id=6&cmt=4', 0),
(130, 'Aqua Man đã bình luận về bài viết games_detail.php?id=3', '2021-06-23 06:12:43', '../games_detail.php?id=3&cmt=5', 0),
(131, 'Cụ Già đã bình luận về bài viết games_detail.php?id=4', '2021-06-23 06:13:18', '../games_detail.php?id=4&cmt=6', 0),
(132, 'Picnic Team - admin đã trả lời một bình luận trong bài viết games_detail.php?id=1', '2021-06-23 06:14:37', '../games_detail.php?id=1&cmt=1', 0),
(133, 'Picnic Team - admin đã trả lời một bình luận trong bài viết games_detail.php?id=2', '2021-06-23 06:15:45', '../games_detail.php?id=2&cmt=2', 0),
(134, 'Picnic Team - admin đã trả lời một bình luận trong bài viết games_detail.php?id=5', '2021-06-23 06:16:46', '../games_detail.php?id=5&cmt=3', 0),
(135, 'Picnic Team - admin đã trả lời một bình luận trong bài viết games_detail.php?id=6', '2021-06-23 06:17:08', '../games_detail.php?id=6&cmt=4', 0),
(136, 'Picnic Team - admin đã trả lời một bình luận trong bài viết games_detail.php?id=3', '2021-06-23 06:17:29', '../games_detail.php?id=3&cmt=5', 0),
(137, 'Picnic Team - admin đã bình luận về bài viết games_detail.php?id=4', '2021-06-23 06:17:54', '../games_detail.php?id=4&cmt=7', 0),
(138, 'Picnic Team - admin đã bình luận về bài viết albums.php?', '2021-06-23 07:16:47', '../albums.php?&cmt=8', 0),
(139, 'Messi đã bình luận về bài viết places.php?', '2021-06-23 07:18:08', '../places.php?&cmt=9', 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `cus_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `status` tinyint(4) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `orders`
--

INSERT INTO `orders` (`id`, `cus_id`, `created_at`, `status`) VALUES
(1, 1, '2021-01-20 00:00:00', 2),
(2, 2, '2021-02-20 00:00:00', 2),
(3, 3, '2021-03-20 00:00:00', 2),
(4, 4, '2021-04-20 00:00:00', 2),
(5, 5, '2021-05-20 00:00:00', 2),
(6, 6, '2021-06-20 00:00:00', 2),
(7, 7, '2021-06-22 18:22:49', 2),
(8, 8, '2021-06-22 18:24:15', 0),
(9, 9, '2021-06-22 18:24:59', 1),
(10, 10, '2021-06-22 18:31:07', 0),
(11, 11, '2021-06-22 19:02:25', 0),
(12, 12, '2021-06-22 19:06:14', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders_details`
--

CREATE TABLE `orders_details` (
  `id` int(11) NOT NULL,
  `price` float NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `order_id` int(11) DEFAULT NULL,
  `game_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `orders_details`
--

INSERT INTO `orders_details` (`id`, `price`, `quantity`, `created_at`, `order_id`, `game_id`) VALUES
(1, 80000, 4, '2021-01-20 00:00:00', 1, 1),
(2, 80000, 6, '2021-02-20 00:00:00', 2, 1),
(3, 80000, 5, '2021-03-20 00:00:00', 3, 1),
(4, 80000, 7, '2021-04-20 00:00:00', 4, 1),
(5, 80000, 4, '2021-05-20 00:00:00', 5, 1),
(6, 80000, 3, '2021-06-20 00:00:00', 6, 1),
(7, 80000, 2, '2021-06-22 18:22:49', 7, 5),
(8, 60000, 2, '2021-06-22 18:22:49', 7, 4),
(9, 50000, 1, '2021-06-22 18:22:49', 7, 3),
(10, 90000, 1, '2021-06-22 18:24:15', 8, 6),
(11, 50000, 2, '2021-06-22 18:24:59', 9, 11),
(12, 60000, 1, '2021-06-22 18:31:07', 10, 8),
(13, 80000, 1, '2021-06-22 18:31:07', 10, 9),
(14, 80000, 1, '2021-06-22 19:02:25', 11, 1),
(15, 90000, 2, '2021-06-22 19:02:25', 11, 2),
(16, 60000, 1, '2021-06-22 19:06:14', 12, 8);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `photoes`
--

CREATE TABLE `photoes` (
  `id` int(11) NOT NULL,
  `title` varchar(200) DEFAULT NULL,
  `address` varchar(200) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `album_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `photoes`
--

INSERT INTO `photoes` (`id`, `title`, `address`, `created_at`, `updated_at`, `album_id`) VALUES
(1, 'hl01', 'https://cdn.haikayak.com/wp-content/uploads/2016/11/cheo-kayak-4.jpg', '2021-06-22 18:41:06', '2021-06-22 18:41:06', 2),
(2, 'hl02', 'https://i1-dulich.vnecdn.net/2020/05/13/shutterstock-710476447-8013-1589346123.jpg?w=0&h=0&q=100&dpr=1&fit=crop&s=dkZcknDYVu2f6Y9Z_iUoLQ', '2021-06-22 18:42:02', '2021-06-22 18:42:02', 2),
(3, 'hl03', 'https://wiki-travel.com.vn/Uploads/Post/Thaophuongnguyen-164619034643-KAYAK-4.jpg', '2021-06-22 18:42:33', '2021-06-22 18:42:33', 2),
(4, 'hl04', 'https://lh3.googleusercontent.com/proxy/BVcrOlbhUOSkbkxEKT3uUlxlgE-8otMOkp-Cvr-Tsi3gkVJ8jZQ6XlvwGGTQfqOkwmJsCUkTx3Lm7ht9cJuvPywxZOjnbKrzq8r79PxtQlKQ9V8n9aeFNaN3Y7Xnnx34HvINjA', '2021-06-22 18:43:05', '2021-06-22 18:43:05', 2),
(5, 'hl05', 'https://media.ex-cdn.com/EXP/media.vntravellive.com/files/news/2020/08/18/cheo-thuyen-kayak-kham-pha-trang-an-141209.jpg', '2021-06-22 18:43:34', '2021-06-22 18:43:34', 2),
(6, 'pq01', 'https://diatrunghaiphuquoc.com/wp-content/uploads/2021/04/dia-diem-du-lich-phu-quoc-1.jpeg', '2021-06-22 18:44:33', '2021-06-22 18:44:33', 1),
(7, 'pq02', 'https://mgvs.vn/wp-content/uploads/2019/12/cheo-thuyen-kayak-1.jpg', '2021-06-22 18:45:00', '2021-06-22 18:45:00', 1),
(8, 'pq03', 'https://www.vietfuntravel.com.vn/image/data/Blog/cam-nang/du-lich-phu-quoc-cho-khach-nuoc-ngoai/du-lich-phu-quoc-cho-khach-nuoc-ngoai-h5.png', '2021-06-22 18:45:26', '2021-06-22 18:45:26', 1),
(9, 'đu dây 01', 'https://khamphadisan.com.vn/wp-content/uploads/2016/11/High-Rope-Course-da-lat-e1477970591618.jpg', '2021-06-22 18:50:46', '2021-06-22 18:51:21', 3),
(10, 'dây 02', 'https://highlandsporttravel.com/upload/highlandsporttravelcom/image/2019/07/10/high-rope-course-dalat_(3).jpg', '2021-06-22 18:52:02', '2021-06-22 18:52:02', 3),
(11, 'dây 04', 'https://media.dalatcity.org//Images/LDG/mktdalattourist/High%20Rope%20Course/10._636776362166888407.jpg', '2021-06-22 18:52:51', '2021-06-22 18:52:51', 3),
(12, '01', 'https://outdoorcraving.com/wp-content/uploads/2021/05/Kayaking_with_Kids_Bay_Sports_1024x1024.jpeg', '2021-06-23 03:42:07', '2021-06-23 03:42:07', 4),
(13, '02', 'https://www.gadgetreview.com/wp-content/uploads/2018/03/Kayak-for-Kids.jpg', '2021-06-23 03:42:34', '2021-06-23 03:42:34', 4),
(14, '03', 'https://i2.wp.com/parkedinparadise.com/wp-content/uploads/kids-swimming-kayak.jpg', '2021-06-23 03:43:05', '2021-06-23 03:43:05', 4),
(15, '04', 'https://www.outsidepursuits.com/wp-content/uploads/2018/01/Best-Kids-Kayak.jpg', '2021-06-23 03:43:37', '2021-06-23 03:43:37', 4),
(16, '05', 'https://cdn.shopify.com/s/files/1/0976/2004/products/IMG_0411s_1024x1024.jpg?v=1527261744', '2021-06-23 03:44:39', '2021-06-23 03:44:39', 4),
(17, '06', 'https://i2.wp.com/parkedinparadise.com/wp-content/uploads/young-child-kayaking.jpg', '2021-06-23 03:45:43', '2021-06-23 03:45:43', 4),
(18, '07', 'http://www.kayakingkids.com/uploads/1/2/1/6/121680146/hudson-and-imogen-1-400-pixels-wide_orig.jpg', '2021-06-23 03:46:06', '2021-06-23 03:46:06', 4),
(19, '08', 'https://i2.wp.com/parkedinparadise.com/wp-content/uploads/young-child-kayaking.jpg', '2021-06-23 03:46:27', '2021-06-23 03:46:27', 4),
(20, '01', 'http://icdn.dantri.com.vn/zoom/1200_630/59245d4683/2015/12/03/keo-co-2-1449080334431.jpg', '2021-06-23 03:57:24', '2021-06-23 03:57:24', 5),
(21, '02', 'https://img.lovepik.com/photo/50112/5625.jpg_wh860.jpg', '2021-06-23 03:57:57', '2021-06-23 03:57:57', 5),
(22, '03', 'https://thamconhantaonc.com/wp-content/uploads/2019/04/xuan_1_283201813.png', '2021-06-23 03:58:45', '2021-06-23 03:58:45', 5),
(23, '01', 'https://3.bp.blogspot.com/-RWYuKTJSUfo/WYZ5qd7MDdI/AAAAAAAAAto/Z0TgxNrBuCgoOXFvHZPAmeGQ9Ai7M7zzQCEwYBhgL/s1600/3.jpg', '2021-06-23 04:15:42', '2021-06-23 04:15:42', 6),
(24, '02', 'https://thuvienvan.com/wp-content/uploads/2020/05/unnamed-file-167.jpg', '2021-06-23 04:16:03', '2021-06-23 04:16:03', 6),
(25, '04', 'https://static.tuoitre.vn/tto/i/s626//2015/12/06/tthanh-6-read-only-1449358814.jpg', '2021-06-23 04:19:31', '2021-06-23 04:19:31', 6),
(26, 'dfdfgdas', 'https://lh3.googleusercontent.com/proxy/OjQnt2y3htgMAMOF11ww8UF2-uw9wIYaFCTZHFUf_p8A4NMj_5YXN-jGC8B8u3d6m34LkQYSTDR2y336eYj1gsjQ3Qrba6PyEqqBrKz9uHnf6tdpOCS6TFIqlq7OIpizeQcxptsB', '2021-06-23 04:20:41', '2021-06-23 04:20:41', 6),
(27, 'dsff', 'https://thamhiemmekong.com/wp-content/uploads/2019/05/team-building-con-phung-2.jpg', '2021-06-23 04:25:46', '2021-06-23 04:25:46', 7),
(28, 'sdfsdf', 'https://h3jd9zjnmsobj.vcdn.cloud/public/mytravelmap/images/2019/5/28/dieptruchadh1678/thumbnail-600/35c85cf84fa1e28eec536c8550d118a4eeb5b3ef.jpg', '2021-06-23 04:27:28', '2021-06-23 04:27:28', 7),
(29, 'fasdf', 'https://pystravel.vn/uploads/posts/albums/3230/00653c6b78c73e682ee0d7b35bea6d9d.png', '2021-06-23 04:28:03', '2021-06-23 04:28:03', 7),
(30, 'fafsd', 'https://notimefortravel.com/wp-content/uploads/2018/01/du-d%C3%A2y.jpg', '2021-06-23 04:28:42', '2021-06-23 04:30:25', 7),
(31, 'fasdf', 'https://dulichbentre.vn/uploads/tours/cam-300k-an-choi-sach-bach-thien-duong-moi-noi-cach-sai-gon-85km-3266e858636272495808791131.jpg', '2021-06-23 04:29:04', '2021-06-23 04:29:04', 7),
(32, 'sdf', 'https://3.bp.blogspot.com/--w_k2K8UzDg/WEBtVD-U2pI/AAAAAAAADb4/2ArzlDs-fHccnIMx-lKqPfssWX9BNt4xgCLcB/s640/phat-hien-khu-tro-choi-tren-cay-moi-toanh-dang-hot-ran-ran-o-da-lat-1fb876ad636135233226007692', '2021-06-23 04:34:28', '2021-06-23 04:35:25', 8),
(33, 'fsadf', 'https://www.chudu24.com/wp-content/uploads/2018/06/thq11298_16_5_2017_15_11_10_100.jpg', '2021-06-23 04:34:46', '2021-06-23 04:35:54', 8),
(34, 'fasdf', 'https://tgroup.vn/uploads/images/Dalat/dalat-high-rope-course-tgroup-travel-5.jpg', '2021-06-23 04:36:41', '2021-06-23 04:36:41', 8),
(35, 'gsdfgdf', 'https://tgroup.vn/uploads/images/Dalat/dalat-high-rope-course-tgroup-travel-1.jpg', '2021-06-23 04:36:57', '2021-06-23 04:36:57', 8),
(36, 'hfsdg', 'https://cdn.dealtoday.vn/img/s630x420/172e25d0c35c4364a62f784fee3b39da.jpg?sign=bXQ_mLSSpyuse5cA3r0d7Q', '2021-06-23 04:37:17', '2021-06-23 04:37:17', 8);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `places`
--

CREATE TABLE `places` (
  `id` int(11) NOT NULL,
  `title` varchar(200) DEFAULT NULL,
  `thumbnail` varchar(200) DEFAULT NULL,
  `content` longtext DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `description` varchar(500) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `places`
--

INSERT INTO `places` (`id`, `title`, `thumbnail`, `content`, `created_at`, `updated_at`, `description`, `user_id`) VALUES
(1, 'Milford Soundd', 'https://1hot.vn/wp-content/uploads/2020/10/phong-canh-dep-nhat-the-gioi-4.jpg', '<p style=\"font-family: Verdana, Geneva, sans-serif; font-size: 15px; line-height: 26px; margin-bottom: 26px; overflow-wrap: break-word; color: rgb(34, 34, 34);\">Milford Sound là một trong các <strong>phong cảnh đẹp nhất thế giới</strong> ở phía tây nam của Đảo Nam của New Zealand. Nó được biết đến với Đỉnh Mitre cao chót vót. Cộng với rừng nhiệt đới và thác nước như thác Stirling và thác Bowen, đổ xuống các mặt tuyệt đẹp của nó. </p><p style=\"font-family: Verdana, Geneva, sans-serif; font-size: 15px; line-height: 26px; margin-bottom: 26px; overflow-wrap: break-word; color: rgb(34, 34, 34);\"><img src=\"https://1hot.vn/wp-content/uploads/2020/10/phong-canh-dep-nhat-the-gioi-4.jpg\" style=\"width: 546px;\"><br></p><p style=\"font-family: Verdana, Geneva, sans-serif; font-size: 15px; line-height: 26px; margin-bottom: 26px; overflow-wrap: break-word; color: rgb(34, 34, 34);\">Fiord là nơi sinh sống của các đàn hải cẩu lông, chim cánh cụt và cá heo. Trung tâm Khám phá Milford và Đài quan sát dưới nước có tầm nhìn ra san hô đen quý hiếm và các sinh vật biển khác. Các chuyến tham quan bằng thuyền là một cách phổ biến để khám phá cảnh đẹp nơi đây. </p><p style=\"font-family: Verdana, Geneva, sans-serif; font-size: 15px; line-height: 26px; margin-bottom: 26px; overflow-wrap: break-word; color: rgb(34, 34, 34);\">Milford Sound thu hút từ 550.000 đến 1 triệu du khách mỗi năm. Điều này làm cho Sound trở thành một trong những điểm du lịch được ghé thăm nhiều nhất của New Zealand. Đây còn là một trong những điểm đến tốt nhất thế giới để nhảy dù. Nhiều du khách tham gia một trong những chuyến tham quan bằng thuyền thường kéo dài từ một đến hai giờ.</p><p style=\"font-family: Verdana, Geneva, sans-serif; font-size: 15px; line-height: 26px; margin-bottom: 26px; overflow-wrap: break-word; color: rgb(34, 34, 34);\">Đặc trưng:</p><ul style=\"padding: 0px; margin-bottom: 26px; color: rgb(34, 34, 34); font-family: Verdana, Geneva, sans-serif; font-size: 15px;\"><li style=\"line-height: 26px; margin-left: 21px;\">Cảnh quan: Cửa biển ở Thung lũng Gal Justice</li><li style=\"line-height: 26px; margin-left: 21px;\">Địa điểm: Fiordland, New Zealand</li><li style=\"line-height: 26px; margin-left: 21px;\">Độ cao: 1.692 mét (5.551 ft)</li><li style=\"line-height: 26px; margin-left: 21px;\">Thời gian tốt nhất để ghé thăm: tháng 11 đến tháng 3</li><li style=\"line-height: 26px; margin-left: 21px;\">Diện tích vùng vịnh: 25 km² </li></ul>', '2021-05-25 22:26:38', '2021-06-22 18:19:54', 'Milford Sound là một trong các phong cảnh đẹp nhất thế giới ở phía tây nam của Đảo Nam của New Zealand. Nó được biết đến với Đỉnh Mitre cao chót vót. Cộng với rừng nhiệt đới và thác nước như thác Stirling và thác Bowen, đổ xuống các mặt tuyệt đẹp của nó...', 1),
(2, 'Vách đá Moher', 'https://1hot.vn/wp-content/uploads/2020/10/phong-canh-dep-nhat-the-gioi-1.jpg', '<p style=\"font-family: Verdana, Geneva, sans-serif; font-size: 15px; line-height: 26px; margin-bottom: 26px; overflow-wrap: break-word; color: rgb(34, 34, 34);\">Vách đá Moher là cảnh đẹp tự nhiên về vách đá biên, nằm ở nằm ở rìa phía tây nam của vùng Burren ở County Clare, Ireland. Chiều dài chạy dọc khoảng 14 km. Cuối cùng phía nam của vách đá, độ cao tăng 120 mét (390 ft), nằm trên Đại Tây Dương tại Trụ Hag. Và 8 km (5 dặm) về phía bắc, chúng đạt đến chiều cao tối đa là 214 mét (702 ft), nằm ở phía bắc của O’ Tháp Brien. </p><p style=\"font-family: Verdana, Geneva, sans-serif; font-size: 15px; line-height: 26px; margin-bottom: 26px; overflow-wrap: break-word; color: rgb(34, 34, 34);\">Từ các vách đá và từ trên đỉnh tháp, du khách có thể nhìn thấy cảnh đẹp là Quần đảo Aran ở Vịnh Galway, các dãy núi Maum Turks và Twelve Pins ở phía bắc ở County Galway, và Loop Head ở phía nam. Các vách đá xếp hạng trong số các địa điểm du lịch được ghé thăm nhiều nhất ở Ireland. Với khoảng 1,5 triệu lượt khách ghé thăm mỗi năm. Tại một trong những đất nước hòa bình, đây là một trong những nơi tốt nhất trên thế giới.</p><p style=\"font-family: Verdana, Geneva, sans-serif; font-size: 15px; line-height: 26px; margin-bottom: 26px; overflow-wrap: break-word; color: rgb(34, 34, 34);\">Đặc trưng: </p><ul style=\"padding: 0px; margin-bottom: 26px; color: rgb(34, 34, 34); font-family: Verdana, Geneva, sans-serif; font-size: 15px;\"><li style=\"line-height: 26px; margin-left: 21px;\">Cảnh quan: Vách đá biển</li><li style=\"line-height: 26px; margin-left: 21px;\">Địa điểm: Lahinch, Ireland</li><li style=\"line-height: 26px; margin-left: 21px;\">Độ cao: 155 mét (509 ft)</li><li style=\"line-height: 26px; margin-left: 21px;\">Mùa cao điểm: tháng 6-8 </li></ul>', '2021-06-22 18:11:50', '2021-06-22 18:20:14', 'Vách đá Moher là cảnh đẹp tự nhiên về vách đá biên, nằm ở nằm ở rìa phía tây nam của vùng Burren ở County Clare, Ireland', 1),
(3, 'Vườn quốc gia Banff (Hồ Louise)', 'https://1hot.vn/wp-content/uploads/2020/10/phong-canh-dep-nhat-the-gioi-3.jpg', '<p style=\"font-family: Verdana, Geneva, sans-serif; font-size: 15px; line-height: 26px; margin-bottom: 26px; overflow-wrap: break-word; color: rgb(34, 34, 34);\">Vườn quốc gia Banff là một địa điểm tham quan có <strong>cảnh đẹp</strong> nhất của Canada. Tọa lạc tại Rocky Mountains Alberta, 110-180 km về phía Tây của Calgary. Banff bao gồm 6641 km vuông của địa hình đồi núi, với nhiều sông băng và các lĩnh vực băng, rừng lá kim dày đặc, và cảnh quan núi cao. </p><p style=\"font-family: Verdana, Geneva, sans-serif; font-size: 15px; line-height: 26px; margin-bottom: 26px; overflow-wrap: break-word; color: rgb(34, 34, 34);\">Hồ Louise là một ngôi làng trong Công viên Quốc gia Banff ở Dãy núi đá Canada, nổi tiếng cảnh đẹp với màu nước ngọc lam. Những con đường mòn đi bộ đến Hồ Agnes Tea House để ngắm toàn cảnh. Có một bến xuồng vào mùa hè và một sân trượt băng trên mặt hồ đóng băng vào mùa đông. </p><p style=\"font-family: Verdana, Geneva, sans-serif; font-size: 15px; line-height: 26px; margin-bottom: 26px; overflow-wrap: break-word; color: rgb(34, 34, 34);\">Lake Louise Ski Resort có trung tâm diễn giải về động vật hoang dã trên đỉnh của một chiếc thuyền gondola. Vườn quốc gia này lọt vào danh sách 10 địa điểm có cảnh đẹp nhất thế giới.</p><p style=\"font-family: Verdana, Geneva, sans-serif; font-size: 15px; line-height: 26px; margin-bottom: 26px; overflow-wrap: break-word; color: rgb(34, 34, 34);\">Đặc trưng:</p><ul style=\"padding: 0px; margin-bottom: 26px; color: rgb(34, 34, 34); font-family: Verdana, Geneva, sans-serif; font-size: 15px;\"><li style=\"line-height: 26px; margin-left: 21px;\">Cảnh quan: Hồ băng</li><li style=\"line-height: 26px; margin-left: 21px;\">Địa điểm: Alberta, Canada</li><li style=\"line-height: 26px; margin-left: 21px;\">Độ cao: 1.750 mét (5.740 ft)</li><li style=\"line-height: 26px; margin-left: 21px;\">Mùa cao điểm: Tháng 6-9</li><li style=\"line-height: 26px; margin-left: 21px;\">Diện tích vùng vịnh: 0,8 km²</li></ul>', '2021-06-22 18:13:33', '2021-06-22 18:19:37', 'Vườn quốc gia Banff là một địa điểm tham quan có cảnh đẹp nhất của Canada. Tọa lạc tại Rocky Mountains Alberta, 110-180 km về phía Tây của Calgary', 1),
(4, 'Vườn quốc gia Plitvice Lakes', 'https://1hot.vn/wp-content/uploads/2020/10/phong-canh-dep-nhat-the-gioi-5.jpg', '<p style=\"font-family: Verdana, Geneva, sans-serif; font-size: 15px; line-height: 26px; margin-bottom: 26px; overflow-wrap: break-word; color: rgb(34, 34, 34);\">Vườn quốc gia Plitviče Lakes là một khu bảo tồn rừng rộng 295 km vuông ở miền trung Croatia. Nó được biết đến với cảnh sắc là một chuỗi 16 hồ bậc thang. Cùng với những thác nước tốt nhất thế giới, kéo dài thành một hẻm núi đá vôi.&nbsp;</p><p style=\"font-family: Verdana, Geneva, sans-serif; font-size: 15px; line-height: 26px; margin-bottom: 26px; overflow-wrap: break-word; color: rgb(34, 34, 34);\">Các lối đi bộ và đường mòn đi bộ đường dài uốn lượn quanh co trên mặt nước và một chiếc thuyền điện liên kết 12 hồ trên và 4 hồ dưới. Sau đó là địa điểm của Veliki Slap, một thác nước cao 78m.&nbsp; Khoảng 90% diện tích này là một phần của Quận Lika-Senj, trong khi 10% còn lại là một phần của Quận Karlovac.&nbsp;</p><p style=\"font-family: Verdana, Geneva, sans-serif; font-size: 15px; line-height: 26px; margin-bottom: 26px; overflow-wrap: break-word; color: rgb(34, 34, 34);\">Là một trong những nơi có&nbsp;<strong>phong cảnh đẹp nhất thế giới</strong>&nbsp;về thiên nhiên hoang sơ. Mỗi năm, hơn 1 triệu lượt khách được ghi nhận. Vào cửa có mức phí thay đổi, lên đến 250 kuna hoặc khoảng € 34 mỗi người lớn mỗi ngày vào mùa hè.</p><p style=\"font-family: Verdana, Geneva, sans-serif; font-size: 15px; line-height: 26px; margin-bottom: 26px; overflow-wrap: break-word; color: rgb(34, 34, 34);\">Đặc trưng:&nbsp;</p><ul style=\"padding: 0px; margin-bottom: 26px; color: rgb(34, 34, 34); font-family: Verdana, Geneva, sans-serif; font-size: 15px;\"><li style=\"line-height: 26px; margin-left: 21px;\">Cảnh quan: Vườn quốc gia</li><li style=\"line-height: 26px; margin-left: 21px;\">Vị trí: Hạt Karlovac, Croatia</li><li style=\"line-height: 26px; margin-left: 21px;\">Độ cao: 1279 mét</li><li style=\"line-height: 26px; margin-left: 21px;\">Mùa cao điểm: Tháng 9 – Tháng 4</li><li style=\"line-height: 26px; margin-left: 21px;\">Diện tích vườn quốc gia: 295 km²</li></ul>', '2021-06-22 18:14:54', '2021-06-22 18:14:54', 'Vườn quốc gia Plitviče Lakes là một khu bảo tồn rừng rộng 295 km vuông ở miền trung Croatia. Nó được biết đến với cảnh sắc là một chuỗi 16 hồ bậc thang. Cùng với những thác nước tốt nhất thế giới, kéo dài thành một hẻm núi đá vôi. ', 1),
(5, 'Hẻm núi Grand Canyon', 'https://1hot.vn/wp-content/uploads/2020/10/phong-canh-dep-nhat-the-gioi-6.jpg', '<p style=\"font-family: Verdana, Geneva, sans-serif; font-size: 15px; line-height: 26px; margin-bottom: 26px; overflow-wrap: break-word; color: rgb(34, 34, 34);\">Grand Canyon ở Arizona là một <strong>cảnh đẹp</strong> được hình thành tự nhiên. Được phân biệt bởi các dải đá đỏ nhiều lớp, tiết lộ hàng triệu năm lịch sử địa chất theo mặt cắt ngang. Phần lớn diện tích là công viên quốc gia, với những ghềnh thác nước trắng xóa trên sông Colorado và khung cảnh bao la. </p><p style=\"font-family: Verdana, Geneva, sans-serif; font-size: 15px; line-height: 26px; margin-bottom: 26px; overflow-wrap: break-word; color: rgb(34, 34, 34);\">Grand Canyon có chiều dài là 277 dặm (446 km), lên đến 18 dặm (29 km) rộng và đạt độ sâu hơn một dặm (6.093 feet hoặc 1.857 mét). Hoa Kỳ là quốc gia có lượng du khách quốc tế đến du lịch cao nhất. Hẻm núi là nơi tham quan đẹp nhất trên thế giới. </p><p style=\"font-family: Verdana, Geneva, sans-serif; font-size: 15px; line-height: 26px; margin-bottom: 26px; overflow-wrap: break-word; color: rgb(34, 34, 34);\">Có một số tòa nhà lịch sử nằm dọc theo South Rim, hầu hết đều nằm trong vùng lân cận của Làng Grand Canyon. Đây cũng là một trong 7 kỳ quan thiên nhiên của thế giới.</p><p style=\"font-family: Verdana, Geneva, sans-serif; font-size: 15px; line-height: 26px; margin-bottom: 26px; overflow-wrap: break-word; color: rgb(34, 34, 34);\">Đặc trưng: </p><ul style=\"padding: 0px; margin-bottom: 26px; color: rgb(34, 34, 34); font-family: Verdana, Geneva, sans-serif; font-size: 15px;\"><li style=\"line-height: 26px; margin-left: 21px;\">Cảnh quan: hẻm núi</li><li style=\"line-height: 26px; margin-left: 21px;\">Vị trí: Arizona, US</li><li style=\"line-height: 26px; margin-left: 21px;\">Độ cao: 2.400 mét</li><li style=\"line-height: 26px; margin-left: 21px;\">Thời gian tốt nhất để ghé thăm: Tháng Ba – Tháng Năm & Tháng Chín – Tháng Mười Một.</li><li style=\"line-height: 26px; margin-left: 21px;\">Diện tích vùng vịnh: 4,926 km²</li></ul>', '2021-06-22 18:15:41', '2021-06-22 18:20:08', 'Grand Canyon ở Arizona là một cảnh đẹp được hình thành tự nhiên. Được phân biệt bởi các dải đá đỏ nhiều lớp, tiết lộ hàng triệu năm lịch sử địa chất theo mặt cắt ngang', 1),
(6, 'Rạn san hô Great Barrier', 'https://1hot.vn/wp-content/uploads/2020/10/phong-canh-dep-nhat-the-gioi-7.jpg', '<p style=\"font-family: Verdana, Geneva, sans-serif; font-size: 15px; line-height: 26px; margin-bottom: 26px; overflow-wrap: break-word; color: rgb(34, 34, 34);\">Rạn san hô Great Barrier là hệ thống rạn san hô lớn nhất thế giới bao gồm hơn 2.900 rạn san hô riêng lẻ và 900 hòn đảo. Trải dài hơn 2.300 km trên diện tích khoảng 344.400 km vuông.&nbsp;</p><p style=\"font-family: Verdana, Geneva, sans-serif; font-size: 15px; line-height: 26px; margin-bottom: 26px; overflow-wrap: break-word; color: rgb(34, 34, 34);\">Rạn san hô nằm ở Biển Coral, ngoài khơi Queensland, Australia. Rạn san hô Great Barrier Reef có thể được nhìn thấy từ ngoài không gian. Và là cấu trúc đơn lẻ lớn nhất thế giới do các sinh vật sống tạo ra.&nbsp;</p><p style=\"font-family: Verdana, Geneva, sans-serif; font-size: 15px; line-height: 26px; margin-bottom: 26px; overflow-wrap: break-word; color: rgb(34, 34, 34);\">Bãi biển Whitehaven trải dài 7 km dọc theo Đảo Whitsunday, Úc. Có thể đến đảo bằng thuyền, thủy phi cơ và trực thăng từ Bãi biển Airlie, cũng như Đảo Hamilton. Nó nằm đối diện với Bãi biển Stockyard, hay còn được gọi là Bãi biển Chalkie, trên Đảo Haslewood. Đảo tốt nhất của Úc là một trong những nơi có&nbsp;<strong>phong cảnh đẹp nhất thế giới</strong>. Đây cũng là một nơi tốt nhất để nhảy dù .</p><p style=\"font-family: Verdana, Geneva, sans-serif; font-size: 15px; line-height: 26px; margin-bottom: 26px; overflow-wrap: break-word; color: rgb(34, 34, 34);\">Đặc trưng:&nbsp;</p><ul style=\"padding: 0px; margin-bottom: 26px; color: rgb(34, 34, 34); font-family: Verdana, Geneva, sans-serif; font-size: 15px;\"><li style=\"line-height: 26px; margin-left: 21px;\">Cảnh quan: Rạn san hô</li><li style=\"line-height: 26px; margin-left: 21px;\">Địa điểm: Queensland, Úc</li><li style=\"line-height: 26px; margin-left: 21px;\">Độ cao: Dưới biển</li><li style=\"line-height: 26px; margin-left: 21px;\">Thời gian tốt nhất để ghé thăm: tháng 4 đến tháng 11</li><li style=\"line-height: 26px; margin-left: 21px;\">Diện tích vùng vịnh: 348.700 km²</li></ul>', '2021-06-22 18:16:25', '2021-06-22 18:16:25', 'Rạn san hô Great Barrier là hệ thống rạn san hô lớn nhất thế giới bao gồm hơn 2.900 rạn san hô riêng lẻ và 900 hòn đảo. Trải dài hơn 2.300 km trên diện tích khoảng 344.400 km vuông. ', 1),
(7, 'Cánh đồng muối Uyuni Flat (Salar de Uyuni)', 'https://1hot.vn/wp-content/uploads/2020/10/phong-canh-dep-nhat-the-gioi-8.jpg', '<p style=\"font-family: Verdana, Geneva, sans-serif; font-size: 15px; line-height: 26px; margin-bottom: 26px; overflow-wrap: break-word; color: rgb(34, 34, 34);\">Salar de Uyuni, nằm giữa dãy Andes ở tây nam Bolivia, là đồng muối lớn nhất thế giới. Đó là di sản của một hồ thời tiền sử khô cạn. Để lại một vùng hoang mạc rộng gần 11.000 km vuông.&nbsp;</p><p style=\"font-family: Verdana, Geneva, sans-serif; font-size: 15px; line-height: 26px; margin-bottom: 26px; overflow-wrap: break-word; color: rgb(34, 34, 34);\"><strong>Cảnh đẹp</strong>&nbsp;của muối trắng sáng, các thành tạo đá và các hòn đảo đầy xương rồng. Có thể quan sát được sự mở rộng ra các vùng xung quanh khác của nó từ đảo Incahuasi ở trung tâm. Mặc dù động vật hoang dã rất hiếm trong hệ sinh thái độc đáo này, nhưng nơi đây có rất nhiều loài hồng hạc.&nbsp;</p><p style=\"font-family: Verdana, Geneva, sans-serif; font-size: 15px; line-height: 26px; margin-bottom: 26px; overflow-wrap: break-word; color: rgb(34, 34, 34);\">Salar de Uyuni là một phần của Altiplano của Bolivia ở Nam Mỹ. Altiplano là một cao nguyên cao, được hình thành trong quá trình nâng lên của dãy núi Andes. Cao nguyên bao gồm các hồ nước ngọt và nước mặn. Cũng như các bãi muối và được bao quanh bởi các dãy núi không có cửa thoát nước. Nơi độc đáo này là một trong những nơi có cảnh đẹp nhất trên thế giới.</p><p style=\"font-family: Verdana, Geneva, sans-serif; font-size: 15px; line-height: 26px; margin-bottom: 26px; overflow-wrap: break-word; color: rgb(34, 34, 34);\">Đặc trưng:&nbsp;</p><ul style=\"padding: 0px; margin-bottom: 26px; color: rgb(34, 34, 34); font-family: Verdana, Geneva, sans-serif; font-size: 15px;\"><li style=\"line-height: 26px; margin-left: 21px;\">Phong cảnh: Chảo muối, Hồ khô</li><li style=\"line-height: 26px; margin-left: 21px;\">Địa điểm: Altiplano, Bolivia</li><li style=\"line-height: 26px; margin-left: 21px;\">Độ cao: 3.656 mét (11.995 ft)</li><li style=\"line-height: 26px; margin-left: 21px;\">Mùa cao điểm: Tháng 9-Tháng 4</li><li style=\"line-height: 26px; margin-left: 21px;\">Diện tích vùng vịnh: 10.582 km²</li></ul>', '2021-06-22 18:17:12', '2021-06-22 18:17:12', 'Salar de Uyuni, nằm giữa dãy Andes ở tây nam Bolivia, là đồng muối lớn nhất thế giới. Đó là di sản của một hồ thời tiền sử khô cạn. Để lại một vùng hoang mạc rộng gần 11.000 km vuông. ', 1),
(8, 'Thác Iguazu (Thác Iguacu)', 'https://1hot.vn/wp-content/uploads/2020/10/phong-canh-dep-nhat-the-gioi-9.jpg', '<p style=\"font-family: Verdana, Geneva, sans-serif; font-size: 15px; line-height: 26px; margin-bottom: 26px; overflow-wrap: break-word; color: rgb(34, 34, 34);\">Thác Iguazu hay Thác Iguacu là thác nước của sông Iguazu ở biên giới giữa tỉnh Misiones của Argentina và bang Parana của Brazil. Cùng nhau, chúng tạo nên cảnh đẹp hoang sơ của thác nước lớn nhất thế giới. Các thác này chia sông thành Iguazu thượng và hạ lưu.&nbsp;</p><p style=\"font-family: Verdana, Geneva, sans-serif; font-size: 15px; line-height: 26px; margin-bottom: 26px; overflow-wrap: break-word; color: rgb(34, 34, 34);\">Vườn quốc gia Iguazu bao gồm một khu vực rừng mưa cận nhiệt đới ở tỉnh Misiones của Argentina, trên biên giới với Brazil. Trong công viên trên sông Iguazu, thác Iguazu nổi tiếng bao gồm nhiều thác riêng biệt. Có cả Garganta del Diablo mang tính biểu tượng hay còn gọi là “Họng của quỷ”.&nbsp;</p><p style=\"font-family: Verdana, Geneva, sans-serif; font-size: 15px; line-height: 26px; margin-bottom: 26px; overflow-wrap: break-word; color: rgb(34, 34, 34);\">Công viên xung quanh có các loài động vật hoang dã đa dạng bao gồm báo đốm và các loài chim cùng với những con đường mòn và bệ ngắm cảnh. Nơi đây trở thành cảnh đẹp có một không hai.</p><p style=\"font-family: Verdana, Geneva, sans-serif; font-size: 15px; line-height: 26px; margin-bottom: 26px; overflow-wrap: break-word; color: rgb(34, 34, 34);\">Đặc trưng:&nbsp;</p><ul style=\"padding: 0px; margin-bottom: 26px; color: rgb(34, 34, 34); font-family: Verdana, Geneva, sans-serif; font-size: 15px;\"><li style=\"line-height: 26px; margin-left: 21px;\">Cảnh quan: Thác rừng nhiệt đới</li><li style=\"line-height: 26px; margin-left: 21px;\">Địa điểm: Vườn quốc gia Iguazu, Argentina-Brazil</li><li style=\"line-height: 26px; margin-left: 21px;\">Độ cao: 195 mét</li><li style=\"line-height: 26px; margin-left: 21px;\">Thời gian tốt nhất để ghé thăm: Bất kỳ mùa nào</li><li style=\"line-height: 26px; margin-left: 21px;\">Diện tích Vườn quốc gia: 677 km²</li></ul>', '2021-06-22 18:17:53', '2021-06-22 18:17:53', 'Thác Iguazu hay Thác Iguacu là thác nước của sông Iguazu ở biên giới giữa tỉnh Misiones của Argentina và bang Parana của Brazil. Cùng nhau, chúng tạo nên cảnh đẹp hoang sơ của thác nước lớn nhất thế giới. Các thác này chia sông thành Iguazu thượng và hạ lưu. ', 1),
(9, 'Vịnh Hạ Long – Cảnh đẹp núi non', 'https://1hot.vn/wp-content/uploads/2020/10/phong-canh-dep-nhat-the-gioi-2.jpg', '<p style=\"font-family: Verdana, Geneva, sans-serif; font-size: 15px; line-height: 26px; margin-bottom: 26px; overflow-wrap: break-word; color: rgb(34, 34, 34);\">Vịnh Hạ Long, ở phía đông bắc Việt Nam. Địa điểm này được biết đến với là một trong những&nbsp;<strong>phong cảnh đẹp nhất thế giới</strong>, được Unesco công nhận là một trong 7 kỳ quan thế giới. Hạ Long có làn nước màu ngọc bích và hàng nghìn hòn đảo đá vôi cao chót vót được bao phủ bởi&nbsp;<a href=\"https://1hot.vn/rung-nhiet-doi-dac-diem-va-top-10-rung-lon-nhat-the-gioi.html\" style=\"color: rgb(77, 178, 236);\"><strong>rừng nhiệt đới</strong></a>. Các tour du lịch bằng thuyền mành và các cuộc thám hiểm bằng thuyền kayak trên biển. Sẽ đưa du khách đi qua các hòn đảo được đặt tên theo hình dạng của chúng. Bao gồm hòn đảo Con chó và Ấm trà.&nbsp;</p><p style=\"font-family: Verdana, Geneva, sans-serif; font-size: 15px; line-height: 26px; margin-bottom: 26px; overflow-wrap: break-word; color: rgb(34, 34, 34);\">Khu vực này nổi tiếng với hoạt động lặn biển, leo núi và đi bộ đường dài, đặc biệt là ở Vườn quốc gia miền núi Cát Bà. Đá vôi ở vịnh này đã trải qua 500 triệu năm hình thành trong các điều kiện và môi trường khác nhau.&nbsp;</p><p style=\"font-family: Verdana, Geneva, sans-serif; font-size: 15px; line-height: 26px; margin-bottom: 26px; overflow-wrap: break-word; color: rgb(34, 34, 34);\">Việt Nam là một địa điểm du lịch có nhiều cảnh đẹp trên thế giới. Đây là ngôi nhà của 14 loài thực vật đặc hữu và 60 loài động vật đặc hữu. Vịnh nằm ở một trong những quốc gia châu Á tốt nhất để du lịch. Được xếp vào danh sách những địa điểm đẹp trên thế giới với cảnh sắc thiên nhiên.</p><p style=\"font-family: Verdana, Geneva, sans-serif; font-size: 15px; line-height: 26px; margin-bottom: 26px; overflow-wrap: break-word; color: rgb(34, 34, 34);\">Đặc trưng:</p><ul style=\"padding: 0px; margin-bottom: 26px; color: rgb(34, 34, 34); font-family: Verdana, Geneva, sans-serif; font-size: 15px;\"><li style=\"line-height: 26px; margin-left: 21px;\">Cảnh quan: Vịnh với quần đảo</li><li style=\"line-height: 26px; margin-left: 21px;\">Địa điểm: Quảng Ninh, Việt Nam</li><li style=\"line-height: 26px; margin-left: 21px;\">Độ cao: 100 mét</li><li style=\"line-height: 26px; margin-left: 21px;\">Thời gian tốt nhất để ghé thăm: Bất kỳ mùa nào</li><li style=\"line-height: 26px; margin-left: 21px;\">Diện tích vùng vịnh: 1.553 km²</li></ul>', '2021-06-22 18:19:15', '2021-06-22 18:19:15', 'Vịnh Hạ Long, ở phía đông bắc Việt Nam. Địa điểm này được biết đến với là một trong những phong cảnh đẹp nhất thế giới, được Unesco công nhận là một trong 7 kỳ quan thế giới.', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sub_comments`
--

CREATE TABLE `sub_comments` (
  `id` int(11) NOT NULL,
  `guest_name` varchar(100) DEFAULT NULL,
  `content` varchar(500) NOT NULL,
  `father_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `avatar` varchar(500) DEFAULT 'https://icdn.dantri.com.vn/images/no-avatar.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `sub_comments`
--

INSERT INTO `sub_comments` (`id`, `guest_name`, `content`, `father_id`, `created_at`, `avatar`) VALUES
(1, 'Iron Man', 'Thiệt hả ?', 1, '2021-06-22 19:00:41', 'https://icdn.dantri.com.vn/images/no-avatar.png'),
(2, 'Picnic Team - admin', 'Cám ơn các bạn đã đóng góp ý kiến !', 1, '2021-06-23 06:14:37', 'https://scontent-hkg4-2.xx.fbcdn.net/v/t1.6435-9/54514819_2121950994761484_2297120214103359488_n.jpg?_nc_cat=109&ccb=1-3&_nc_sid=174925&_nc_ohc=Zz0gF1ubXwgAX8WE0Yn&_nc_ht=scontent-hkg4-2.xx&oh=4d0720d02591c4740153042bfb7c87f3&oe=60E34D5E'),
(3, 'Picnic Team - admin', 'Bảo đảm an toàn tuyệt đối ,không sợ bị rơi đâu bạn ơi ', 2, '2021-06-23 06:15:45', 'https://scontent-hkg4-2.xx.fbcdn.net/v/t1.6435-9/54514819_2121950994761484_2297120214103359488_n.jpg?_nc_cat=109&ccb=1-3&_nc_sid=174925&_nc_ohc=Zz0gF1ubXwgAX8WE0Yn&_nc_ht=scontent-hkg4-2.xx&oh=4d0720d02591c4740153042bfb7c87f3&oe=60E34D5E'),
(4, 'Picnic Team - admin', 'Cám ơn bạn . Hi vọng sớm được đón tiếp các bạn thêm nhiều  lần nữa ', 3, '2021-06-23 06:16:46', 'https://scontent-hkg4-2.xx.fbcdn.net/v/t1.6435-9/54514819_2121950994761484_2297120214103359488_n.jpg?_nc_cat=109&ccb=1-3&_nc_sid=174925&_nc_ohc=Zz0gF1ubXwgAX8WE0Yn&_nc_ht=scontent-hkg4-2.xx&oh=4d0720d02591c4740153042bfb7c87f3&oe=60E34D5E'),
(5, 'Picnic Team - admin', 'Đang khuyến mại 90% nè', 4, '2021-06-23 06:17:08', 'https://scontent-hkg4-2.xx.fbcdn.net/v/t1.6435-9/54514819_2121950994761484_2297120214103359488_n.jpg?_nc_cat=109&ccb=1-3&_nc_sid=174925&_nc_ohc=Zz0gF1ubXwgAX8WE0Yn&_nc_ht=scontent-hkg4-2.xx&oh=4d0720d02591c4740153042bfb7c87f3&oe=60E34D5E'),
(6, 'Picnic Team - admin', 'Có ngon không bạn ?', 5, '2021-06-23 06:17:29', 'https://scontent-hkg4-2.xx.fbcdn.net/v/t1.6435-9/54514819_2121950994761484_2297120214103359488_n.jpg?_nc_cat=109&ccb=1-3&_nc_sid=174925&_nc_ohc=Zz0gF1ubXwgAX8WE0Yn&_nc_ht=scontent-hkg4-2.xx&oh=4d0720d02591c4740153042bfb7c87f3&oe=60E34D5E');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone_no` varchar(20) DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `address` varchar(200) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `password` varchar(32) NOT NULL,
  `token` varchar(32) DEFAULT NULL,
  `avatar` varchar(500) DEFAULT 'https://static2.yan.vn/YanNews/2167221/202003/dan-mang-du-trend-thiet-ke-avatar-du-kieu-day-mau-sac-tu-anh-mac-dinh-b0de2bad.jpg',
  `active` tinyint(4) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `fullname`, `email`, `phone_no`, `birthday`, `address`, `created_at`, `updated_at`, `password`, `token`, `avatar`, `active`) VALUES
(1, 'Picnic Team', 'picnic@gmail.com', '0865698896', '2021-06-23', 'Hai Phong', '2021-06-06 15:48:50', '2021-06-06 15:48:50', '8aabc57e58ea34cf54bbc0a6c00061bb', NULL, 'https://scontent-hkg4-2.xx.fbcdn.net/v/t1.6435-9/54514819_2121950994761484_2297120214103359488_n.jpg?_nc_cat=109&ccb=1-3&_nc_sid=174925&_nc_ohc=Zz0gF1ubXwgAX8WE0Yn&_nc_ht=scontent-hkg4-2.xx&oh=4d0720d02591c4740153042bfb7c87f3&oe=60E34D5E', 1),
(2, 'Trần tăng hùng', 'picnic1@gmail.com', '0986-234-876', '1989-01-23', '23 Hà Nội', '2021-06-22 19:04:19', '2021-06-22 19:04:19', 'f30b14ec29f168ec308151d851860209', NULL, 'https://static2.yan.vn/YanNews/2167221/202003/dan-mang-du-trend-thiet-ke-avatar-du-kieu-day-mau-sac-tu-anh-mac-dinh-b0de2bad.jpg', 0),
(3, 'Trần Hùng', 'soikhukho@gmail.com', '0999-354-768', '1996-06-10', 'Hải Phòng', '2021-06-22 19:10:12', '2021-06-23 06:24:59', 'be22810180c5247c846d0270e55fd236', NULL, 'https://static2.yan.vn/YanNews/2167221/202003/dan-mang-du-trend-thiet-ke-avatar-du-kieu-day-mau-sac-tu-anh-mac-dinh-b0de2bad.jpg', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `videos`
--

CREATE TABLE `videos` (
  `id` int(11) NOT NULL,
  `title` varchar(200) DEFAULT NULL,
  `address` varchar(200) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `game_id` int(11) DEFAULT NULL,
  `views` int(11) DEFAULT 1000
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `videos`
--

INSERT INTO `videos` (`id`, `title`, `address`, `created_at`, `updated_at`, `game_id`, `views`) VALUES
(1, 'hướng dẫn chèo thuyền', 'https://www.youtube.com/embed/hUgDjWQPMsI', '2021-06-22 18:58:11', '2021-06-22 18:58:11', 1, 1000),
(2, 'kéo co mầm non', 'https://www.youtube.com/embed/kki-xawirdU', '2021-06-23 04:03:07', '2021-06-23 04:03:07', 8, 1000),
(3, 'keo co 240p', 'keo_co_240P.mp4', '2021-06-23 05:38:19', '2021-06-23 05:38:19', 8, 1000),
(4, 'dfsdf', 'kayak_technique_360p.mp4', '2021-06-23 05:43:43', '2021-06-23 05:43:43', 1, 1000),
(5, 'kayak kid', 'Kayak For Kids  Tutorial_360p.mp4', '2021-06-23 05:48:17', '2021-06-23 05:48:17', 5, 1000);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `albums`
--
ALTER TABLE `albums`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `phone` (`phone`);

--
-- Chỉ mục cho bảng `games`
--
ALTER TABLE `games`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `orders_details`
--
ALTER TABLE `orders_details`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `photoes`
--
ALTER TABLE `photoes`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `places`
--
ALTER TABLE `places`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `title` (`title`);

--
-- Chỉ mục cho bảng `sub_comments`
--
ALTER TABLE `sub_comments`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Chỉ mục cho bảng `videos`
--
ALTER TABLE `videos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `albums`
--
ALTER TABLE `albums`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT cho bảng `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT cho bảng `games`
--
ALTER TABLE `games`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT cho bảng `message`
--
ALTER TABLE `message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=140;

--
-- AUTO_INCREMENT cho bảng `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT cho bảng `orders_details`
--
ALTER TABLE `orders_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT cho bảng `photoes`
--
ALTER TABLE `photoes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT cho bảng `places`
--
ALTER TABLE `places`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT cho bảng `sub_comments`
--
ALTER TABLE `sub_comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `videos`
--
ALTER TABLE `videos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
