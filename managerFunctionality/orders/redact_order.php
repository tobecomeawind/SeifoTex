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
            Редактирование заказа
        </header>
        <form action="send_redact_order.php" method="POST">
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
                <input type="text" placeholder="Введите адрес" name="address" id="address" value=<?php echo "'".$_POST['address']."'";?> required>
            </div>

            <div class="field input">
                <label for="date">Дата</label>
                <input type="date" placeholder="Введите адрес" name="date" id="date"  value=<?php 
            	echo $_POST['date'];
            	?> 
			required>
            </div>

            <div class="field input">
                <label for="model">Модель банкомата</label>
                    <input id="model" name="model" list="atms" placeholder="Введите модель банкомата" value=
                    <?php

                    echo "'".$_POST['model']."'";

                    ?> required>
                    <datalist id='atms'>

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
                <label for="status">Статус</label>
                <select type="status" name="status" id="status" required>

                        <?php

                        if ($_POST['status']=='Создан'){
                            echo "<option value='Создан' selected>Создан</option>";

                            echo "<option value='В обработке'>В обработке</option>";

                            echo "<option value='Завершен'>Завершен</option>";

                        }elseif($_POST['status']=='В обработке'){

                            echo "<option value='Создан'>Создан</option>";

                            echo "<option value='В обработке' selected>В обработке</option>";

                            echo "<option value='Завершен'>Завершен</option>";

                        }else{

                            echo "<option value='Создан'>Создан</option>";

                            echo "<option value='В обработке'>В обработке</option>";

                            echo "<option value='Завершен' selected>Завершен</option>";
                        }


                        ?>
                    </select>
            </div>
            
            <input type='hidden' name='id_order' value=<?php echo $_POST['id_order'];?>>

            <input type='hidden' name='client_request_id' value=<?php echo $_POST['id_request'];?>>

            <input type='hidden' name='id_client' value=<?php echo $_POST['id_client'];?>>

            <div class="field">
                <input type="submit" name="submit" value="Изменить" required>

        </form>
    </div>
</div>

</body>
</html>