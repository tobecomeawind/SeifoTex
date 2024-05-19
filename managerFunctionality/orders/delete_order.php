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

$id_order = $_POST['id_order'];

$connection->query("DELETE FROM `orders` WHERE `ID_Order`='$id_order'");

header("Location: manager_orders.php"); 

?>