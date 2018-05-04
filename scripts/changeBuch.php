<?php
require '../com/connect.php';
$autor_id = $_REQUEST['autor_id'];
$select_query = "SELECT * FROM autors WHERE autor_id=" . $autor_id;
$result = mysqli_query($mysqli, $select_query);
if ($result) {
    $row = $result->fetch_array();
    $autor_id = $row['autor_id'];
    $autor = $row['autor'];
    $first_name = $row['first_name'];
    $second_name = $row['second_name'];
    $last_name = $row['last_name'];
    $title = $row['title'];
    $inhalt = $row['inhalt'];
    $description = preg_replace("/[\r\n]+/", "</p><p>", $row['description']);
    $schrank_num = $row['schrank_num'];
    $regal_num = $row['regal_num'];
    $druck = $row['druck'];
    $notes = $row['notes'];
//    $image_query = "SELECT * FROM images WHERE image_id=" . $cover;
//    $image_result = mysqli_query($mysqli, $image_query);
} else {
    handle_error("возникла проблема с поиском вашей информации на нашей системе.", "Ошибка обнаружения пользователя с ID {$autor_id}");
}
if (
    isset($_POST['autor_id']) &&
    isset($_POST['autor']) &&
    isset($_POST['title']) &&
    isset($_POST['inhalt']) &&
    isset($_POST['druck']) &&
    isset($_POST['description']) &&
    isset($_POST['notes']) &&
    isset($_POST['schrank_num']) &&
    isset($_POST['regal_num'])
//        $autor_id=$_POST['autor_id'] &&
//        $autor=$_POST['autor'] &&
//        $title=$_POST['title'] &&
//        $inhalt=$_POST['inhalt'] &&
//        $druck=$_POST['druck'] &&
//        $description=$_POST['description'] &&
//        $notes=$_POST['notes'] &&
//        $schrank_num=$_POST['schrank_num'] &&
//        $regal_num=$_POST['regal_num']
) {
//    $autor = htmlentities(mysqli_real_escape_string($mysqli, $_POST['autor']));
    $query = "UPDATE autors SET
              autor_id=$autor_id,
              autor=$autor,
              title=$title,
              inhalt=$inhalt,
              druck=$druck,
              description=$description,
              notes=$notes,
              schrank_num=$schrank_num,
              regal_num=$regal_num
              WHERE autor_id=$autor_id
             ";

    $res = mysqli_query($mysqli, $query) or die("Ошибка " . mysqli_error($mysqli));

    if ($res) {
        header("Location: showBuch.php?autor_id=" . $autor_id);
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link href="../css/reset.css" rel="stylesheet"/>
    <link href="../css/style.css" rel="stylesheet"/>
    <title>Библиотека</title>
</head>
<body>
<div id="headerMain">
    <div id="header"><h1>Библиотека</h1></div>
</div>
<div id="content">
    <form name="form" onsubmit="return validateForm()" action="" method="POST" enctype="multipart/form-data">
        <fieldset>
            <label for="autor">Автор:</label>
            <input type="text" id="autor" name="autor" size="41" value="<?php echo $autor ?>"/><br/>
            <label for="title">Название:</label>
            <input type="text" id="title" name="title" size="41" value="<?php echo $title ?>"/><br/>
            <label for="inhalt">Содержание:</label>
            <textarea id="inhalt" name="inhalt" cols="40" rows="8"><?php echo $inhalt ?></textarea><br/>
            <label for="druck">Издательство:</label>
            <input type="text" id="druck" name="druck" size="41" value="<?php echo $druck ?>"/><br/>
            <label for="description">Описание:</label>
            <textarea id="description" name="description" cols="40" rows="8"><?php echo $description ?></textarea><br/>
            <label for="notes">Для заметок:</label>
            <input type="text" id="notes" name="notes" size="41" value="<?php echo $notes ?>"/><br/>
            <!--Добавление картинки-->
            <!--            <input type="hidden" name="MAX_FILE_SIZE" value="2000000"/>-->
            <!--            <label for="cover">Обложка:</label>-->
            <!--            <!--<div class="file_upload">-->
            <!--                <!--<button class="but" type="button">Выберите файл</button>-->
            <!--                <!--<div>Файл не выбран</div>-->
            <!--                <!--<input type="file" id="cover" name="cover" size="30"/>-->
            <!--            <!--</div>-->
            <!--            <input type="file" id="cover" name="cover" size="30"/><br/>-->
            <!--|-->
            <label for="schrank_num">Шкаф:</label>
            <input type="text" id="schrank_num" name="schrank_num" size="10" value="<?php echo $schrank_num ?>"/><br/>
            <label for="regal_num">Полка:</label>
            <input type="text" id="regal_num" name="regal_num" size="10" value="<?php echo $regal_num ?>"/><br/>
        </fieldset>
        <br/>
        <fieldset class="center">
            <input class="but" id="submit" type="submit" value="Изменить"/>
        </fieldset>
    </form>
</div>
<div id="footer">
    <div class="buttons">
        <a class="but" href="../index.php">В начало</a>
    </div>
    <div id="copy">&copy; Igris</div>
</div>
<script src="../js/jquery.js"></script>
<script src="../js/validateForm.js"></script>
<!--<script src="../js/file_upload_style.js"></script>-->
</body>
</html>