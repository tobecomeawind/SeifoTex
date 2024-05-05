<?php

session_start();

require_once('../database.php');

$id_engineer = $_SESSION['ID_Engineer'];

$model       = $_POST['Model'];
$id_order    = $_POST['ID_Order'];


$atm_info = $connection->query("SELECT * FROM `atms` WHERE `Model` = '$model'");

$id_atm = $atm_info->fetch_assoc()['ID_ATM'];

$connection->query("INSERT INTO `repairs`(`ID_Order`, `ID_Engineer`, `ID_ATM`, `Status`) VALUES ('$id_order', '$id_engineer', '$id_atm', 'В обработке')");

$connection->query("UPDATE `orders` SET `Status`='В обработке' WHERE `ID_Order`='$id_order'");

header('Location: engineer_orders.php');

?>