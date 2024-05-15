<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css">
<div class="container">
    <div class="box form-box">
        <header>
            Создание заказа
        </header>
        <form action="send_order.php" method="POST">
            <div class="field input">
                <label for="name">ФИО клиента</label>
                <input type="text" placeholder="Введите ФИО" name="name" id="name" value= 
                <?php
                echo "'".$_POST['name']."'";
                ?>
                required>
            </div>

            <div class="field input">
                <label for="phone">Номер телефона</label>
                <input type="text" placeholder="7-123-456-78-90" name="phone" id="phone" value=
                <?php
                echo $_POST['phone'];
                ?> 
                required>
            </div>

            <div class="field input">
                <label for="address">Адрес</label>
                <input type="text" placeholder="Введите адрес" name="address" id="address" required>
            </div>

            <div class="field input">
                <label for="date">Дата</label>
                <input type="date" placeholder="Введите адрес" name="date" id="date"  value=<?php 
            	echo date('Y-m-d');
            	?> 
			required>
            </div>

            <div class="field input">

                <label for="model">Модель банкомата</label>
                    <input id="model" name="model" list="atms" placeholder="Введите модель банкомата" required>
                    <datalist id='atms'>

                        <option value="">Не указано</option>

                        <?php

                        require_once('../../database.php');

                        $atms_info = $connection->query('SELECT * FROM `atms`');

                        while($row = mysqli_fetch_array($atms_info)){

                            echo "<option value='".$row['Model']."'>".$row['Model']."</option>";
                        }

                        ?>

                    </datalist>
                    
            </div>

            <div class="field input">
                <label for="name">Проблема клиента</label>
                <input type="text" placeholder="Проблема" name="problem" id="problem" value= 
                <?php
                echo "'".$_POST['problem']."'";
                ?>
                required>
            </div>

            
            <input type='hidden' name='client_request_id' value=<?php echo $_POST['id_request'];?>>


            <div class="field">
                <input type="submit" name="submit" value="Создать" required>

        </form>
    </div>
</div>

</body>
</html>