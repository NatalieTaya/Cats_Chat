<?php 
    session_start();
    include('lib/libDB.php');

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
        <a href="messages.php">Сообщения</a>
    </nav>
    <?php 
            $userFriends=getAllUsers();
            $user_info=getUserInfo($_SESSION['username']);
            $photoUrl=getUserAvatar($user_info[0]['photo_id']);
    ?>

        <main>
            <div class="usersData">
                <div id="usersData">
                    <div class="userAvatar">
                        <?php 
                        // Вывод аватара пользователя
                            printf('<img src= "%s">', $photoUrl)
                        ?>
                    </div>
                    <div class="userNameInfo">
                        <div class="userName">
                            <?php 
                            // Вывод имени и фамилии пользователя
                                printf('%s %s', $user_info[0]['name'], $user_info[0]['surname'])
                            ?>
                        </div>
                        <div class="userInfo">
                        <?php 
                            // Вывод имени и фамилии пользователя
                                printf('%s ', $user_info[0]['user_info'])
                            ?>
                        </div>
                    </div>
                </div>
                <div class="myPosts">
                        <?php 
                        // Вывод постов пользователя
                        print_r("Мои посты");
                        ?>
                        <form action="">
                            <textarea id="inputText" ></textarea>
                            <input id="inputFile" type="file">
                            <label  id="inputLabelFile" for="inputFile"><img src="img/picInput.png" alt="" width="50px"></label>
                            <button id="submitPostBtn" type="submit">Отправить</button>
                        </form>

                </div>
            </div>
            <aside class="userFriends">
                    Мои друзья
                    <?php 
                    // Вывод друзей пользователя
                    foreach($userFriends as $friend) {
                        printf('<img class="friends_avatar" src= "%s">', getUserAvatar($friend['photo_id']));
                    }
                    ?>
            </aside>



        </main>


</body>
</html>