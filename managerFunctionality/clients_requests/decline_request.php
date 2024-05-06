<?php

require_once('../../database.php');

$id_request = $_POST['id_request'];

$connection->query("DELETE FROM `clients_requests` WHERE `ID_Request`='$id_request'");

header("Location: client_requests.php"); 

?>