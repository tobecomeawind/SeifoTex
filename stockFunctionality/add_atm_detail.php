<?php

require_once("../database.php");

$detail = $_POST['detail'];

$detail_query = $connection->query("SELECT * FROM `details` WHERE `Name`='$detail'");
$detail_info  = $detail_query->fetch_assoc();
$id_detail       = $detail_info['ID_Detail'];


$model  = $_POST['model'];

$atm_query = $connection->query("SELECT * FROM `atms` WHERE `Model`='$model'");
$atm_info  = $atm_query->fetch_assoc();
$id_atm    = $detail_info['ID_ATM'];



$connection->query("INSERT INTO `atms-details`(`ID_ATM`, `ID_Detail`) VALUES ('$id_atm','$id_detail')");

?>