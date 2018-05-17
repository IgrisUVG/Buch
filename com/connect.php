<?php
require_once 'config.php';
$mysqli = mysqli_connect(DATABASE_HOST, DATABASE_USERNAME, DATABASE_PASSWORD, DATABASE_NAME);
//Опытное добавление
mysqli_query($mysqli, "SET NAMES 'utf8'");
mysqli_query($mysqli, "SET character_set_client='utf8'");
mysqli_query($mysqli, "SET character_set_results='");
mysqli_query($mysqli, "SET character_set_system='utf8'");
mysqli_query($mysqli, "SET CHARACTER SET 'utf8'");
//
$mysqli->set_charset("utf8");
mysqli_query($mysqli, "SET SESSION sql_mode = ''");
if ($mysqli->connect_errno) {
    echo "Не удалось подключиться к MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}
$res = mysqli_query($mysqli, "SELECT 'Вы подключились к MySQL!' AS _msg FROM DUAL");
$row = mysqli_fetch_assoc($res);
//echo $row['_msg'];
//echo "<p>Вы подключены к MySQL с использованием базы данных " . DATABASE_NAME . ".</p>";
