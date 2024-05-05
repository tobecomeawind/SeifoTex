<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Вход</title>
</head>
<body>
    <div class="container">
        <div class="box form-box">
            <header>
                Вход
            </header>
            <form action="logging.php" method="POST">
                <div class="field input">
                    <label for="username">Логин</label>
                    <input type="text" placeholder="Введите ваш логин" name="username" id="username" required>
                </div>

                <div class="field input">
                    <label for="password">Пароль</label>
                    <input type="password" placeholder="Введите ваш пароль" name="password" id="password" required>
                </div>

                <div class="field">
                    <input type="submit" name="submit" value="Вход" required>
                </div>
                <a href="registration.php"><p><center>Регистрация</center></p></a>
            </form>
        </div>
    </div>
</body>
</html>