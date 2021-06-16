<?php
  require_once 'db/dbhelper.php';
  require_once 'utility/utils.php';

  $index="contact";

  $user = checkLogin();
  include_once 'login.php';
?>

<!DOCTYPE html>
<html>
<head>
  <title>CONTACT US</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <!-- include summernote css/js -->
  <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote.css" rel="stylesheet">
  <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote.js"></script>
  <link rel="stylesheet" type="text/css" href="style/style_header2.css">
  <script src="https://kit.fontawesome.com/3e49906220.js" crossorigin="anonymous"></script>

  <link rel="stylesheet" type="text/css" href="style/style_contact.css">
</head>
<body>
    <?php
        include_once 'layout/header2.php';
        // include_once 'layout/carosell.php';
        include_once 'layout/popup_login.php';

     ?>
     <div class="container" style="min-height: 500px;">
       
        <div class="row infor">
          <!-- Thông tin liên hệ -->

          <div class=" infor-title-left">
            <div class="conten">
              <h2 class="conten-title">Thông tin liên hệ</h2>
              <p class="conten-des">
                Nếu quí khách có câu hỏi thắc mắc cần được giải đáp, xin vui lòng liên lạc với chúng tôi qua các hình thức sau:
              </p>
            </div>
            <div class="box">
              <div class="list-infor">
                <div class="item-infor">
                  <div class="icon"><i class="fas fa-phone-alt"></i></div>
                  <div class="place">
                    <b class="header-title">Điện thoại</b>
                    <a class="body-title" href="tel: 0866759002">035007738</a>
                  </div>
                </div>
                <div class="item-infor">
                  <div class="icon"><i class="far fa-envelope"></i></div>
                  <div class="place">
                    <b class="header-title">Email</b>
                    <a class="body-title" href="mailto:dai.vn.966@aptechlearning.edu.vn?">Email:dai.vn.966@aptechlearning.edu.vn</a>
                  </div>
                </div>
                <div class="item-infor">
                  <div class="icon"><i class="fas fa-map-marker-alt"></i></div>
                  <div class="place">
                    <b class="header-title">Địa chỉ</b>
                    <a class="body-title" href="https://www.google.com/maps/place/54+L%C3%AA+Thanh+Ngh%E1%BB%8B,+B%C3%A1ch+Khoa,+Hai+B%C3%A0+Tr%C6%B0ng,+H%C3%A0+N%E1%BB%99i,+Vi%E1%BB%87t+Nam/@21.0034695,105.846929,17z/data=!3m1!4b1!4m5!3m4!1s0x3135ad58455db2ab:0x9b3550bc22fd8bb!8m2!3d21.0034695!4d105.8491177?hl=vi">Trụ sở chính: 54 Lê Thanh Nghị - Hai Bà Trưng - Hà Nội.</a>
                  </div>
                </div>
              </div>
              <h1 style="margin-top: 40px;">FACEBOOK</h1>
            </div>
          </div>
          <!-- Hỏi đáp -->
          <div class=" infor-title-right">
            <div class="conten">
              <h2 class="conten-title">Hỏi đáp</h2>
              <p class="conten-des">
                Quí khách vui lòng điền thông tin bên dưới. Chúng tôi sẽ cố gắng phản hồn lại trong thời gian sớm nhất.Team Picnic xin chân thành cảm ơn!
              </p>
            </div>
            <div class="box">
              <div class="list-input">
                <div class="name">
                  <div class="input-item">
                    <input type="text" placeholder="Họ và tên*">
                  </div>
                  <div class="input-item" >
                    <input type="text" placeholder="Email*">
                  </div>
                </div>
                <div class="input-item" >
                  <input type="text"  placeholder="Tiêu đề*" style="width: 555px;
                  height: 42px;">
                </div>
                <div class="input-item" id="input-conten">
                  <input  type="text" placeholder="Nôi dung*" style="width: 555px;height: 150px;">
                </div>
              </div>
            </div>
            <button class="btn btn-warning">Gửi</button>
          </div>
          <div class="clear"></div>

          <!-- <div class="map-address" style="margin: 150px 0px;">
            <iframe style="width: 100%;" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3724.7297008861306!2d105.8469290149323!3d21.00346948601218!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135ad58455db2ab%3A0x9b3550bc22fd8bb!2zNTQgTMOqIFRoYW5oIE5naOG7iywgQsOhY2ggS2hvYSwgSGFpIELDoCBUcsawbmcsIEjDoCBO4buZaQ!5e0!3m2!1svi!2s!4v1622017086580!5m2!1svi!2s" width="1260" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
          </div> -->
        </div>

     </div>
    <?php include 'layout/footer.php'; ?>

</body>
</html>
