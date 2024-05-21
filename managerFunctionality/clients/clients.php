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

$client_requests = $connection->query("SELECT * FROM `clients`");

if ($client_requests->num_rows>0){

    while ($row = mysqli_fetch_array($client_requests)) {

        echo "<div class='order' style='text-align: center'>";
        echo "<h3>ID Клиента " . $row['ID_Client'] . "</h3>";
        echo "<p>Имя клиента: " . $row['ФИО'] . "</p>";
        echo "<p>Телефон клиента: " .$row['Номер телефона'] . "</p>";
        echo "<p>Адрес: " .$row['АДРЕС'] . "</p>";
        
        echo "<form action='redact_client.php' method='post'>";
        echo "<input type='hidden' name='name' value='" . $row['ФИО'] . "'>";
        echo "<input type='hidden' name='phone' value='" . $row['Номер телефона'] . "'>";
        echo "<input type='hidden' name='address' value='" . $row['АДРЕС'] . "'>";
        echo "<input type='hidden' name='id_client' value='" . $row['ID_Client'] . "'>";
        echo "<button type='submit' name='create_order'>Изменить данные клиента</button>";
        echo "</form>";

        echo "<form action='delete_client.php' method='post'>";
        echo "<input type='hidden' name='id_client' value='" . $row['ID_Client'] . "'>";
        echo "<button type='submit' name='create_order'>Удалить клиента</button>";
        echo "</form>";

        echo "</div>";

    }
}else{
    echo "<center><h1>Клиентов нет...</h1></center>";
}

?>

