<?php
require '../com/connect.php';
$autor_id = $_REQUEST['autor_id'];
$select_query = "SELECT * FROM autors WHERE autor_id=" . $autor_id;
$result = mysqli_query($mysqli, $select_query);
if ($result) {
    $row = $result->fetch_array();
    $first_name = $row['first_name'];
    $second_name = $row['second_name'];
    $last_name = $row['last_name'];
    $title = $row['title'];
    $inhalt = $row['inhalt'];
    $description = preg_replace("/[\r\n]+/", "</p><p>", $row['description']);
    $schrank_num = $row['schrank_num'];
    $regal_num = $row['regal_num'];
    $cover = get_web_path($row['cover']);
} else {
    handle_error("возникла проблема с поиском вашей информации на нашей системе.","Ошибка обнаружения пользователя с ID {$autor_id}");
}
?>
<html>
<head>
    <meta charset="UTF-8">
    <link href="../css/reset.css" rel="stylesheet"/>
    <link href="../css/style.css" rel="stylesheet"/>
    <title>Buch</title>
</head>
<body>
<div id="header"><h1>Библиотека</h1></div>
<div id="content">
    <div class="buch">
        <h2><?php echo "{$title}"; ?></h2>
        <h3><?php echo "{$first_name} {$second_name} {$last_name}"; ?></h3>
        <div class="cover">
            <img src="<?php echo $cover; ?>" class="cover_pic"/>
            <?php echo $description; ?>
        </div>
        <div class="inhalt">
            <h3>Содержание:</h3>
            <?php echo $inhalt; ?>
        </div>
        <div class="local">
            <p>Шкаф <?php echo $schrank_num; ?>, полка <?php echo $regal_num; ?></p>
        </div>
    </div>
    <button onclick="window.location.href='../seite/addBuch.html'">К добавлению</button>
    <button onclick="window.location.href='../index.html'">В начало</button>
</div>
<div id="footer"></div>
</body>
</html>