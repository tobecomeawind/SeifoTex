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
require_once("../database.php");

$id_detail = $_POST['id_detail'];
$quantity  = $_POST['quantity'];

if ($quantity>=1){ 

	$quantity -= 1;

	$connection->query("UPDATE `details` SET `Quantity_details`='$quantity' WHERE `ID_Detail`='$id_detail'");
}

header('Location: stock_panel.php');
?>