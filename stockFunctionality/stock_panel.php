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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Сотрудник склада</title>
    <!-- <link rel="stylesheet" href="../style.css"> -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script type="text/javascript" src="dist/jquery.tabledit.js"></script>
</head>
</head>
<h1><center>Добро пожаловать сотрудник склада!</center></h1>
</html>
<body>
    <header>
        <nav>
            <ul>
                <form action="add_detail/add_detail.php" method="post">
                    <button type="submit" name="button">Внести деталь</button>
                </form>
            </ul>
        </nav>
    </header>

</body>

        <form action="add_atm/add_atm.php" method="POST">
                <button type="submit" name="button">Добавить банкомат</button>
            </div>
        </form>
<body>

    <table id="data_table" style="width:80%; height:80%; margin-left:auto; margin-right:auto; text-align:center;"border="1;">

      <tr>
        <th>ID Детали</th>
        <th>Наименование</th>
        <th>Тип</th>
        <th>Фабричный ID</th>
        <th>Стоимость 1 шт.</th>
        <th>Кл-во деталей на складе</th>
      </tr>

      <?php

      require_once('../database.php');

      $details_query = $connection->query("SELECT * FROM `details`");


      while($row=mysqli_fetch_array($details_query)){

          $id_spec = $row['ID_Specification'];
          $specification_query = $connection->query("SELECT * FROM `specifications` WHERE `ID_Specification`='$id_spec'");
          $specification_info  = $specification_query->fetch_assoc();
          $name_spec = $specification_info['Name'];

          $id_detail = $row['ID_Detail'];
          $quantity  = $row['Quantity_details'];

          echo "<tr>";
          echo "<td>" . $row['ID_Detail'] . "</td>";
          echo "<td>" . $row['Name'] . "</td>";
          echo "<td>" . $name_spec . "</td>";
          echo "<td>" . $row['factory_id'] . "</td>";
          echo "<td>" . $row['cost'] . " р. </td>";
          echo "<td>";
          echo '<form action="minus_detail.php" method="POST">';
          echo"<input type='hidden' name='id_detail' value='$id_detail'>";
          echo"<input type='hidden' name='quantity' value='$quantity'>";
          echo '<button type="submit" name="button">-</button>';
          echo '</form>';
          echo $row['Quantity_details'];
          echo '<form action="plus_detail.php" method="POST">';
          echo"<input type='hidden' name='id_detail' value='$id_detail'>";
          echo"<input type='hidden' name='quantity' value='$quantity'>";
          echo '<button type="submit" name="button">+</button>';
          echo '</form>';
          echo  "</td>";
          echo "</tr>";

      }
      $specifications = "";
      $counter        = 0;

      $specifications_query = $connection->query("SELECT * FROM `specifications`");

      while($row=mysqli_fetch_array($specifications_query)){

          $name_spec = $row['Name'];

          $counter++;
          $specifications = $specifications.'"'.$counter.'": "'.$name_spec.'",';

        }

    $specifications = substr($specifications, 0, strlen($specifications) - 1);
    $specifications = "'{".$specifications."}'";
      ?>

</table>
<script type="text/javascript" src="custom_table_edit.js" specifications=<?= $specifications ?>></script>
</body>
<body>
    <a href="index.php">Выход</a>
</body>
</html>
