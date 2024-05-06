<?php

require_once('../../database.php');

$client_requests = $connection->query("SELECT * FROM `clients_requests` WHERE `Status`='Создан'");

while ($row = mysqli_fetch_array($client_requests)) {

    echo "<div class='order' style='text-align: center'>";
    echo "<h3>Заявка № " . $row['ID_Request'] . "</h3>";
    echo "<p>Имя клиента: " . $row['name'] . "</p>";
    echo "<p>Телефон клиента: " .$row['phone'] . "</p>";
    
    echo "<details>";
    echo "<summary> Проблема клиента </summary>";
    echo "<p>" . $row['problem'] . "</p>";
    echo "</details>";


    echo "<form action='create_order.php' method='post'>";
    echo "<input type='hidden' name='name' value='" . $row['name'] . "'>";
    echo "<input type='hidden' name='phone' value='" . $row['phone'] . "'>";
    echo "<input type='hidden' name='id_request' value='" . $row['ID_Request'] . "'>";
    echo "<button type='submit' name='create_order'>Cоздать заказ</button>";
    echo "</form>";

    echo "<form action='decline_request.php' method='post'>";
    echo "<input type='hidden' name='id_request' value='" . $row['ID_Request'] . "'>";
    echo "<button type='submit' name='create_order'>Отменить заявку</button>";
    echo "</form>";

    echo "</div>";

}


?>