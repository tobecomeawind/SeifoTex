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

// $query_result = $connection->query("SELECT count(*) FROM `clients_requests` WHERE `phone` = '$phone'");

// if (mysqli_fetch($query_result)[0] > 0){
    
//     echo "request in table";
//     // header("Location: index.html");
// }

$connection->query("INSERT INTO `clients_requests`(`name`, `phone`, `problem`) VALUES ('$name','$phone','$problem')");

header("Location: index.html");

