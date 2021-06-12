<?php
  require_once '../db/dbhelper.php';
  require_once '../utility/utils.php';

  $id= getPost('id');
  if ($id != '') {

  	showAlbum_slide($id);

  }