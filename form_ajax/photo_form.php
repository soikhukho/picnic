<?php
  require_once '../db/dbhelper.php';
  require_once '../utility/utils.php';

  $game_id = getPost('game_id');
  
  if ($game_id != '') {
  	
  	$sql=" select albums.* from albums,games where albums.game_id = games.id and games.id = '$game_id' ";

  	$albums_list = executeResult($sql);

  	foreach ($albums_list as $album) {
  		echo '<option value="'.$album['id'].'">'.$album['title'].'</option>';
  	}

  }

  if ($game_id =='') {
  	$albums=executeResult("select id , title from albums ");

  	foreach ($albums as $album) {
  		echo '<option value="'.$album['id'].'">'.$album['title'].'</option>';
  	}
  }