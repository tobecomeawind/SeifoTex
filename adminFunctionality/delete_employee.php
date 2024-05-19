<?php

session_start();

if (isset($_SESSION['current_file'])){

    $_SESSION['prev_file'] = $_SESSION['current_file'];

}else{
    $_SESSION['current_file'] = $_SERVER['SCRIPT_NAME'];
}

if (is_null($_SESSION['job']) or $_SESSION['job'] != 'admin'){
    
    header("Location: ../access_denied.php");

}

require_once('../database.php');

$id_employee = $_POST['ID'];

echo $id_employee;

$connection->query("DELETE FROM `workers` WHERE `ID_Worker`='$id_employee'");


header("Location: admin_panel.php");