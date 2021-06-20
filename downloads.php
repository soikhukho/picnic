<?php
  require_once 'db/dbhelper.php';
  require_once 'utility/utils.php';

  $user = checkLogin();
      if ($user=='') {
        header('Location: games.php');
      }

 // output_file(file nguồn , tên sẽ lưu về , kiểu file)

 // 	"pdf" => "application/pdf",
  //   "csv" => "application/csv",
  //   "txt" => "text/plain",
  //   "html" => "text/html",
  //   "htm" => "text/html",
  //   "exe" => "application/octet-stream",
  //   "zip" => "application/zip",
  //   "doc" => "application/msword",
  //   "xls" => "application/vnd.ms-excel",
  //   "ppt" => "application/vnd.ms-powerpoint",
  //   "gif" => "image/gif",
  //   "png" => "image/png",
  //   "jpeg"=> "image/jpg",
  //   "jpg" =>  "image/jpg",
  //   "php" => "text/plain"

  $file_name= getGET('file_name');

  if (!empty($_GET)) {
   
      set_time_limit(0); 
      output_file("uploads/".$file_name, $file_name, "image/jpg");
  }
