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

echo "<body> <a href='../engineer_panel.php'>Назад</a> </body>";

require_once('../../database.php');

$orders = $connection->query("SELECT * FROM `orders` WHERE `Status` = 'Создан'");

if ($orders->num_rows >0){

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


        $complete_atm_query = $connection->query("SELECT * FROM `completed_atms` WHERE `ID_ATM`='$id_atm'");
        if ($complete_atm_query->num_rows != 0){

            $status = 'Да';

        }else{

            $status = 'Нет';

        }

        echo "<div class='order' style='text-align: center'>";
        echo "<h3>Заказ № " . $row['ID_Order'] . "</h3>";
        echo "<p>Имя клиента: " . $client['ФИО'] . "</p>";
        echo "<p>Телефон клиента: " . $client['Номер телефона'] . "</p>";
        echo "<p>Адрес: " . $client['АДРЕС'] . "</p>";
        echo "<p>Дата заказа: " . $row['Date'] . "</p>";
        echo "<p>Модель банкомата: " . $model . "</p>";
        echo "<p>Укомплектован: ".$status."</p>";


        echo "<details>";
        echo "<summary> Проблема клиента </summary>";
        echo "<p>" . $problem . "</p>";
        echo "</details>";

        
        echo "<form action='take_order.php' method='post'>";
        echo "<input type='hidden' name='id_order' value='" . $row['ID_Order'] . "'>";
        echo "<input type='hidden' name='id_atm' value='" . $id_atm . "'>";
        echo "<button type='submit' >Взять заказ</button>";
        echo "</form>";

        echo "</div>";


    }
}else{
    echo "<center><h1>Заказов пока нет...</h1></center>";
}