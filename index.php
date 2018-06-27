<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="css/reset.css" rel="stylesheet"/>
    <link rel="stylesheet" href="css/jquery-ui.css">
    <link href="css/style.css" rel="stylesheet"/>
    <title>Библиотека</title>
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
</head>
<body>
<div id="headerMain">
    <div id="header"><h1>Библиотека</h1></div>
</div>
<!--<div id="content">-->
<div class="autors">
    <table id="sort">
        <tr>
            <td>
                <span id="sortLup" class="sortClick" title="По убыванию">▲</span>
                <span id="sortLdown" class="sortClick" title="По умолчанию">▼</span>
            </td>
            <td>
                <span id="sortRup" class="sortClick" title="По убыванию">▲</span>
                <span id="sortRdown" class="sortClick" title="По возрастанию">▼</span>
            </td>
        </tr>
    </table>
    <div id="buch_list" class="autors">
        <?php
        require 'com/connect.php';
        $sql = 'SELECT * FROM autors';
        if ($_GET['sort'] == 'autor_desc') {
            $sql .= ' ORDER BY autor DESC';
        } elseif ($_GET['sort'] == 'title') {
            $sql .= ' ORDER BY IF (title REGEXP "^(«).+", SUBSTRING(title, 2), title)';
//            $sql .= ' ORDER BY title';
        } elseif ($_GET['sort'] == 'title_desc') {
            $sql .= ' ORDER BY IF (title REGEXP "^(«).+", SUBSTRING(title, 2), title) DESC';
//            $sql .= ' ORDER BY title DESC';
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
            $cover = $row['cover'];
            $image_query = "SELECT * FROM images WHERE image_id=" . $cover;
            $image_result = mysqli_query($mysqli, $image_query);
            echo "
                <table>
                    <tr>                        
                        <td>
                            <a class='{$autor_id}' href='scripts/showBuch.php?autor_id={$autor_id}' title='{$title}'>
                                {$autor}
                            </a>
                        </td>
                        <td>
                            <a class='{$autor_id}' href='scripts/showBuch.php?autor_id={$autor_id}' title='{$autor}'>
                                {$title}
                            </a>
                        </td>                        
                    </tr>
                </table>
            ";
        }
        ?>
    </div>
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
<script src="js/jquery-1.12.4.js"></script>
<script src="js/jquery-ui.js"></script>
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
<script>
    $(document).ready(function () {
//        $.get('../scripts/indexBuch.php', {id: 1}, function (data) {
//            $('#buch_list').html(data);
//        });
//        $('.sortClick').click(function () {
//            $(this).text($(this).text() == '▼' ? '▲' : '▼');
//        });
//        $('#sortL').click(function () {
//            $(location).attr('href', $('.sortClick').text() == '▼' ? '?sort=autor_desc' : '?sort=autor');
//        })
        $('#sortLup').click(function () {
            $(location).attr('href', 'index.php?sort=autor_desc');
        });
        $('#sortLdown').click(function () {
            $(location).attr('href', 'index.php');
        });
        $('#sortRup').click(function () {
            $(location).attr('href', 'index.php?sort=title_desc');
        });
        $('#sortRdown').click(function () {
            $(location).attr('href', 'index.php?sort=title');
        });
    });
</script>
<script>
    $('.autors td a').tooltip({
        track: true,
        show: {
            effect: "slideDown",
            delay: 800
        },
        hide: {
            effect: "fade",
            delay: 50
        },
//        content: function () {
//            var element = $(this);
//            if (element.className == <?php //echo $autor_id ?>//) {
//                var imaga = '<?php
//                    $img = 'SELECT cover FROM autors WHERE autor_id';
//                    return $img;
//                    ?>//';
//                return '<img src="scripts/showImage.php?image_id=' + imaga + '>"';
//            }
//        }
    });
</script>
</html>