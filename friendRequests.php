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
    <script src="scripts/addToFriends.js" defer></script>

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
            $friendships=getAllFriendshipsRequests($_SESSION['user_id'] ,0); 
            $userFriends=getUsersFriends($userId,1);
            $posts=getUsersPosts($userId);
    ?>

        <main>
            <div class="usersData">
                <div class="myRequests">
                    <?php
                    foreach($friendships as $friendship){
                        if($friendship['status']==0) {
                            $user_info=getUserInfo($friendship['friend_id']);
                            $photoUrl=getUserAvatar($user_info[0]['photo_id']);
                            printf('<div><img src="%s" height="200px"></div>',$photoUrl);
                            printf('<div>%s</div>',$user_info[0]['username']);
                            printf('
                            <form onsubmit="addToFriends(event)">
                                <input      type="hidden" name="sender_id" value="%s">
                                <input      type="hidden" name="user_id" value="%s">
                                <button     id="addBtn" type="submit"> Добавить в друзья </button>
                                <div     id="text" >  </div>
                            </form> ',  htmlspecialchars($friendship['friend_id']),
                                        htmlspecialchars($friendship['friends_with_id']));
                        }
                    }
                    ?>
                </div>
            </div>
            <script>
                window.friendship = <?php echo json_encode( $friendship, JSON_UNESCAPED_UNICODE)?>;
                window.friendship_status = <?php echo json_encode(1, JSON_UNESCAPED_UNICODE) ?>;

            </script>
        </main>


</body>
</html>