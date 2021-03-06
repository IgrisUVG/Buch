<!DOCTYPE html>
<?php
require '../com/connect.php';
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
) {
    $autor_id = mysqli_real_escape_string($mysqli, $_POST['autor_id']);
    $autor = mysqli_real_escape_string($mysqli, $_POST['autor']);
    $title = mysqli_real_escape_string($mysqli, $_POST['title']);
    $inhalt = mysqli_real_escape_string($mysqli, $_POST['inhalt']);
    $druck = mysqli_real_escape_string($mysqli, $_POST['druck']);
    $description = mysqli_real_escape_string($mysqli, $_POST['description']);
    $notes = mysqli_real_escape_string($mysqli, $_POST['notes']);
    $schrank_num = mysqli_real_escape_string($mysqli, $_POST['schrank_num']);
    $regal_num = mysqli_real_escape_string($mysqli, $_POST['regal_num']);


    $query = "UPDATE autors SET
              autor='$autor',
              title='$title',
              inhalt='$inhalt',
              druck='$druck',
              description='$description',
              notes='$notes',
              schrank_num='$schrank_num',
              regal_num='$regal_num'
              WHERE autor_id='$autor_id'
             ";

    $result = mysqli_query($mysqli, $query) or die("Ошибка " . mysqli_error($mysqli));

    if ($result) {
        header("Location: showBuch.php?autor_id=" . $autor_id);
    }
}
?>
<?php
if (isset($_GET['autor_id'])) {
    $autor_id = htmlentities(mysqli_real_escape_string($mysqli, $_GET['autor_id']));

    $query = "SELECT * FROM autors WHERE autor_id='$autor_id'";

    $result = mysqli_query($mysqli, $query) or die("Ошибка " . mysqli_error($mysqli));

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_row($result);
        $autor_id = $row[0];
        $autor = $row[1];
        $title = $row[2];
        $inhalt = $row[3];
        $description = preg_replace("/[\r\n]+/", "</p><p>", $row[4]);
        $schrank_num = $row[6];
        $regal_num = $row[7];
        $druck = $row[8];
        $notes = $row[9];

        echo "
            <html>
            <head>
                <meta charset=\"UTF-8\">
                <link href=\"../css/reset.css\" rel=\"stylesheet\"/>
                <link href=\"../css/style.css\" rel=\"stylesheet\"/>
                <title>{$title} &diams; Библиотека</title>
                <link rel='icon' href='../favicon.ico' type='image/x-icon'>
                <link rel='shortcut icon' href='../favicon.ico' type='image/x-icon'>
            </head>
            <body>
            <div id='headerMain'>
                <div id='header'><h1>Библиотека</h1></div>
            </div>
            <div id='content'>
                <form action='' name='form' onsubmit='return validateForm()' method='POST'>
                    <fieldset>
                        <input type='hidden' name='autor_id'  value='$autor_id'>
                        <label for='autor'>Автор:</label>
                        <input type='text' id='autor' name='autor' size='41' value='$autor'/><br/>
                        <label for='title'>Название:</label>
                        <input type='text' id='title' name='title' size='41' value='$title'/><br/>
                        <label for='inhalt'>Содержание:</label>
                        <textarea id='inhalt' name='inhalt' cols='40' rows='8'>$inhalt</textarea><br/>
                        <label for='druck'>Издательство:</label>
                        <input type='text' id='druck' name='druck' size='41' value='$druck'/><br/>
                        <label for='description'>Описание:</label>
                        <textarea id='description' name='description' cols='40' rows='8'>$description</textarea><br/>
                        <label for='notes'>Для заметок:</label>
                        <input type='text' id='notes' name='notes' size='41' value='$notes'/><br/>
                        <label for='schrank_num'>Шкаф:</label>
                        <input type='text' id='schrank_num' name='schrank_num' size='10' value='$schrank_num'/><br/>
                        <label for='regal_num'>Полка:</label>
                        <input type='text' id='regal_num' name='regal_num' size='10' value='$regal_num'/><br/>
                    </fieldset>
                    <br/>
                    <fieldset class='center'>
                        <input class='but' id='submit' type='submit' value='Сохранить'/>
                    </fieldset>
                </form>
            </div>
            ";

        mysqli_free_result($result);
    }
}
mysqli_close($mysqli);
?>
<div id="footer">
    <div class="buttons">
        <a class="but" href="../index.php">В начало</a>
    </div>
    <div id="copy">&copy; Igris</div>
</div>
<script src="../js/jquery-1.12.4.js"></script>
<script src="../js/validateForm.js"></script>
<!--<script src="../js/file_upload_style.js"></script>-->
</body>
</html>