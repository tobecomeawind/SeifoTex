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

$id_atm = $_POST['id_atm'];
$atm    = $_POST['atm'];

if (isset($_POST['full'])){

    $connection->query("DELETE FROM `completed_atms` WHERE `ID_ATM`='$id_atm'");

}else{

    $connection->query("INSERT INTO `completed_atms` (`ID_ATM`) VALUES ('$id_atm')");

}

header("Location: add_atm_detail.php?atm=".$atm);

?>