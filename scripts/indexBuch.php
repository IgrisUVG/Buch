<?php
require '../com/connect.php';
$sql = 'SELECT * FROM autors';
if ($_GET['sort'] == 'autor_desc') {
    $sql .= ' ORDER BY autor DESC';
} elseif ($_GET['sort'] == 'title') {
    $sql .= ' ORDER BY title';
} elseif ($_GET['sort'] == 'title_desc') {
    $sql .= ' ORDER BY title DESC';
} else {
    $sql .= ' ORDER BY autor';
}
//$result = $mysqli->query('SELECT * FROM autors ORDER BY autor');
$result = $mysqli->query($sql);
while ($row = $result->fetch_assoc()) {
    $autor_id = $row['autor_id'];
    $autor = $row['autor'];
    $first_name = $row['first_name'];
    $second_name = $row['second_name'];
    $last_name = $row['last_name'];
    $title = $row['title'];
//            $schrank_num = $row['schrank_num'];
//            $regal_num = $row['regal_num'];
    echo "
        <table>
            <tr>                        
                <td>
                    <a href='scripts/showBuch.php?autor_id={$autor_id}'>
                        {$autor}
                    </a>
                </td>
                <td>
                    <a href='scripts/showBuch.php?autor_id={$autor_id}'>
                        {$title}
                    </a>
                </td>                        
            </tr>
        </table>
    ";
}