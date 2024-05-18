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
            Добавление банкомата
        </header>
        <form action="send_atm.php" method="POST">
            <div class="field input">
                <label for="atm">Наименование банкомата</label>
                <input type="text" placeholder="Введите наименование банкомата" name="atm" id="atm"
                required>
            </div>

<!--             <form action="add_atm.php" method="POST">
                <div class="field input">

                    <label for="detail">Детали</label>
                        <?php

                        ?>
                        <input id="detail" name="detail" list="details" placeholder="Выберите и добавьте деталь">
                        <datalist id='details'>

                            <?php

                            require_once('../database.php');

                            $details_info = $connection->query('SELECT * FROM `details`');

                            while($row = mysqli_fetch_array($details_info)){

                                echo "<option value='".$row['Name']."'>".$row['Name']."</option>";
                            }

                            ?>

                        </datalist>
                        
                </div>
                <div class="field">
                    <input type="submit" name="submit" value="Добавить деталь" required>
                </div>
            <form/> -->
            
            <input type='hidden' name='client_request_id' value=<?php echo $_POST['id_request'];?>>


            <div class="field">
                <input type="submit" name="submit" value="Создать" required>

        </form>
        <form action="add_atm_detail.php" method="POST">
            <div class="field input">
                <label for="atm">Наименование банкомата</label>
                <input type="atm" list="atms" placeholder="Выберите банкомат" name="atm" id="atm" value=<?php echo "'".$_POST['atm']."'";?>
                required>

                <datalist id='atms'>

                        <?php

                        require_once('../database.php');

                        $atms_info = $connection->query('SELECT * FROM `atms`');

                        while($row = mysqli_fetch_array($atms_info)){

                            echo "<option value='".$row['Model']."'>".$row['Model']."</option>";
                        }

                        ?>

                    </datalist>

                    <label for="detail">Детали</label>
                        <?php
                        echo $_POST['atm_details'];
                        ?>
                        <input id="detail" name="detail" list="details" placeholder="Выберите и добавьте деталь">
                        <datalist id='details'>

                            <?php

                            require_once('../database.php');

                            $details_info = $connection->query('SELECT * FROM `details`');

                            while($row = mysqli_fetch_array($details_info)){

                                echo "<option value='".$row['Name']."'>".$row['Name']."</option>";
                            }

                            ?>

                        </datalist>
                        
                </div>
                <div class="field">
                    <input type="submit" name="submit" value="Добавить деталь" required>
                </div>

            
            <input type='hidden' name='client_request_id' value=<?php echo $_POST['id_request'];?>>

        </form>

    </div>
</div>

</body>
</html>