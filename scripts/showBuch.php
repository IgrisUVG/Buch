<?php
require '../com/connect.php';
$autor_id = $_REQUEST['autor_id'];
$select_query = "SELECT * FROM autors WHERE autor_id=" . $autor_id;
$result = mysqli_query($mysqli, $select_query);
if ($result) {
    $row = $result->fetch_array();
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
    <title><?php echo "{$title}"; ?> || Библиотека</title>
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
            <!--            <div>--><?php //echo $inhalt; ?><!--</div>-->
        </div>
    </div>
</div>
<div id="localMain">
    <div class="local">
        <?php
        if ($schrank_num) echo "Шкаф {$schrank_num},";
        ?>
        полка <?php echo $regal_num; ?>
    </div>
</div>
<div id="footer">
    <div class="buttons">
        <a class="but leftb" href="../seite/addBuch.html">К добавлению</a>
        <a class="but rightb" href="../index.php">В начало</a>
    </div>
    <div id="copy">&copy; Igris</div>
</div>
</body>
</html>