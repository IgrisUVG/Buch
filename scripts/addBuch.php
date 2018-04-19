<?php
require '../com/connect.php';

$upload_dir = SITE_ROOT . 'covers/';
$image_fieldname = 'cover';

// Потенциальные PHP-ошибки отправки файлов
$php_errors = array(1 => 'Превышен макс. размер файла, указанный в php.ini',
    2 => 'Превышен макс. размер файла, указанный в форме HTML',
    3 => 'Была отправлена только часть файла',
    4 => 'Файл для отправки не был выбран.');

$first_name = trim($_REQUEST['first_name']);
$second_name = trim($_REQUEST['second_name']);
$last_name = trim($_REQUEST['last_name']);
$title = trim($_REQUEST['title']);
$inhalt = trim($_REQUEST['inhalt']);
$description = trim($_REQUEST['description']);
$schrank_num = trim($_REQUEST['schrank_num']);
$regal_num = trim($_REQUEST['regal_num']);

// Проверка отсутствия ошибки при отправке изображения
($_FILES[$image_fieldname]['error'] == 0)
or handle_error("сервер не может получить выбранное вами изображение.",
    $php_errors[$_FILES[$image_fieldname]['error']]);

// Убеждаемся, что при отправке изображения не произошла ошибка
// Является ли этот файл результатом нормальной отправки?
@is_uploaded_file($_FILES[$image_fieldname]['tmp_name'])
or handle_error("вы попытались совершить безнравственный поступок. Позор!", "Запрос на отправку: файл назывался '{$_FILES[$image_fieldname]['tmp_name']}'");

// Действительно ли это изображение?
@getimagesize($_FILES[$image_fieldname]['tmp_name'])
or handle_error("вы выбрали файл для своего фото, который не является изображением.","{$_FILES[$image_fieldname]['tmp_name']} не является файлом изображения.");

// Присваивание файлу уникального имени
$now = time();
while (file_exists($upload_filename = $upload_dir . $now . '-' .  $_FILES[$image_fieldname]['name'])) {
    $now++;
}
@move_uploaded_file($_FILES[$image_fieldname]['tmp_name'], $upload_filename)
    or handle_error("возникла проблема сохранения вашего изображения в его постоянном месте.", "Ошибка, связанная с правами доступа при перемещении файла в {$upload_filename}");

$insert_sql = "
  INSERT INTO autors (
      first_name, 
      second_name, 
      last_name,
      title, 
      inhalt, 
      description, 
      schrank_num, 
      regal_num,
      cover
      ) 
  VALUES (
      '{$first_name}', 
      '{$second_name}', 
      '{$last_name}', 
      '{$title}', 
      '{$inhalt}', 
      '{$description}', 
      '{$schrank_num}', 
      '{$regal_num}',
      '{$upload_filename}'
      );
";
mysqli_query($mysqli, $insert_sql) or die(mysqli_error($mysqli));

header("Location: showBuch.php?autor_id=" . mysqli_insert_id($mysqli));
exit();
