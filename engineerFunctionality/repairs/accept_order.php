<?php

require_once('../../database.php');

$id_order = $_POST['ID_Order'];

$connection->query("UPDATE `orders` SET `Status`='Выполнен' WHERE `ID_Order`='$id_order'");
$connection->query("UPDATE `repairs` SET `Status`='Выполнен' WHERE `ID_Order`='$id_order'");

header('Location: engineer_repairs.php');

?>