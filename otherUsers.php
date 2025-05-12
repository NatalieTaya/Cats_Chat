<?php 
    session_start();
    include('lib/libDB.php');
    include('lib/lib.php');
    $userId =$_SESSION['user_id'];
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
    <link rel="stylesheet" href="/styles/otherUsers.css">

    <title>Document</title>
</head>
<body>
    <?php include('header.php') ?>

    <nav>
        <a href="personal.php">Главная</a>
        <a href="messages.php">Сообщения</a>
        <a href="">Заявки в друзья</a>
        <a href="otherUsers.php">Найти друзей</a>
    </nav>
    <?php 
            $users=getAllUsers();
    ?>

        <main>
            <div id="users_window">
                <?php 
                    // Вывод всех пользователей, кроме того, кто авторизован
                    foreach($users as $user) {

                    if ($user['user_id'] == $userId ) {continue;}   
                        printf('<a href="personal_other_users.php?id=%s" class="user">',$user['user_id']);
                    
                            printf('<div class="avatar"> <img src="%s" height = "150"> </div>',
                                                    getUserAvatar($user['user_id']));
                            printf('<div class="name">  <div class="username"> %s </div>',$user['name']);
                            printf('<div class="username"> %s </div>    </div>',$user['surname']);

                        printf('</a>');

                    }
    
                ?>
            </div>



        </main>


</body>
</html>