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
        <p>
        <?php

        if (isset($_POST['atm'])){
            
            echo $_POST['atm'];
            $model = $_POST['atm'];
        
        }elseif(isset($_GET['atm'])){
        
            echo $_GET['atm'];
            $model = $_GET['atm'];

        }

        ?>
        </p>
<form action="send_atm_detail.php" method="POST">

        <?php

        require_once("../../database.php");

        $atm_query = $connection->query("SELECT * FROM `atms` WHERE `Model`='$model'");
        $atm_info  = $atm_query->fetch_assoc(); 
        $id_atm    = $atm_info['ID_ATM'];

        $atm_detail_query = $connection->query("SELECT * FROM `atms-details` WHERE `ID_ATM`='$id_atm'");

        $used_details = array();

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

                array_push($used_details, $name);
 
                echo "<p>".$counter .". ".$name." (".$name_spec.")";      
            } 
        }else{
            echo "<p>У данного банкомата не указаны детали</p>";
        }

        ?>
            <div class="field input">
                    <label for="detail">Выберите детали для добавления</label>
                        <input id="detail" name="detail" list="details" placeholder="Выберите деталь" required>
                        <datalist id='details'>

                            <?php

                            require_once('../../database.php');

                            $details_info = $connection->query('SELECT * FROM `details`');

                            while($row = mysqli_fetch_array($details_info)){

                                if (!in_array($row['Name'], $used_details) && ($row['Quantity_details'] != 0)){
                                    echo "<option value='".$row['Name']."'>".$row['Name']."</option>";
                                }
                            }

                            ?>

                        </datalist>
                        
                
                <input type='hidden' name='atm' value='<?php echo $model?>' >
                <button >Добавить деталь</button>
            </div>
    </form>
<?php

    require_once("../../database.php");

    $atm_query = $connection->query("SELECT * FROM `atms` WHERE `Model`='$model'");
    $atm_info  = $atm_query->fetch_assoc(); 
    $id_atm    = $atm_info['ID_ATM'];

    $atm_detail_query = $connection->query("SELECT * FROM `atms-details` WHERE `ID_ATM`='$id_atm'");

    if ($atm_detail_query->num_rows > 0){

    echo '<form action="minus_atm_detail.php" method="POST">';
    echo '<label for="detail">Выберите детали для удаления</label>';
    echo '<input id="detail" name="detail" list="atm_details" placeholder="Выберите деталь" required>';
    echo "<datalist id='atm_details'>";

    while($row=$atm_detail_query->fetch_assoc()){

            $id_detail = $row['ID_Detail'];
            $detail_query = $connection->query("SELECT * FROM `details` WHERE `ID_Detail`='$id_detail'");
            $detail_info  = $detail_query->fetch_assoc();
            $name         = $detail_info['Name'];
            
            echo "<option value='".$name."'></option>";      
        }
        echo "</datalist>";
        echo "<input type='hidden' name='atm' value='".$model."'>";
        echo '<button >Удалить деталь</button>';
    }                      
        
    echo"</form>";
    echo "</div>";
?>
</body>
<body>

    <p>Смена статуса банкомата</p>
    <?php

        $completed_atms_query = $connection->query("SELECT * FROM `completed_atms` WHERE `ID_ATM`='$id_atm'");

        $post_param = '';

        if ($completed_atms_query->num_rows > 0){

            $post_param = "full";
            echo "Банкомат полностью укомплектован";

        }else{

            echo "Банкомат не укомплектован";

        }


        echo "<form action='change_atm_status.php' method='POST'>";
        echo "<button>";
        echo "Сменить";
        echo "<input type='hidden' name='".$post_param."'>";
        echo "<input type='hidden' name='id_atm' value=$id_atm".">";
        echo "<input type='hidden' name='atm' value='$model'".">";
        echo "</button>";
        echo "</form>";

    ?>

</body>
<body> <a href='add_atm.php'>Назад</a> </body>
</html>

