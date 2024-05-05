<?php

session_start();

require_once('../database.php');

$id_order = $_POST['ID_Order'];

$connection->query("UPDATE `orders` SET `Status`='Создан' WHERE `ID_Order`='$id_order'");
$connection->query("DELETE FROM `repairs` WHERE `ID_Order`='$id_order'");

header('Location: engineer_repairs.php');



?>ll