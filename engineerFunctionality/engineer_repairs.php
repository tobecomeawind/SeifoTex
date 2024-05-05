<?php

session_start();

require_once('../database.php');

$id_engineer = $_SESSION['ID_Engineer'];

$repairs = $connection->query("SELECT * FROM `repairs` WHERE `ID_Engineer`='$id_engineer' and `Status`='В обработке'");

while ($row = mysqli_fetch_array($repairs)) {

    $id_order    = $row['ID_Order'];
    $order_query = $connection->query("SELECT * FROM `orders` WHERE `ID_Order`='$id_order' ");
    $order_info  = $order_query->fetch_assoc();

    $id_client    = $order_info['ID_Client'];
    $client_query = $connection->query("SELECT * FROM `clients` WHERE `ID_Client`='$id_client'");
    $client_info  = $client_query->fetch_assoc();

    $id_atm    = $row['ID_ATM'];
    $atm_query = $connection->query("SELECT * FROM `atms` WHERE `ID_ATM`='$id_atm' ");
    $atm_info  = $atm_query->fetch_assoc();

    echo "<div class='order' style='text-align: center'>";
    echo "<h2>Ремонтная услуга № " . $row['ID_Repair'] . "</h2>";
    echo "<p>Заказ №: " . $row['ID_Order'] . "</p>";

    echo "<body>";
    echo "<details>";
    echo "<summary>Информация по заказу </summary>";
    echo "<p>Имя клиента: " . $client_info['ФИО'] . "</p>";
    echo "<p>Телефон клиента: " . $client_info['Номер телефона'] . "</p>";
    echo "<p>Адрес: " . $client_info['АДРЕС'] . "</p>";
    echo "<p>Дата: " . $order_info['Date'] . "</p>";
    echo "</details>";
    echo "</body>";

    echo "<p>Модель банкомата: " . $atm_info['Model'] . "</p>";

    echo "<form action='accept_order.php' method='post'>";
    echo "<input type='hidden' name='ID_Order' value='" . $row['ID_Order'] . "'>";
    echo "<button type='submit' name='accept_order'>Ремонт совершен</button>";
    echo "</form>";

    echo "<form action='decline_order.php' method='post'>";
    echo "<input type='hidden' name='ID_Order' value='" . $row['ID_Order'] . "'>";
    echo "<button type='submit' name='decline_order'>Отменить заказ</button>";
    echo "</form>";

    echo "</div>";

}