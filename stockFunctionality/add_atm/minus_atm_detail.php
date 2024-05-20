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

$id_detail = $_POST['id_detail'];
$id_atm    = $_POST['id_atm'];

$connection->query("DELETE FROM `atms-details` WHERE `ID_ATM`='$id_atm' and `ID_Detail`='$id_detail'");


header('Location: stock_panel.php');
?>