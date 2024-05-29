<?php
session_start();
require_once('database.php');

$login     = $_POST['username'];
$password  = $_POST['password'];

$_SESSION['username'] = $login;

$workers_query = "SELECT * FROM `workers` WHERE `login` = '$login' AND `password` = '$password'";

$result = $connection->query($workers_query);

if ($result->num_rows > 0){

    switch ($job = ($result->fetch_assoc())['job']){

        case 'admin':
            header("Location: adminFunctionality/admin_panel.php");
            break;

        case "order":

            header("Location: managerFunctionality/manager_panel.php");
            break;

        case "stock":

            header("Location: stockFunctionality/stock_panel.php");
            break;

        case 'engineer':

            header("Location: engineerFunctionality/engineer_panel.php");
            break;

    }
    $_SESSION['job'] = $job;

}else{ 
    echo "Вы неверно ввели логин или пароль!";
    header("Refresh: 5; url=".$_SERVER['HTTP_REFERER']);
}

?>