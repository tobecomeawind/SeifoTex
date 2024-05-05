<?php

session_start();

require_once('../database.php');

$name    = $_POST['name'];
$phone   = $_POST['phone'];
$address = $_POST['address'];
$date    = $_POST['date'];
$model   = $_POST['model'];



$connection->query("INSERT INTO `clients` VALUES ('$phone', '$name', '$address')");
$last_id = $connection->mysql_insert_id();
echo $last_id;

// $connection->query("INSERT INTO `orders` VALUES ('','$model', 'Создан')")


?>