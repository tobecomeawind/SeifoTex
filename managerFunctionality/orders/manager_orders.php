<?php
session_start();

if (isset($_SESSION['current_file'])){

    $_SESSION['prev_file'] = $_SESSION['current_file'];

}else{
    $_SESSION['current_file'] = $_SERVER['SCRIPT_NAME'];
}

if (is_null($_SESSION['job']) or $_SESSION['job'] != 'order'){

    header("Location: ../access_denied.php");

}
require_once('../../database.php');

echo "<body> <a href='../manager_panel.php'>Назад</a> </body>";

$orders = $connection->query("SELECT * FROM `orders`");

if ($orders->num_rows > 0){

    while ($row = mysqli_fetch_array($orders)) {

        $id_client = $row['ID_Client'];
        $clients = $connection->query("SELECT * FROM `clients` WHERE `ID_Client` = '$id_client'");
        $client = $clients->fetch_assoc();
        $name = $client['ФИО'];

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
        echo "<p>Имя клиента: " . $name . "</p>";
        echo "<p>Телефон клиента: " . $client['Номер телефона'] . "</p>";
        echo "<p>Адрес: " . $client['АДРЕС'] . "</p>";
        echo "<p>Дата заказа: " . $row['Date'] . "</p>";
        echo "<p>Модель банкомата: " . $model . "</p>";
        echo "<p>Статус: " . $row['Status'] . "</p>";

        echo "<details>";
        echo "<summary> Проблема клиента </summary>";
        echo "<p>" . $problem . "</p>";
        echo "</details>";

        
        echo "<form action='redact_order.php' method='post'>";
        echo "<input type='hidden' name='id_order' value='" . $row['ID_Order'] . "'>";
        echo "<input type='hidden' name='id_client' value='" . $row['ID_Client'] . "'>";
        echo "<input type='hidden' name='id_request' value='" . $id_req . "'>";
        echo "<input type='hidden' name='name' value='" . $name . "'>";
        echo "<input type='hidden' name='phone' value='" . $client['Номер телефона'] . "'>";
        echo "<input type='hidden' name='address' value='" . $client['АДРЕС'] . "'>";
        echo "<input type='hidden' name='date' value='" . $row['Date'] . "'>";
        echo "<input type='hidden' name='id_atm' value='" . $row['ID_ATM'] . "'>";
        echo "<input type='hidden' name='model' value='" . $model . "'>";
        echo "<input type='hidden' name='status' value='" . $row['Status'] . "'>";
        echo "<input type='hidden' name='problem' value='" . $problem   . "'>";
        echo "<button type='submit' name='create_order'>Изменить заказ</button>";
        echo "</form>";

        echo "<form action='delete_order.php' method='post'>";
        echo "<input type='hidden' name='id_order' value='" . $row['ID_Order'] . "'>";
        echo "<button type='submit' name='create_order'>Удалить заказ</button>";
        echo "</form>";

        echo "</div>";

    }
}else{
    echo "<center><h1>Заказов нет...</h1></center>";
}