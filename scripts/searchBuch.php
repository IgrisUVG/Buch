<?php
require '../com/connect.php';
$mysqli->query("SET NAMES 'utf8'") or die ("Ошибка соединения с базой!");

if (!empty($_POST["referal"])) {

    $referal = trim(strip_tags(stripcslashes(htmlspecialchars($_POST["referal"]))));

    $db_referal = $mysqli->query("SELECT * FROM autors WHERE autor LIKE '%$referal%' OR title LIKE '%$referal%' OR description LIKE '%$referal%' OR inhalt LIKE '%$referal%'")
    or die('Ошибка №' . __LINE__ . '<br>Обратитесь к администратору сайта пожалуйста, сообщив номер ошибки.');

    while ($row = $db_referal->fetch_array()) {
        echo "\n<li><table><tr><td><a href='../scripts/showBuch.php?autor_id=" . $row["autor_id"] . "' title='" . $row["title"] . "'>" . $row["autor"] . "</a></td><td><a href='../scripts/showBuch.php?autor_id=" . $row["autor_id"] . "' title='" . $row["autor"] . "'>" . $row["title"] . "</a></td><td>Шкаф " . $row["schrank_num"] . ", полка " . $row["regal_num"] . "</td></tr></table></li>";
    }

}

if (!empty($_POST["schrank_num"])) {

    $schrank_num = trim(strip_tags(stripcslashes(htmlspecialchars($_POST["schrank_num"]))));

    $db_schrank_num = $mysqli->query("SELECT * FROM autors WHERE schrank_num LIKE '%$schrank_num%'")
    or die('Ошибка №' . __LINE__ . '<br>Обратитесь к администратору сайта пожалуйста, сообщив номер ошибки.');

    while ($row = $db_schrank_num->fetch_array()) {
        echo "\n<li><table><tr><td><a href='../scripts/showBuch.php?autor_id=" . $row["autor_id"] . "' title='" . $row["title"] . "'>" . $row["autor"] . "</a></td><td><a href='../scripts/showBuch.php?autor_id=" . $row["autor_id"] . "' title='" . $row["autor"] . "'>" . $row["title"] . "</a></td><td>Шкаф " . $row["schrank_num"] . ", полка " . $row["regal_num"] . "</td></tr></table></li>";
    }
//    if (!empty($_POST["regal_num"])) {
//
//        $regal_num = trim(strip_tags(stripcslashes(htmlspecialchars($_POST["regal_num"]))));
////        $temp_schrank = "CREATE TEMPORARY TABLE temp_schrank SELECT * FROM autors WHERE schrank_num LIKE '%$schrank_num%'";
//
////        if (mysqli_query($mysqli, $temp_schrank)) {
//        $db_regal_num = $mysqli->query("
//                                         CREATE TEMPORARY TABLE temp_schrank
//                                         SELECT * FROM autors WHERE schrank_num LIKE '%$schrank_num%';
//                                         SELECT * FROM temp_schrank WHERE regal_num LIKE '%$regal_num%'
//                                        ")
//        or die('Ошибка №' . __LINE__ . '<br>Обратитесь к администратору сайта пожалуйста, сообщив номер ошибки.');
//
//        while ($row = $db_regal_num->fetch_array()) {
//            echo "\n<li><table><tr><td><a href='../scripts/showBuch.php?autor_id=" . $row["autor_id"] . "' title='" . $row["title"] . "'>" . $row["autor"] . "</a></td><td><a href='../scripts/showBuch.php?autor_id=" . $row["autor_id"] . "' title='" . $row["autor"] . "'>" . $row["title"] . "</a></td><td>Шкаф " . $row["schrank_num"] . ", полка " . $row["regal_num"] . "</td></tr></table></li>";
//        }
//    }
//    }

}

if (!empty($_POST["regal_num"])) {

    $regal_num = trim(strip_tags(stripcslashes(htmlspecialchars($_POST["regal_num"]))));

    $db_regal_num = $mysqli->query("SELECT * FROM autors WHERE regal_num LIKE '%$regal_num%'")
    or die('Ошибка №' . __LINE__ . '<br>Обратитесь к администратору сайта пожалуйста, сообщив номер ошибки.');

    while ($row = $db_regal_num->fetch_array()) {
        echo "\n<li><table><tr><td><a href='../scripts/showBuch.php?autor_id=" . $row["autor_id"] . "' title='" . $row["title"] . "'>" . $row["autor"] . "</a></td><td><a href='../scripts/showBuch.php?autor_id=" . $row["autor_id"] . "' title='" . $row["autor"] . "'>" . $row["title"] . "</a></td><td>Шкаф " . $row["schrank_num"] . ", полка " . $row["regal_num"] . "</td></tr></table></li>";
    }
}