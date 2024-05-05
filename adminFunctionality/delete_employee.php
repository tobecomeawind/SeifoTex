<?php

require_once('../database.php');

$id_employee = $_POST['ID'];

echo $id_employee;

$connection->query("DELETE FROM `workers` WHERE `ID_Worker`='$id_employee'");


header("Location: admin_panel.php");