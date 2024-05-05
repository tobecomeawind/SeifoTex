<?php

require_once('../database.php');

$login      = $_POST['username'];
$password   = $_POST['password'];
$job        = $_POST['job'];

$connection->query("INSERT INTO `workers`(`login`, `password`, `job`) VALUES ('$login','$password','$job')");


header("Location: admin_panel.php");


