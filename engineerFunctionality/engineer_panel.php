<?php

session_start();

if (isset($_SESSION['current_file'])){

    $_SESSION['prev_file'] = $_SESSION['current_file'];

}else{
    $_SESSION['current_file'] = $_SERVER['SCRIPT_NAME'];
}

if (is_null($_SESSION['job']) or $_SESSION['job'] != 'engineer'){

    header("Location: ../access_denied.php");

}

require_once('../database.php');


$login = $_SESSION['username'];

$result = $connection->query("SELECT * FROM `engineer` WHERE `login` = '$login'");

$engineer_info = $result->fetch_assoc();

$id_engineer = $engineer_info['ID_Engineer'];

$_SESSION['ID_Engineer'] = $id_engineer;


?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Панель техника</title>
</head>
<h1><center>Добро пожаловать Техник</center></h1>
<form action="repairs/engineer_repairs.php" method="post">
    <button type="submit" name="button">Мои заказы</button>
</form>
<form action="orders/engineer_orders.php" method="post">
    <button type="submit" name="button">Заказы</button>
</form>
<body>
    <a href="index.php">Выход</a>
</body>
</html>