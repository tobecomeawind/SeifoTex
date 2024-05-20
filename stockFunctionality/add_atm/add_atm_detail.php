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
            Изменение деталей банкомата
        </header>
        <p><?php echo $_POST['atm']; ?></>
<form action="send_atm_detail.php" method="POST">

        <?php

        require_once("../../database.php");

        $model = $_POST['atm'];
        $atm_query = $connection->query("SELECT * FROM `atms` WHERE `Model`='$model'");
        $atm_info  = $atm_query->fetch_assoc(); 
        $id_atm    = $atm_info['ID_ATM'];

        $atm_detail_query = $connection->query("SELECT * FROM `atms-details` WHERE `ID_ATM`='$id_atm'");

        if ($atm_detail_query->num_rows>0){

            $counter = 0;
            while($row=$atm_detail_query->fetch_assoc()){

                $id_detail = $row['ID_Detail'];
                $detail_query = $connection->query("SELECT * FROM `details` WHERE `ID_Detail`='$id_detail'");
                $detail_info  = $detail_query->fetch_assoc();
                $name         = $detail_info['Name'];

                $id_spec = $detail_info['ID_Specification'];
                $specification_query = $connection->query("SELECT * FROM `specifications` WHERE `ID_Specification`='$id_spec'");
                $specification_info  = $specification_query->fetch_assoc();
                $name_spec           = $specification_info['Name']; 

                $counter++;
 
                echo "<p>".$counter .". ".$name." (".$name_spec.")";
                echo '<form action="minus_atm_detail.php" method="POST">';
                echo "<input type='hidden' name='id_detail' value='$id_detail'>";
                echo "<input type='hidden' name='id_atm' value='$id_atm'>";
                echo '<button type="submit" name="button">-</button>';
                echo '</form>';        
                echo "</p>";
            } 
        }else{
            echo "<p>У данного банкомата не указаны детали</p>";
        }

        ?>
            <div class="field input">
                    <label for="detail">Детали</label>
                        <?php
                        echo $_POST['atm_details'];
                        ?>
                        <input id="detail" name="detail" list="details" placeholder="Выберите деталь">
                        <datalist id='details'>

                            <?php

                            require_once('../../database.php');

                            $details_info = $connection->query('SELECT * FROM `details`');

                            while($row = mysqli_fetch_array($details_info)){

                                echo "<option value='".$row['Name']."'>".$row['Name']."</option>";
                            }

                            ?>

                        </datalist>
                        
                
                <input type='hidden' name='atm' value=<?php echo '"'.$_POST['atm'].'"' ?> >
                <div class="field">
                    <input type="submit" name="submit" value="Добавить деталь" required>
                </div>
        </div>
    </form>
</div>

</body>
<body> <a href='../add_atm.php'>Назад</a> </body>
</html>

