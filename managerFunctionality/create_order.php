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
                echo $_POST['name'];
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
                <label for="address">Дата</label>
                <input type="date" placeholder="Введите адрес" name="date" id="date"  value=<?php 
            	echo date('Y-m-d');
            	?> 
			required>
            </div>

            <div class="field input">
                <label for="address">Модель банкомата</label>
                <input type="text" placeholder="Введите модель банкомата" name="model" id="model" required>
            </div>


            <div class="field">
                <input type="submit" name="submit" value="Создать" required>

        </form>
    </div>
</div>

</body>
</html>