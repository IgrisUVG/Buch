<?php
require '../com/connect.php';
$mysqli -> query("SET NAMES 'utf8'") or die ("Ошибка соединения с базой!");

if(!empty($_POST["referal"])){ //Принимаем данные

    $referal = trim(strip_tags(stripcslashes(htmlspecialchars($_POST["referal"]))));

    $db_referal = $mysqli -> query("SELECT * FROM autors WHERE autor LIKE '%$referal%'")
    or die('Ошибка №'.__LINE__.'<br>Обратитесь к администратору сайта пожалуйста, сообщив номер ошибки.');

    while ($row = $db_referal -> fetch_array()) {
        echo "\n<li><table><tr><td>".$row["autor"]."</td><td>".$row["title"]."</td><td>Шкаф ".$row["schrank_num"].", полка ".$row["regal_num"]."</td></tr></table></li>"; //$row["name"] - имя таблицы
    }

}