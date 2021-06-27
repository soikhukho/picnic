<?php
include_once '../db/dbhelper.php';
include_once '../utility/utils.php';
include_once '../utility/utils_file.php';

$page_code = getPost('page_code');

$comments = executeResult("select count(*) 'total' from comments where page_code= '$page_code' ",true);

echo $comments['total'].' Bình luận';