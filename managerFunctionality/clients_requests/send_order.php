<?php

require_once('../../database.php');

print_r($_POST);

$name              = $_POST['name'];
$phone             = $_POST['phone'];
$address           = $_POST['address'];
$date              = $_POST['date'];
$model             = $_POST['model'];

$atms_request = $connection->query("SELECT * FROM `atms` WHERE `Model`='$model'");
$atm_info = $atms_request->fetch_assoc();
$id_atm = $atm_info['ID_ATM'];

$client_request_id = $_POST['client_request_id'];

$connection->query("INSERT INTO `clients`(`Номер телефона`, `ФИО`, `АДРЕС`) VALUES ('$phone', '$name', '$address')");
$client_id = $connection->insert_id;


$connection->query("INSERT INTO `orders`(`ID_Client`, `ID_ATM`, `Date`, `Status`) VALUES ('$client_id','$id_atm','$date','Создан')");

$connection->query("UPDATE `clients_requests` SET `Status`='Обработан' WHERE `ID_Request`='$client_request_id'");

header("Location: client_requests.php");

?>