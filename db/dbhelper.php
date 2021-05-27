<?php
require_once 'config.php';

function createDB($sql){
	$conn = mysqli_connect(HOST , USER , PASSWORD);
	mysqli_set_charset($conn, 'utf8');

	mysqli_query($conn,$sql);
	mysqli_close($conn);
}

function execute($sql){
	$conn = mysqli_connect(HOST , USER , PASSWORD , DATABASE);
	mysqli_set_charset($conn, 'utf8');

	mysqli_query($conn,$sql);
	mysqli_close($conn);
}

function executeResult($sql , $isOnlyOne = false){
	$conn = mysqli_connect(HOST , USER , PASSWORD , DATABASE);
	mysqli_set_charset($conn, 'utf8');

	$resultset=mysqli_query($conn,$sql);

	if ($resultset == null) {
		echo 'xem lai cau truy van: '.$sql;
	}else{

		if ($isOnlyOne) {
			$data= mysqli_fetch_array($resultset,1);
		}
		else{
				$data = [];
				while ( ($row = mysqli_fetch_array($resultset,1)) != null ) {
					$data[]	=$row;
				}
		}
		mysqli_close($conn);
		return $data;

	}
}