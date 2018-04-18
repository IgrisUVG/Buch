<?php
require '../com/connect.php';

//$upload_dir = SITE_ROOT . 'covers';
//$image_fieldname = 'cover_pic';

$first_name = trim($_REQUEST['first_name']);
$second_name = trim($_REQUEST['second_name']);
$last_name = trim($_REQUEST['last_name']);
$title = trim($_REQUEST['title']);
$inhalt = trim($_REQUEST['inhalt']);
$description = trim($_REQUEST['description']);
$schrank_num = trim($_REQUEST['schrank_num']);
$regal_num = trim($_REQUEST['regal_num']);

//@move_uploaded_file($_FILES[$image_fieldname]['tmp_name'], $upload_filename)
//    or die("возникла проблема сохранения вашего изображения в его постоянном месте. Ошибка, связанная с правами доступа при перемещении файла в {$upload_filename}");

$insert_sql = "
  INSERT INTO autors (
      first_name, 
      second_name, 
      last_name,
      title, 
      inhalt, 
      description, 
      schrank_num, 
      regal_num
      ) 
  VALUES (
      '{$first_name}', 
      '{$second_name}', 
      '{$last_name}', 
      '{$title}', 
      '{$inhalt}', 
      '{$description}', 
      '{$schrank_num}', 
      '{$regal_num}'
      );
";
mysqli_query($mysqli, $insert_sql) or die(mysqli_error($mysqli));
header("Location: showBuch.php?user_id=" . mysqli_insert_id($mysqli));
exit();
