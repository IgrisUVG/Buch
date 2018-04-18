<?php
require '../com/connect.php';
$user_id = $_REQUEST['user_id'];
$select_query = "SELECT * FROM users WHERE user_id=" . $user_id;
$result = mysqli_query($mysqli, $select_query);
if ($result) {
    $row = $result->fetch_array();
    $first_name = $row['first_name'];
    $second_name = $row['second_name'];
    $last_name = $row['last_name'];
    $title = $row['title'];
    $inhalt = $row['inhalt'];
    $description = preg_replace("/[\r\n]+/", "</p><p>", $row['description']);
    $shcrank_num = $row['shcrank_num'];
    $regal_num = $row['regal_num'];
    $cover = $row['cover'];
} else {
    die("Ошибка обнаружения пользователя с ID {$user_id}");
}