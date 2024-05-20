<?php
session_start();

if (isset($_SESSION['current_file'])){

    $_SESSION['prev_file'] = $_SESSION['current_file'];

}else{
    $_SESSION['current_file'] = $_SERVER['SCRIPT_NAME'];
}

if (is_null($_SESSION['job']) or $_SESSION['job'] != 'stock'){

    header("Location: ../access_denied.php");

}
require_once("../../database.php");

$detail = $_POST['detail'];

$detail_query = $connection->query("SELECT * FROM `details` WHERE `Name`='$detail'");
$detail_info  = $detail_query->fetch_assoc();
$id_detail    = $detail_info['ID_Detail'];

$model  = $_POST['atm'];

$atm_query = $connection->query("SELECT * FROM `atms` WHERE `Model`='$model'");
$atm_info  = $atm_query->fetch_assoc();
$id_atm    = $atm_info['ID_ATM'];

$connection->query("INSERT INTO `atms-details`(`ID_ATM`, `ID_Detail`) VALUES ('$id_atm','$id_detail')");

header("Location: add_atm_detail.php?atm=".$model);
?>