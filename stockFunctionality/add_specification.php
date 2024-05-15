<?php

require_once('../database.php');

$name = $_POST['spec'];

$connection->query("INSERT INTO `specifications` (`Name`) VALUES ('$name')");

header("Location: stock_panel.php");

?>