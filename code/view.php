<!DOCTYPE html>
<html lang="ru">
<head>
    <title>��� ������</title>
</head>
<body>
    <h2>��� ���������� ������:</h2>
    <ul>
        <?php
        if(file_exists("data.txt")){
            $lines = file("data.txt", FILE_IGNORE_NEW_LINES);
            foreach($lines as $line){
                list($name, $email) = explode(";", $line);
                echo "<li>$name ($email)</li>";
            }
        } else {
            echo "<li>������ ���</li>";
        }
        ?>
    </ul>
    <a href="index.php">�� �������</a>
</body>
</html>
