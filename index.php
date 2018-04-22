<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="css/reset.css" rel="stylesheet"/>
    <link href="css/style.css" rel="stylesheet"/>
    <title>Библиотека</title>
</head>
<body>
<div id="header"><h1>Библиотека</h1></div>
<div id="content">
    <div class="autors">
        <?php
            require 'com/connect.php';
            $result = $mysqli->query('SELECT * FROM autors ORDER BY last_name');
            while ($row = $result->fetch_assoc()) {
                $autor_id = $row['autor_id'];
                $first_name = $row['first_name'];
                $second_name = $row['second_name'];
                $last_name = $row['last_name'];
                $title = $row['title'];
                echo "
                <table>
                    <tr>
                        <td>
                            {$last_name} {$first_name} {$second_name}
                        </td>
                        <!--td>Другой вариант</td-->
                        <td>
                            <a href='scripts/showBuch.php?autor_id={$autor_id}'>
                                {$title}
                            </a>
                        </td>
                    </tr>
                </table>
            ";
            }
        ?>
    </div>
</div>
<div id="footer">
    <div class="button">
        <!--button onclick="window.location.href='seite/addBuch.html'">Добавить</button-->
        <a class="but" href="seite/addBuch.html">Добавить</a>
    </div>

</div>
</body>
</html>