<?php

session_start();

if (isset($_SESSION['current_file'])){

    $_SESSION['prev_file'] = $_SESSION['current_file'];

}else{
    $_SESSION['current_file'] = $_SERVER['SCRIPT_NAME'];
}

if (is_null($_SESSION['job']) or $_SESSION['job'] != 'admin'){
    
    header("Location: ../access_denied.php");

}


require_once('../database.php');

$login      = $_POST['username'];
$password   = $_POST['password'];
$job        = $_POST['job'];

$connection->query("INSERT INTO `workers`(`login`, `password`, `job`) VALUES ('$login','$password','$job')");


header("Location: admin_panel.php");


