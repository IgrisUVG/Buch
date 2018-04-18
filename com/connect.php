<?php
require_once 'config.php';
$mysqli = mysqli_connect(DATABASE_HOST, DATABASE_USERNAME, DATABASE_PASSWORD, DATABASE_NAME);
if ($mysqli->connect_errno) {
    echo "Не удалось подключиться к MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}
$res = mysqli_query($mysqli, "SELECT 'Вы подключились к MySQL!' AS _msg FROM DUAL");
$row = mysqli_fetch_assoc($res);
echo $row['_msg'];
echo "<p>Вы подключены к MySQL с использованием базы данных " . DATABASE_NAME . ".</p>";
