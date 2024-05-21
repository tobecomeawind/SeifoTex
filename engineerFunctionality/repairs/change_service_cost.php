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

$service_cost = $_POST['money'];
$id_repair    = $_POST['id_repair'];

$connection->query("UPDATE `repairs` SET `service_cost`='$service_cost' WHERE `ID_Repair`='$id_repair'");

header("Location: engineer_repairs.php");
