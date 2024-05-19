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

$id_order = $_POST['ID_Order'];

$connection->query("UPDATE `orders` SET `Status`='Выполнен' WHERE `ID_Order`='$id_order'");
$connection->query("UPDATE `repairs` SET `Status`='Выполнен' WHERE `ID_Order`='$id_order'");

header('Location: engineer_repairs.php');

?>