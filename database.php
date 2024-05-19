<?php


$servername = 'localhost';
$username   = 'root';
$password   = '';
$dbname     = 'seifotex';

$connection = mysqli_connect($servername, $username, $password, $dbname);


if (!$connection){
    die("Проблемы с подключением");
}

