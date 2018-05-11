<?php
require '../com/connect.php';
$result = $mysqli->query('SELECT * FROM autors ORDER BY autor');
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
                    <a href='showBuch.php?autor_id={$autor_id}'>
                        {$autor}
                    </a>
                </td>
                <td>
                    <a href='showBuch.php?autor_id={$autor_id}'>
                        {$title}
                    </a>
                </td>                        
            </tr>
        </table>
    ";
}