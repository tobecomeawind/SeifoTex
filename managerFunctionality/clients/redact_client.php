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
            Редактирование данных клиента
        </header>
        <form action="send_redact_client.php" method="POST">
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
            
            <input type='hidden' name='name' value=<?php echo $_POST['name'];?>>

            <input type='hidden' name='phone' value=<?php echo $_POST['phone'];?>>

            <input type='hidden' name='address' value=<?php echo $_POST['address'];?>>

            <div class="field">
                <input type="submit" name="submit" value="Изменить" required>

        </form>
    </div>
</div>

</body>
</html>