<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Сотрудник склада</title>
    <link rel="stylesheet" href="style.css">
</head>
</head>
<h1><center>Добро пожаловать сотрудник склада!</center></h1>
</html>
<body>
    <header>
        <nav>
            <ul>
                <form action="add_detail.php" method="post">
                    <button type="submit" name="button">Внести деталь</button>
                </form>
            </ul>
        </nav>
    </header>

</body>

        <form action="add_specification.php" method="POST">
            <div class="field input">
                <label for="spec">Название спецификации</label>
                    <input type="text" placeholder="Введите название спецификации" name="spec" id="spec"
                    required>
                <button type="submit" name="button">Добавить спецификацию</button>
            </div>

        </form>
        <form action="add_atm.php" method="POST">
                <button type="submit" name="button">Добавить банкомат</button>
            </div>
        </form>
<body>
    <table style="width:80%; height:80%; margin-left:auto; margin-right:auto; text-align:center;"border="1;">

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
      ?>

</table>

</body>
</html>
