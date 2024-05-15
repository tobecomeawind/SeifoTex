<?php

session_start();

require_once('../../database.php');

$id_engineer = $_SESSION['ID_Engineer'];

$id_order    = $_POST['id_order'];
$id_atm      = $_POST['id_atm'];

$connection->query("INSERT INTO `repairs`(`ID_Order`, `ID_Engineer`, `ID_ATM`, `Status`) VALUES ('$id_order', '$id_engineer', '$id_atm', 'В обработке')");

$connection->query("UPDATE `orders` SET `Status`='В обработке' WHERE `ID_Order`='$id_order'");

header('Location: engineer_orders.php');

?>