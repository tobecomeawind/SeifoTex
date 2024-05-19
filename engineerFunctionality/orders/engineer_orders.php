<?php
session_start();

if (isset($_SESSION['current_file'])){

    $_SESSION['prev_file'] = $_SESSION['current_file'];

}else{
    $_SESSION['current_file'] = $_SERVER['SCRIPT_NAME'];
}

if (is_null($_SESSION['job']) or $_SESSION['job'] != 'engineer'){

    header("Location: ../access_denied.php");

}

require_once('../../database.php');

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

    $id_atm = $row['ID_ATM'];
    $atms = $connection->query("SELECT * FROM `atms` WHERE `ID_ATM`='$id_atm'");
    $atms_info = $atms->fetch_assoc();
    $model = $atms_info['Model'];

    $id_req = $row['ID_Request'];
    $atms = $connection->query("SELECT * FROM `clients_requests` WHERE `ID_Request`='$id_req'");
    $atms_info = $atms->fetch_assoc();
    $problem = $atms_info['problem'];


    echo "<div class='order' style='text-align: center'>";
    echo "<h3>Заказ № " . $row['ID_Order'] . "</h3>";
    echo "<p>Имя клиента: " . $client['ФИО'] . "</p>";
    echo "<p>Телефон клиента: " . $client['Номер телефона'] . "</p>";
    echo "<p>Адрес: " . $client['АДРЕС'] . "</p>";
    echo "<p>Дата заказа: " . $row['Date'] . "</p>";
    echo "<p>Модель банкомата: " . $model . "</p>";

    echo "<details>";
    echo "<summary> Проблема клиента </summary>";
    echo "<p>" . $problem . "</p>";
    echo "</details>";

    
    echo "<form action='take_order.php' method='post'>";
    echo "<input type='hidden' name='id_order' value='" . $row['ID_Order'] . "'>";
    echo "<input type='hidden' name='id_atm' value='" . $id_atm . "'>";
    echo "<button type='submit' name='take_order'>Взять заказ</button>";
    echo "</form>";

    echo "</div>";

echo "<body> <a href='../engineer_panel.php'>Назад</a> </body>";
}