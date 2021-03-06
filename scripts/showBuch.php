<?php
require '../com/connect.php';
$autor_id = $_REQUEST['autor_id'];
$select_query = "SELECT * FROM autors WHERE autor_id=" . $autor_id;
$result = mysqli_query($mysqli, $select_query);
if ($result) {
    $row = $result->fetch_array();
    $autor = $row['autor'];
    $title = $row['title'];
    $inhalt = preg_replace('/(?![^<]*?>)\"([^\"]+)\"/', '&laquo;$1&raquo;', $row['inhalt']);
//    $inhalt = $row['inhalt'];
    $desc_text = preg_replace('/\"([^\"]+)\"/', '&laquo;$1&raquo;', $row['description']);
    $description = preg_replace("/[\r\n]+/", "</p><p>", $desc_text);
    $schrank_num = $row['schrank_num'];
    $regal_num = $row['regal_num'];
    $druck = preg_replace('/\"([^\"]+)\"/', '&laquo;$1&raquo;', $row['druck']);
    $notes = $row['notes'];
    $cover = $row['cover'];
    $image_query = "SELECT * FROM images WHERE image_id=" . $cover;
    $image_result = mysqli_query($mysqli, $image_query);
} else {
    handle_error("возникла проблема с поиском вашей информации на нашей системе.", "Ошибка обнаружения пользователя с ID {$autor_id}");
}
?>
<html>
<head>
    <meta charset="UTF-8">
    <link href="../css/reset.css" rel="stylesheet"/>
    <link href="../css/style.css" rel="stylesheet"/>
    <title><?php echo "{$title}"; ?> &diams; Библиотека</title>
    <link rel="icon" href="../favicon.ico" type="image/x-icon">
    <link rel="shortcut icon" href="../favicon.ico" type="image/x-icon">
</head>
<body>
<div id="headerMain">
    <div id="header"><h1>Библиотека</h1></div>
</div>
<div id="content">
    <div class="buch">
        <div id="buchDataMain">
            <div id="buchData">
                <h2><?php echo "{$title}"; ?></h2>
                <h3><?php echo "{$autor}"; ?></h3>
                <!--        <h3>--><?php //echo "{$first_name} {$second_name} {$last_name}"; ?><!--</h3>-->
            </div>
        </div>
        <div class="cover">
            <img src="showImage.php?image_id=<?php echo $cover; ?>" class="cover_pic"/>
            <div class="description"><?php echo $description; ?></div>
        </div>
        <div class="druck"><?php echo "{$druck}" ?></div>
        <div class="notes"><?php echo "{$notes}" ?></div>
        <div class="inhalt">
            <?php
            if ($inhalt) echo "<h3>Содержание:</h3>";
            $pieces = preg_split("/[\r\n]+/", $inhalt);
            foreach ($pieces as $elements) {
                $element = explode("...", $elements);
                echo "
                <table>
                    <tr>
                        <td>{$element[0]}</td>
                        <td>{$element[1]}</td>
                    </tr>
                </table>
                ";
            }
            ?>
        </div>
        <div id="localMain">
            <div id="local">
                <div class="local">
                    <?php
                    if ($schrank_num) echo "Шкаф {$schrank_num},";
                    ?>
                    полка <?php echo $regal_num; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="footer">
    <div class="buttons">
        <a class="but leftb" href="../seite/addBuch.html">К добавлению</a>
        <a class="but centerb" href="changeBuch.php?autor_id=<?php echo $autor_id ?>">Изменить</a>
        <a class="but rightb" href="../index.php">В начало</a>
    </div>
    <div id="copy" class="foot">&copy; Igris</div>
</div>
<script src="../js/jquery-1.12.4.js"></script>
<script>
    elementBuchData = $('#buchData');
    elementBuchDataMain = $('#buchDataMain');
    buchDataHeight = elementBuchData.css('height');
    //    coverTop = elementCover.css('top');
    elementBuchDataMain.css('height', function (i, val) {
        if (buchDataHeight > '45') {
            return buchDataHeight;
        } else {
            return val;
        }
    });
</script>
<script>
    autor_id = '<?php echo $autor_id ?>';
    if (autor_id == '504' || autor_id == '50' || autor_id == '327' || autor_id == '525' || autor_id == '689' || autor_id == '754' || autor_id == '755' || autor_id == '756' || autor_id == '1011') {
        $('.inhalt td').addClass('oldFont');
    }
    //    if (autor_id == '512' || autor_id == '513') {
    //        $('.inhalt td:nth-child(1)').addClass('kihot');
    //    }
    if (autor_id == '1137'){
        $('.inhalt td').addClass('timesFont');
    }
    if (autor_id == '601') {
        $('.inhalt td:nth-child(2)').addClass('kareninaR');
        $('.inhalt td:nth-child(1) center').addClass('kareninaC');
    }
    if (autor_id == '859' || autor_id == '860' || autor_id == '875' || autor_id == '905') {
        $('.inhalt td:nth-child(1)').addClass('ohne_indent_b');
    }
    if (autor_id == '1203' || autor_id == '1204'){
        $('.description').addClass('oldFont');
        $('.druck').addClass('oldFont');
        $('.inhalt td').addClass('oldFont');
    }
</script>
</body>
</html>