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

$name = $_POST['spec'];

$connection->query("INSERT INTO `specifications` (`Name`) VALUES ('$name')");

header("Location: add_detail.php");

?>