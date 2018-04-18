<?php
require '../com/connect.php';

$upload_dir = SITE_ROOT . 'covers';
$image_fieldname = 'cover_pic';

$first_name = trim($_REQUEST['first_name']);
$second_name = trim($_REQUEST['second_name']);
$last_name = trim($_REQUEST['last_name']);
$title = trim($_REQUEST['title']);
$inhalt = trim($_REQUEST['inhalt']);
$description = trim($_REQUEST['description']);
$shcrank_num = trim($_REQUEST['shcrank_num']);
$regal_num = trim($_REQUEST['regal_num']);
