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

require_once('../../database.php');

$id_detail = $_POST['id_detail'];

$connection->query("DELETE FROM `details` WHERE `ID_Detail`='$id_detail'");

header("Location: add_detail.php");

?>