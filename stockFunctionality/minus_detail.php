<?php

require_once("../database.php");

$id_detail = $_POST['id_detail'];
$quantity  = $_POST['quantity'];

if ($quantity>=1){ 

	$quantity -= 1;

	$connection->query("UPDATE `details` SET `Quantity_details`='$quantity' WHERE `ID_Detail`='$id_detail'");
}

header('Location: stock_panel.php');
?>