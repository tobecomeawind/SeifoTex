<?php

require_once('../../database.php');

$client_requests = $connection->query("SELECT * FROM `clients`");

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


?>

