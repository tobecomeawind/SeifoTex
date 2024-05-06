<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Менеджер заказов</title>
    <link rel="stylesheet" href="style.css">
</head>
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
</html>
