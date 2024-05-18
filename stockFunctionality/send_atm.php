<?php

require_once("../database.php");

$model = $_POST['atm'];

$connection->query("INSERT INTO `atms` (`Model`) VALUES ('$model')");

header('Location: add_atm.php');

?>