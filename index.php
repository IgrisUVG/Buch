<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="css/reset.css" rel="stylesheet"/>
    <link href="css/style.css" rel="stylesheet"/>
    <title>Библиотека</title>
</head>
<body>
<div id="headerMain">
    <div id="header"><h1>Библиотека</h1></div>
</div>
<!--<div id="content">-->
    <div class="autors">
        <?php
        require 'com/connect.php';
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
                            {$autor} {$last_name} {$first_name} {$second_name}
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
        ?>
        <div id="clear"></div>
    </div>
<!--</div>-->
<div id="footer" class="footer">
    <div class="buttons">
        <a class="but" href="seite/addBuch.html">Добавить</a>
    </div>
    <div id="copy">&copy; Igris</div>
</div>
</body>
<script src="js/jquery.js"></script>
<script>
    window.onload = function tableBG() {
        var rows = document.getElementsByTagName('tr');
        for (var i = 0; i < rows.length; i++) {

            if (i % 2 == 0) {
                rows.item(i).style.backgroundColor = "#fff"
            } else {
                rows.item(i).style.backgroundColor = "#E5F5FF"
            }

        }
    }
</script>
</html>