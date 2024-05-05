<?php
session_start();

require_once('../database.php');

$login = $_SESSION['username'];

$result = $connection->query("SELECT * FROM `engineer` WHERE `login` = '$login'");

$engineer_info = $result->fetch_assoc();

$id_engineer = $engineer_info['ID_Engineer'];

$_SESSION['ID_Engineer'] = $id_engineer;

$orders = $connection->query("SELECT * FROM `orders` WHERE `Status` = 'Создан'");

while ($row = mysqli_fetch_array($orders)) {

    $id_client = $row['ID_Client'];

    $clients = $connection->query("SELECT * FROM `clients` WHERE `ID_Client` = '$id_client'");

    $client = $clients->fetch_assoc();

    echo "<div class='order' style='text-align: center'>";
    echo "<h3>Заказ № " . $row['ID_Order'] . "</h3>";
    echo "<p>Имя клиента: " . $client['ФИО'] . "</p>";
    echo "<p>Телефон клиента: " . $client['Номер телефона'] . "</p>";
    echo "<p>Адрес: " . $client['АДРЕС'] . "</p>";
    echo "<p>Дата заказа: " . $row['Date'] . "</p>";
    echo "<p>Модель банкомата: " . $row['Model ATM'] . "</p>";

    
    echo "<form action='take_order.php' method='post'>";
    echo "<input type='hidden' name='ID_Order' value='" . $row['ID_Order'] . "'>";
    echo "<input type='hidden' name='Model' value='" . $row['Model ATM'] . "'>";
    echo "<button type='submit' name='take_order'>Взять заказ</button>";
    echo "</form>";

    echo "</div>";

}