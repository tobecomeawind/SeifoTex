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

require_once("../../database.php");

$id_client = $_POST['id_client'];

$connection->query("DELETE FROM `clients` WHERE `ID_Client`='$id_client'");


header("Location: clients.php");
?>