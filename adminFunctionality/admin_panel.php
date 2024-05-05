<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css">
    <title>Админ панель</title>
</head>
<h1><center>Добро пожаловать Админ!</center></h1>
<body>
<div class="container">
    <div class="box form-box">
        <header>
            Регистрация сотрудника
        </header>
        <form action="add_employee.php" method="POST">

            <div class="field input">
                <label for="username">Логин</label>
                <input type="text" placeholder="Lогин" name="username" id="username" required>
            </div>

            <div class="field input">
                <label for="password">Пароль</label>
                <input type="password" placeholder="Pароль" name="password" id="password" required>
            </div>

            <div class="field input">

                <label for="job">Должность</label>
                    <select type="job" name="job" id="job" required>

                        <option value="" disabled selected>Выбрать</option>

                        <option value=admin>Админ</option>

                        <option value=order>Менеджер заказов</option>

                        <option value=stock>Сотрудник склада</option>

                        <option value=engineer>Техник</option>

                    </select>
            </div>

            <div class="field">
                <input type="submit" name="submit" value="Регистрация" required>

        </form>
    </div>
</div>

</body>
<body>
<div class="container">
    <div class="box form-box">
        <header>
            Удаление сотрудника
        </header>
        <form action="delete_employee.php" method="POST">

            <div class="field input">
                <label for="ID">ID</label>
                <input type="text" placeholder="Введите ID cотрудника" name="ID" id="ID" required>
            </div>

            <div class="field">
                <input type="submit" name="submit" value="Удалить!" required>

        </form>
    </div>
</div>

</body>
</html>