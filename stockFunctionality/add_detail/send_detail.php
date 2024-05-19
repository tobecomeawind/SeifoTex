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

$name = $_POST['name'];
$spec = $_POST['spec'];

$spec_query = $connection->query("SELECT * FROM `specifications` WHERE `Name`='$spec'");
$spec_info  = $spec_query->fetch_assoc();
$id_spec    = $spec_info['ID_Specification']; 

$factory_id = $_POST['factory'];
$quantity   = $_POST['quantity'];
$cost       = $_POST['cost'];

$connection->query("INSERT INTO `details`(`Name`, `ID_Specification`, `factory_id`, `Quantity_details`, `cost`) VALUES ('$name','$id_spec','$factory_id','$quantity','$cost')");

header("Location: stock_panel.php");
?>