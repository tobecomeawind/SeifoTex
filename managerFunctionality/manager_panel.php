<?php
    session_start();

    if (isset($_SESSION['current_file'])){
    
        $_SESSION['prev_file'] = $_SESSION['current_file'];
    
    }else{
        $_SESSION['current_file'] = $_SERVER['SCRIPT_NAME'];
    }

    if (is_null($_SESSION['job']) or $_SESSION['job'] != 'order'){

        header("Location: ../access_denied.php");

    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Менеджер заказов</title>
    <link rel="stylesheet" href="style.css">
</head>
</head>
<h1><center>Добро пожаловать Менеджер Заказов!</center></h1>
</html>
<body>
    <header>
        <nav>
            <ul>
                <form action="clients_requests/client_requests.php" method="post">
                    <button type="submit" name="button">Заявки</button>
                </form>
                <form action="orders/manager_orders.php" method="post">
                    <button type="submit" name="button">Созданные заказы</button>
                </form>
                <form action="clients/clients.php" method="post">
                    <button type="submit" name="button">Клиенты</button>
                </form>
            </ul>
        </nav>
    </header>

</body>
<body>
    <a href="index.php">Выход</a>
</body>
</html>
