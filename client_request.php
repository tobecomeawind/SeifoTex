<?php

$servername = 'localhost';
$username   = 'root';
$password   = '';
$dbname     = 'seifotex';

$connection = mysqli_connect($servername, $username, $password, $dbname);


if (!$connection){
    die("Проблемы с подключением");
}

$name     = $_POST['contact_name'];
$phone    = $_POST['contact_phone'];
$problem  = $_POST['contact_message'];


$connection->query("INSERT INTO `clients_requests`(`name`, `phone`, `problem`, `Status`) VALUES ('$name','$phone','$problem', 'Создан')");

header("Location: index.html");

