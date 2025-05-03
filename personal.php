<?php 
    session_start();
    include('lib/libDB.php');

    $login = $_SESSION['login'];

    // Меню под шапкой сайта
    if (isset($_POST['submitExit'])) {
        setcookie('key', '', 0);
        header('Location: /index.php');
    } 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/styles/personal.css">
    <link rel="stylesheet" href="/styles/header.css">

    <title>Document</title>
</head>
<body>
    <?php include('header.php') ?>

    <nav>
        <a href="personal.php">Главная</a>
    </nav>


        <main>
            <?php 
            // Вывод информации о пользователе

            ?>
        </main>


</body>
</html>