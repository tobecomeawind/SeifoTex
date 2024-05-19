<?php
session_start();

if (isset($_SESSION['current_file'])){

    $_SESSION['prev_file'] = $_SESSION['current_file'];

}else{
    $_SESSION['current_file'] = $_SERVER['SCRIPT_NAME'];
}

if (is_null($_SESSION['job']) or $_SESSION['job'] != 'stock'){

    header("Location: ../access_denied.php");

}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css">
<div class="container">
    <div>
        <header>
            Добавление банкомата
        </header>
        <form action="send_atm.php" method="POST">
            <div class="field input">
                <label for="atm">Наименование банкомата</label>
                <input type="text" placeholder="Введите наименование банкомата" name="atm" id="atm"
                required>
            </div>
            <div class="field">
                <input type="submit" name="submit" value="Создать" required>
            </div>
        </form>
        <form action="add_atm_detail.php" method="POST">
            <div class="field input">
                <label for="atm">Наименование банкомата</label>
                <input type="atm" list="atms" placeholder="Выберите банкомат" name="atm" id="atm" value=<?php echo "'".$_POST['atm']."'";?>
                required>

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

                <div class="field">
                    <input type="submit" name="submit" value="Редактировать детали банкомата" required>
                </div>

        </form>

    </div>
    
</div>

</body>
<body> <a href='../stock_panel.php'>Назад</a> </body>
</html>