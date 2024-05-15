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
            Добавление детали
        </header>
        <form action="send_detail.php" method="POST">
            <div class="field input">
                <label for="name">Название детали</label>
                <input type="text" placeholder="Введите название детали" name="name" id="name"
                required>
            </div>

            <div class="field input">
                <label for="spec">Спецификацию</label>
                    <input id="spec" name="spec" list="specifications" placeholder="Выберите спецификацию" required>
                    <datalist id='specifications'>

                        <option value="">Не указано</option>

                        <?php

                        require_once('../database.php');

                        $spec_info = $connection->query('SELECT * FROM `specifications`');

                        while($row = mysqli_fetch_array($spec_info)){

                            echo "<option value='".$row['Name']."'>".$row['Name']."</option>";
                        }

                        ?>

                    </datalist>
            </div>

            <div class="field input">
                <label for="factory">Фабричный индекс</label>
                <input type="text" placeholder="Введите фабричный индекс" name="factory" id="factory" required>
            </div>

            <div class="field input">
                <label for="quantity">Кл-во</label>
                <input type="quantity" placeholder="Введите кл-во добавляемых деталей" name="quantity" id="quantity" value="1"
			required>
            </div>

            <div class="field input">
                <label for="cost">Стоимость</label>
                <input type="text" placeholder="Введите стоимость одного экземпляра" name="cost" id="cost" value="0"
                required>
            </div>


            <div class="field">
                <input type="submit" name="submit" value="Добавить" required>

        </form>
    </div>
</div>

</body>
</html>