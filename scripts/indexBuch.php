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
    $title = $row['title'];
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