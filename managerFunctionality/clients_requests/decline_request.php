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

require_once('../../database.php');

$id_request = $_POST['id_request'];

$connection->query("DELETE FROM `clients_requests` WHERE `ID_Request`='$id_request'");

header("Location: client_requests.php"); 

?>