<?php

require_once("../../database.php");

$id_client = $_POST['id_client'];

$connection->query("DELETE FROM `clients` WHERE `ID_Client`='$id_client'");


header("Location: clients.php");
?>