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

echo "<body> <a href='../engineer_panel.php'>Назад</a> </body>";

$id_engineer = $_SESSION['ID_Engineer'];

$repairs = $connection->query("SELECT * FROM `repairs` WHERE `ID_Engineer`='$id_engineer' and `Status`='В обработке'");

if ($repairs->num_rows >0){

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

        $id_req = $order_info['ID_Request'];
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
        echo "<h2>Ремонтная услуга № " . $row['ID_Repair'] . "</h2>";
        echo "<p>Заказ №: " . $row['ID_Order'] . "</p>";

        echo "<body>";
        echo "<details>";
        echo "<summary>Информация по заказу </summary>";
        echo "<p>Имя клиента: " . $client_info['ФИО'] . "</p>";
        echo "<p>Телефон клиента: " . $client_info['Номер телефона'] . "</p>";
        echo "<p>Адрес: " . $client_info['АДРЕС'] . "</p>";
        echo "<p>Дата: " . $order_info['Date'] . "</p>";
        echo "<details>";
        echo "<summary> Проблема клиента </summary>";
        echo "<p>" . $problem . "</p>";
        echo "</details>";
        echo "</details>";
        echo "</body>";

        echo "<p>Модель банкомата: " . $atm_info['Model'] . "</p>";
        echo "<p>Укомплектован: ".$status."</p>";
        echo "<details>";
        echo "<summary>Используемые детали</summary>";

        $id_repair = $row['ID_Repair'];
        $repairs_details_query = $connection->query("SELECT * FROM `repairs_details` WHERE `ID_Repair`='$id_repair'");
        $used_details = array();

        if ($repairs_details_query->num_rows > 0){

            $counter = 0;

            $total_cost = 0;

            while($repair_detail = $repairs_details_query->fetch_assoc()){

                $id_detail = $repair_detail['ID_Detail'];
                $detail_query = $connection->query("SELECT * FROM `details` WHERE `ID_Detail`='$id_detail'");
                $detail_info  = $detail_query->fetch_assoc();
                $name         = $detail_info['Name'];
                
                $counter++;
                echo "<p>".$counter.". ".$name."  (".$detail_info['cost']." р.)"."</p>";

                $total_cost += $detail_info['cost'];

                array_push($used_details, $name);      
            }

            echo "Итоговая стоимость деталей: ".$total_cost." р.";

        }else{
            echo "<p>На данный момент ремонтная услуга не содержит деталей</p>";
        }               

        echo '<form action="send_repair_detail.php" method="POST">';
        echo '<label for="repair_detail"></label>';
        echo '<input id="repair_detail" name="repair_detail" list="atm_details" placeholder="Выберите деталь для добавления" required>';
        echo "<datalist id='atm_details'>";
            

        $details_atms_query = $connection->query("SELECT * FROM `atms-details` WHERE `ID_ATM`='$id_atm'");

        while($detail_atms = mysqli_fetch_array($details_atms_query)){

            $id_detail = $detail_atms['ID_Detail'];

            $details_query = $connection->query("SELECT * FROM `details` WHERE `ID_Detail`='$id_detail'");
            $details_info  = $details_query->fetch_assoc();

            if (!in_array($details_info['Name'], $used_details)){
                echo "<option value='".$details_info['Name']."'>".$details_info['Name']."</option>";
            }
        }
        echo "</datalist>";    
        echo "<input type='hidden' name='id_repair' value='" . $id_repair . "'>";
        echo "<button type='submit'>Добавить деталь</button>";
        echo"</form>";

        if ($used_details){
            echo '<form action="delete_repair_detail.php" method="POST">';
            echo '<label for="repair_detail"></label>';
            echo '<input id="repair_detail" name="repair_detail" list="deletable_details" placeholder="Выберите деталь для удаления" required>';
            echo "<datalist id='deletable_details'>";
                
            $details_info = $detail_query->fetch_assoc();

            foreach($used_details as $name){  

                echo "<option value='".$name."'>".$name."</option>";
                
            }
            echo "</datalist>";    
            echo "<input type='hidden' name='id_repair' value='" . $id_repair . "'>";
            echo "<button type='submit'>Удалить деталь</button>";
            echo"</form>";
        }
        echo "</details>";


        echo "<details>";
        echo "<summary>Стоимость услуг</summary>";
        echo "<form action='change_service_cost.php' method='post'>";
        echo "<input type='hidden' name='id_repair' value='" . $id_repair . "'>";
        echo "<input type='text' name='money' value='".$row['service_cost']."'>";
        echo "<button type='submit'>Изменить</button>";
        echo "</form>";
        echo "</details>";

        echo "<p>Итоговая стоимость ремонтной услуги: ".$total_cost+$row['service_cost']."</p>";

        echo "<form action='accept_order.php' method='post'>";
        echo "<input type='hidden' name='id_order' value='" . $row['ID_Order'] . "'>";
        echo "<input type='hidden' name='id_repair' value='" . $id_repair . "'>";
        echo "<input type='hidden' name='id_client' value='" . $id_client . "'>";
        echo "<input type='hidden' name='total_cost' value='" . $total_cost+$row['service_cost'] . "'>";
        echo "<button type='submit'>Ремонт совершен</button>";
        echo "</form>";

        echo "<form action='decline_order.php' method='post'>";
        echo "<input type='hidden' name='ID_Order' value='" . $row['ID_Order'] . "'>";
        echo "<button type='submit'>Отменить заказ</button>";
        echo "</form>";

        echo "</div>";



    }
}else{
    echo "<center><h1>У вас пока нет ремонтных услуг...</h1></center>";
}