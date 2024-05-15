<?php

require_once('../../database.php');
$name              = $_POST['name'];
$phone             = $_POST['phone'];
$address           = $_POST['address'];
$id_client         = $_POST['id_client'];

$connection->query("UPDATE `clients` SET `Номер телефона`='$phone',`ФИО`='$name',`АДРЕС`='$address' WHERE `ID_Client`='$id_client'");

header("Location: clients.php");

?>