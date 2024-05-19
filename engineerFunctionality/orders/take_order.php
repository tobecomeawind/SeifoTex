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

require_once('../../database.php');

$id_engineer = $_SESSION['ID_Engineer'];

$id_order    = $_POST['id_order'];
$id_atm      = $_POST['id_atm'];

$connection->query("INSERT INTO `repairs`(`ID_Order`, `ID_Engineer`, `ID_ATM`, `Status`) VALUES ('$id_order', '$id_engineer', '$id_atm', 'В обработке')");

$connection->query("UPDATE `orders` SET `Status`='В обработке' WHERE `ID_Order`='$id_order'");

header('Location: engineer_orders.php');

?>