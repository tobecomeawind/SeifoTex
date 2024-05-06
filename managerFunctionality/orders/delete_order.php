<?php

require_once('../../database.php');

$id_order = $_POST['id_order'];

$connection->query("DELETE FROM `orders` WHERE `ID_Order`='$id_order'");

header("Location: manager_orders.php"); 

?>