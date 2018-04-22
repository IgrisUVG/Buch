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

//Изменение размера возможно
if (isset($_POST['submit']) ) {
    include('../com/classSimpleImage.php');
    $image = new SimpleImage();
    $image->load($_FILES['uploaded_image']['tmp_name']);
    $image->resizeToWidth(200);
    $image->output();
}
else {
    header('Location = ../seite/addBuch.html');
}

// Присваивание файлу уникального имени
$now = time();
while (file_exists($upload_filename = $upload_dir . $now . '-' .  $_FILES[$image_fieldname]['name'])) {
    $now++;
}

// Вставка изображения в таблицу images
$image = $_FILES[$image_fieldname];
$image_filename = $image['name'];
$image_info = getimagesize($image['tmp_name']);
$image_mime_type = $image_info['mime'];
$image_size = $image['size'];
$image_data = file_get_contents($image['tmp_name']);

$insert_image_sql = sprintf(
    "INSERT INTO images (
        filename,
        mime_type,
        file_size,
        image_data
    )
    VALUES (
        '%s',
        '%s',
        '%d',
        '%s'
    );",
    mysqli_real_escape_string($mysqli, $image_filename),
    mysqli_real_escape_string($mysqli, $image_mime_type),
    mysqli_real_escape_string($mysqli, $image_size),
    mysqli_real_escape_string($mysqli, $image_data)
);
mysqli_query($mysqli, $insert_image_sql);

$insert_sql = sprintf(
    "INSERT INTO autors (
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
        '%s', 
        '%s', 
        '%s', 
        '%s', 
        '%s', 
        '%s', 
        '%s', 
        '%s',
        '%d'
    );",
    mysqli_real_escape_string($mysqli, $first_name),
    mysqli_real_escape_string($mysqli, $second_name),
    mysqli_real_escape_string($mysqli, $last_name),
    mysqli_real_escape_string($mysqli, $title),
    mysqli_real_escape_string($mysqli, $inhalt),
    mysqli_real_escape_string($mysqli, $description),
    mysqli_real_escape_string($mysqli, $schrank_num),
    mysqli_real_escape_string($mysqli, $regal_num),
    mysqli_insert_id($mysqli)
);
mysqli_query($mysqli, $insert_sql) or die(mysqli_error($mysqli));

$autor_id = mysqli_insert_id($mysqli);

header("Location: showBuch.php?autor_id=" . mysqli_insert_id($mysqli));
exit();
