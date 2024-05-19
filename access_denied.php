<!DOCTYPE html>
<html>
<head>
    <title>Доступ запрещен</title>
</head>
<body >
    <center>
        <h1>Доступ запрещен</h1>
        <p>К сожалению, у вас нет прав для доступа к запрошенной странице.</p>
        <p>Пожалуйста, свяжитесь с администратором для получения доступа.</p>
        <p>Через 10 секунд вы будете перенаправлены на предыдущую страницу</p>
    </center>
</body>
</html>

<?php
session_start();

print_r($_SESSION);

$prev_file = $_SESSION['prev_file'];    

unset($_SESSION['prev_file']);

header("Refresh: 10; url=".$prev_file);

?>