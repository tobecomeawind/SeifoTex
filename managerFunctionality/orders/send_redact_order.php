<?php

session_start();

if (isset($_SESSION['current_file'])){

    $_SESSION['prev_file'] = $_SESSION['current_file'];

}else{
    $_SESSION['current_file'] = $_SERVER['SCRIPT_NAME'];
}

if (is_null($_SESSION['job']) or $_SESSION['job'] != 'order'){

    header("Location: ../access_denied.php");

}


require_once('../../database.php');
$name              = $_POST['name'];
$phone             = $_POST['phone'];
$address           = $_POST['address'];
$date              = $_POST['date'];
$problem           = $_POST['problem'];
$model             = $_POST['model'];

$atms_request = $connection->query("SELECT * FROM `atms` WHERE `Model`='$model'");
$atm_info = $atms_request->fetch_assoc();
$id_atm = $atm_info['ID_ATM'];

$status			   = $_POST['status'];
$id_client         = $_POST['id_client'];
$id_order          = $_POST['id_order'];
$client_request_id = $_POST['client_request_id'];


$connection->query("UPDATE `clients` SET `Номер телефона`='$phone',`ФИО`='$name',`АДРЕС`='$address' WHERE `ID_Client`='$id_client'");

$connection->query("UPDATE `orders` SET `ID_ATM`='$id_atm',`Date`='$date',`Status`='$status' WHERE `ID_Order`='$id_order'");

$connection->query("UPDATE `clients_requests` SET `phone`='$phone',`name`='$name',`problem`='$problem' WHERE `ID_Request`='$client_request_id'");

header("Location: manager_orders.php");

?>