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

$name_detail = $_POST['repair_detail'];
$id_repair   = $_POST['id_repair'];

$detail_query = $connection->query("SELECT * FROM `details` WHERE `Name`='$name_detail'");
$detail_info  = $detail_query->fetch_assoc();
$id_detail    = $detail_info['ID_Detail'];

$connection->query("DELETE FROM `repairs_details` WHERE `ID_Repair`='$id_repair' && `ID_Detail`='$id_detail'");

header('Location: engineer_repairs.php');


?>
